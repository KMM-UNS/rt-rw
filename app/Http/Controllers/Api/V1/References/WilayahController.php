<?php

namespace App\Http\Controllers\Api\V1\References;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function provinsi(Request $request)
    {
        $dt = Province::all();
        $dt = $dt->when($request->pluck == "true", function ($query) {
            return $query->pluck('name', 'id');
        });
        return response()->json($dt);
    }

    public function kabupaten(Request $request)
    {
        $provinsi_id = $request->provinsi_id;

        $dt = Regency::when($provinsi_id, function ($query, $provinsi_id) {
            return $query->whereHas('province', function (Builder $query) use ($provinsi_id) {
                $query->where('id', $provinsi_id);
            });
        })->get();

        $dt = $dt->when($request->pluck == "true", function ($query, $pluck) {
            return $query->pluck('name', 'id');
        });
        return response()->json($dt);
    }

    public function kecamatan(Request $request)
    {
        $kabupaten_id = $request->kabupaten_id;

        $dt = District::when($kabupaten_id, function ($query, $kabupaten_id) {
            return $query->whereHas('regency', function (Builder $query) use ($kabupaten_id) {
                $query->where('id', $kabupaten_id);
            });
        })->get();

        $dt = $dt->when($request->pluck == "true", function ($query) {
            return $query->pluck('name', 'id');
        });
        return response()->json($dt);
    }

    public function kelurahan(Request $request)
    {
        $kecamatan_id = $request->kecamatan_id;

        $dt = Village::when($kecamatan_id, function ($query, $kecamatan_id) {
            return $query->whereHas('district', function (Builder $query) use ($kecamatan_id) {
                $query->where('id', $kecamatan_id);
            });
        })->get();

        $dt = $dt->when($request->pluck == "true", function ($query) {
            return $query->pluck('name', 'id');
        });
        return response()->json($dt);
    }
}
