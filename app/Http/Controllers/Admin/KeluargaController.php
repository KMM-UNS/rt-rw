<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Rumah;
use App\Models\Warga;
use Twilio\Rest\Client;
use App\Models\Keluarga;
use App\Models\WargaPindah;
use App\Models\RiwayatRumah;
use App\Models\StatusHunian;
use Illuminate\Http\Request;
use App\Models\StatusTinggal;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Helpers\FileUploaderHelper;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\WhatsappApiServices;
use Twilio\Exceptions\TwilioException;
use App\Http\Requests\Admin\KeluargaForm;
use App\DataTables\Admin\KeluargaDataTable;
use App\DataTables\Admin\DetailKeluargaDataTable;

class KeluargaController extends Controller
{
    function __construct()
    {
    $this->middleware('role:admin')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KeluargaDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.keluarga.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rumah = Rumah::pluck('nomor_rumah', 'id');
        return view('pages.admin.keluarga.add-edit', [
            'rumah' => $rumah
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KeluargaForm $request)
    {
        DB::transaction(function () use ($request) {
            try {
                $status_tinggal = StatusTinggal::select('id')->where('nama', 'Warga Tinggal')->first();
                $keluarga = Keluarga::createFromRequest($request);
                $keluarga->status_tinggal_id = $status_tinggal->id;
                $keluarga->createable()->associate($request->user());
                $keluarga->save();

                $riwayat = RiwayatRumah::createFromRequest($request);
                $riwayat->rumah_id = $keluarga->rumah_id;
                $riwayat->keluarga_id = $keluarga->id;
                $riwayat->tanggal_masuk = Carbon::now()->format('Y-m-d');
                $riwayat->save();
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something what happen');
            }
        });
        return redirect(route('admin.keluarga.index'))->withInput()->withToastSuccess('Data tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DetailKeluargaDataTable $dataTable, $id)
    {
        $data = Keluarga::findorFail($id);
        $rumah = Rumah::pluck('nomor_rumah', 'id');
        $status_hunian = StatusHunian::where('nama', '!=','Rumah Kosong')->pluck('nama', 'id');
        return $dataTable->render('pages.admin.keluarga.show', [
            'data' => $data,
            'rumah' => $rumah,
            'status_hunian' => $status_hunian,
            // 'status_tinggal' => $status_tinggal
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Keluarga::findorFail($id);
        $rumah = Rumah::pluck('nomor_rumah', 'id');

        return view('pages.admin.keluarga.add-edit', [
            'data' => $data,
            'rumah' => $rumah,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KeluargaForm $request, $id)
    {
        $keluarga = Keluarga::findorFail($id);
        DB::transaction(function () use ($request, $keluarga) {
            try {
                $keluarga->updateFromRequest($request);
                $keluarga->save();
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something what happen');
            }
        });
        return redirect(route('admin.keluarga.index'))->withInput()->withToastSuccess('Data tersimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Keluarga::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }

    public function pindah(Request $request, $id)
    {
        // dd($request->all());
        $keluarga = Keluarga::findorFail($id);
        if ($request->lokasi == "Dalam Lingkungan")
        {
            DB::transaction(function () use ($request, $keluarga) {
                try {
                    // rumah yang dipilih untuk pindah
                    $rumah = Rumah::where('id', $request->keluarga_rumah_id)->firstOrFail();

                    if ($keluarga->rumah_id != null)
                    {
                        // update status hunian rumah sebelum pindah
                        $rumahBefore = Rumah::where('id', $keluarga->rumah_id)->firstOrFail();
                        $rumahBefore->status_hunian_id = 5;
                        $rumahBefore->save();

                        // mencari riwayat
                        $riwayatBefore = RiwayatRumah::where('keluarga_id', $keluarga->id)->where('rumah_id', $keluarga->rumah_id)->firstorFail();

                        // update tanggal keluar rumah sebelum
                        // $riwayatBefore->updateFromRequest($request);
                        $riwayatBefore->tanggal_keluar = Carbon::now()->format('Y-m-d');
                        $riwayatBefore->save();
                        // dd($riwayatBefore);

                        // update data keluarga ke rumah yang dipilih
                        $keluarga->updateFromRequest($request);
                        $keluarga->save();

                        // update status hunian rumah yang dipilih untuk pindah
                        $rumah->updateFromRequest($request);
                        $rumah->save();


                        // create riwayat baru dengan rumah baru
                        $riwayat = RiwayatRumah::createFromRequest($request);
                        $riwayat->rumah_id = $keluarga->rumah_id;
                        $riwayat->keluarga_id = $keluarga->id;
                        $riwayat->tanggal_masuk = Carbon::now()->format('Y-m-d');
                        $riwayat->save();
                    }
                    else
                    {
                        // update data keluarga ke rumah yang dipilih
                        $keluarga->updateFromRequest($request);
                        $keluarga->status_tinggal_id = 1;
                        // dd($keluarga);
                        $keluarga->save();

                        // update status hunian rumah yang dipilih untuk pindah
                        $rumah->updateFromRequest($request);
                        $rumah->save();

                        // create riwayat baru dengan rumah baru
                        $riwayat = RiwayatRumah::createFromRequest($request);
                        $riwayat->rumah_id = $keluarga->rumah_id;
                        $riwayat->keluarga_id = $keluarga->id;
                        $riwayat->tanggal_masuk = Carbon::now()->format('Y-m-d');
                        $riwayat->save();
                    }
                } catch (\Throwable $th) {
                    dd($th);
                    DB::rollback();
                    return back()->withInput()->withToastError('Something what happen');
                }
            });
            return redirect(route('admin.keluarga.index'))->withInput()->withToastSuccess('Data tersimpan');
        }
        elseif ($request->lokasi == "Luar Lingkungan")
        {
            DB::transaction(function () use ($request, $keluarga) {
                try {
                        // dd($request->all());

                        // update status hunian rumah sebelum pindah
                        $rumahBefore = Rumah::where('id', $keluarga->rumah_id)->firstOrFail();
                        $rumahBefore->status_hunian_id = 5;
                        $rumahBefore->save();


                        // update tanggal keluar rumah sebelumnya
                        $riwayatBefore = RiwayatRumah::where('keluarga_id', $keluarga->id)->where('rumah_id', $keluarga->rumah_id)->firstorFail();
                        // $riwayatBefore->updateFromRequest($request);
                        $riwayatBefore->tanggal_keluar = Carbon::now()->format('Y-m-d');
                        $riwayatBefore->save();

                        // update ke rumah yang dipilih
                        $keluarga->updateFromRequest($request);
                        $keluarga->status_tinggal_id = 2;
                        $keluarga->rumah_id = null;
                        $keluarga->save();

                        // update status warga pindah
                        $warga = Warga::where('keluarga_id', $keluarga->id)->get();
                        // dd($warga);
                        foreach ($warga as $w) {
                            $w->status_warga_id = 2;
                            $w->save();

                            // menambah detail pindah ke setiap warga
                            $warga_pindah = WargaPindah::createFromRequest($request);
                            $warga_pindah->warga_id = $w->id;
                            $warga_pindah->save();
                        }


                } catch (\Throwable $th) {
                    dd($th);
                    DB::rollback();
                    return back()->withInput()->withToastError('Something what happen');
                }
            });
            return redirect(route('admin.keluarga.index'))->withInput()->withToastSuccess('Data tersimpan');
            }
    }

    public function verifikasi(Request $request, $id, WhatsappApiServices $whatsappApiServices)
    {
        // dd(Carbon::now());
        $keluarga = Keluarga::findOrFail($id);
        DB::transaction(function () use ($request, $keluarga, $whatsappApiServices) {
            try {
                $keluarga->updateFromRequest($request);
                $keluarga->verified_at = Carbon::now();
                $keluarga->save();

                $riwayat = RiwayatRumah::createFromRequest($request);
                $riwayat->rumah_id = $keluarga->rumah_id;
                $riwayat->keluarga_id = $keluarga->id;
                $riwayat->tanggal_masuk = Carbon::now()->format('Y-m-d');
                $riwayat->save();

                // $user = User::where('id', $keluarga->createable_id);
                $body = "Sistem Informasi RT - Keluarga terverifikasi, Anda dapat melanjutkan proses pengisian data.";

                $whatsappApiServices->sendMessage($keluarga->createable->phone_number, $body);
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something what happen');
            }
        });
        return redirect(route('admin.keluarga.index'))->withInput()->withToastSuccess('Data tersimpan');
    }

    public function tolak(Request $request, $id, WhatsappApiServices $whatsappApiServices)
    {
        $keluarga = Keluarga::findOrFail($id);
        DB::transaction(function () use ($request, $keluarga, $whatsappApiServices) {
            try {
                $keluarga->updateFromRequest($request);
                $keluarga->save();

                $body = "Sistem Informasi RT - Pengajuan data keluarga ditolak. Alasan: ".$keluarga->keterangan.". Silakan ubah data Anda lalu hubungi Admin." ;

                $whatsappApiServices->sendMessage($keluarga->createable->phone_number, $body);
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something what happen');
            }
        });
        return redirect(route('admin.keluarga.index'))->withInput()->withToastSuccess('Data tersimpan');
    }
}
