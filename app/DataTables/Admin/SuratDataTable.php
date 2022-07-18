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
            $btn = $btn . '<a class="info btn btn-white"><i class="fas fa-eye"></i></a>';
            // $btn = $btn . '<a href="' . route('admin.surat.edit', $row->id) . '" class="btn btn-dark buttons-edit"><i class="fas fa-edit"></i></a>';
            // $btn = $btn . '<a href="' . route('admin.surat.destroy', $row->id) . '" class="btn btn-danger buttons-delete"><i class="fas fa-trash fa-fw"></i></a>';
            $btn = $btn . '</div>';
            return $btn;
        })
        ->addColumn('show', function(Surat $surat){
            return view('pages.admin.surat.show', compact('surat'));
        })
        ->editColumn('tanggal_pengajuan', function($row){
            return $row->tanggal_pengajuan->isoFormat('DD MMMM YYYY');
        })
        ->editColumn('keperluan_surat_id', function($row){
            if($row->keperluan_surat_id == '7'){
                return $row->keterangan;
            }
            return $row->keperluan_surat->nama;
        })
        ->filter(function($query) use($request) {
            // dd($request->all());
            if($request->has('keperluan_surat_id') || $request->has('bulan') || $request->has('tahun')){
                $keperluan_surat_id = $request->get("keperluan_surat_id");
                $bulan = $request->get("bulan");
                $tahun = $request->get("tahun");

                return $query->where('keperluan_surat_id', '=' ,$keperluan_surat_id)->whereMonth('tanggal_pengajuan' , '=', $bulan)->whereYear('tanggal_pengajuan' , '=', $tahun);
            }
        });

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
                    ->dom('<"dataTables_wrapper dt-bootstrap"B<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex"l>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>')
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
