<?php

namespace App\DataTables\Admin;

use App\Models\Surat;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SuratDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query, Request $request)
    {
        return datatables()
        ->eloquent($query)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $btn = '<div class="btn-group">';
            if ($row->status_surat_id == '2' && auth()->user()->hasRole('ketua_rt') || $row->status_surat_id == '3' && auth()->user()->hasRole('ketua_rw') || $row->status_surat_id == '1') {
                $btn = $btn . '<a class="info btn btn-white"><i class="fas fa-plus"></i></a>';
            }
            else {
                $btn = $btn . '<a class="btn btn-white disabled"><i class="fas fa-plus"></i></a>';
            }
            $btn = $btn . '</div>';
            return $btn;
        })
        ->addColumn('show', function(Surat $surat){
            return view('pages.admin.surat.show', compact('surat'));
        })
        ->editColumn('tanggal_pengajuan', function($row){
            return $row->tanggal_pengajuan->isoFormat('DD MMMM YYYY');
        })
        ->editColumn('keperluan_surat.nama', function($row){
            if($row->keperluan_surat_id == '7'){
                return $row->keterangan;
            }
            return $row->keperluan_surat->nama;
        })
        ->filter(function($query) use($request) {
            if($request->has('keperluan_surat_id') || $request->has('bulan') || $request->has('tahun')){
                $keperluan_surat_id = $request->get("keperluan_surat_id");
                $bulan = $request->get("bulan");
                $tahun = $request->get("tahun");

                if($keperluan_surat_id != null && $bulan == null && $tahun == null) {
                    $query->where('keperluan_surat_id', '=' ,$keperluan_surat_id);
                }
                elseif($keperluan_surat_id == null && $bulan != null && $tahun == null) {
                    $query->whereMonth('tanggal_pengajuan' , '=', $bulan);
                }
                elseif($keperluan_surat_id == null && $bulan == null && $tahun != null) {
                    $query->whereYear('tanggal_pengajuan' , '=', $tahun);
                }
                elseif($keperluan_surat_id != null && $bulan != null && $tahun == null) {
                    $query->where('keperluan_surat_id', '=' ,$keperluan_surat_id)->whereMonth('tanggal_pengajuan' , '=', $bulan);
                }
                elseif($keperluan_surat_id != null && $bulan == null && $tahun != null) {
                    $query->where('keperluan_surat_id', '=' ,$keperluan_surat_id)->whereYear('tanggal_pengajuan' , '=', $tahun);
                }
                elseif($keperluan_surat_id == null && $bulan != null && $tahun != null) {
                    $query->whereMonth('tanggal_pengajuan' , '=', $bulan)->whereYear('tanggal_pengajuan' , '=', $tahun);
                }
                elseif($keperluan_surat_id != null && $bulan != null && $tahun != null) {
                    return $query->where('keperluan_surat_id', '=' ,$keperluan_surat_id)->whereMonth('tanggal_pengajuan' , '=', $bulan)->whereYear('tanggal_pengajuan' , '=', $tahun);
                }
                else {
                    return $query;
                }
            }
        }, true);

    }



    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Models\Admin\SuratDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Surat $model)
    {
        return $model->with(['warga', 'keperluan_surat', 'status_surat'])->select('surat.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('surat-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('<"dataTables_wrapper dt-bootstrap"B
                    <"row"
                    <"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"
                    <"d-block d-lg-inline-flex"l>>
                    <"col-xl-5 d-flex d-xl-block justify-content-center"fr>>
                    t<"row"<"col-sm-5"i><"col-sm-7"p>>>')
                    ->orderBy(1)
                    ->parameters([
                        'responsive' => true,
                        'autoWidth' => false,
                        'language' => [
                            'url' => url(asset('assets/datatables/lang/indonesia.json'))
                        ]
                    ])
                    ->buttons(
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    )
                    ->parameters([
                        'initComplete' => 'function(){

                        // 1. Dapatkan instance datatable di javascript
                        let table = this.api();

                        $("#surat-table").on("click", ".info", function(){

                        // 2. dapatkan elemen `tr` yang mewakili baris dari ikon yang diklik
                        let tr = $(this).closest("tr");

                        // 3. dapatkan baris di datatable berdasarkan `tr` di atas
                        let row = table.row(tr);

                        // 4. check apakah baris sedang terlihat (visible)
                        if ( row.child.isShown() ) {

                        // jika posisi sekarang terlihat, maka hide
                        row.child.hide();
                        tr.removeClass("shown");
                        }
                        else {
                        // jika posisi sekarang tidak terlihat (hidden), maka perlihatkan
                        // dengan data "Helllo again"
                        row.child(row.data().show).show();
                        tr.addClass("shown");
                        }
                        })
                                                }'
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title('No')->orderable(false)->searchable(false)->addClass('text-center'),
            Column::make('nomor_surat', 'surat.nomor_surat'),
            Column::make('warga.nama','warga.nama')->title('Warga'),
            Column::make('keperluan_surat.nama', 'keperluan_surat.nama')->title('Keperluan'),
            Column::make('tanggal_pengajuan', 'surat.tanggal_pengajuan'),
            Column::make('status_surat.nama','status_surat.nama')->title('Status'),
            Column::computed('action')
                  ->addClass('details-control')
                  ->title('Aksi')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Surat_' . date('YmdHis');
    }
}
