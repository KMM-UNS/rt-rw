<?php

namespace App\DataTables\Admin;

use App\Models\Tamu;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TamuDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group">';
                $btn = $btn . '<a class="info btn btn-white"><i class="fas fa-plus"></i></a>';
                // $btn = $btn . '<a href="' . route('admin.tamu.edit', $row->id) . '" class="btn btn-dark buttons-edit"><i class="fas fa-edit"></i></a>';
                // $btn = $btn . '<a href="' . route('admin.tamu.destroy', $row->id) . '" class="btn btn-danger buttons-delete"><i class="fas fa-trash fa-fw"></i></a>';
                $btn = $btn . '</div>';
                return $btn;
            })
            ->addColumn('show', function(Tamu $tamu){
                return view('pages.admin.tamu.show', compact('tamu'));
            })
            ->editColumn('tanggal_tiba', function($row){
                return $row->tanggal_tiba->isoFormat('DD MMMM YYYY');
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Models\Admin\TamuDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Tamu $model)
    {
        return $model->with(['keluarga'])->select('tamu.*')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('tamudatatable-table')
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
                        // Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        // Button::make('reload')
                    )
                    ->parameters([
                        'initComplete' => 'function(){

                        // 1. Dapatkan instance datatable di javascript
                        let table = this.api();

                        $("#tamudatatable-table").on("click", ".info", function(){

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
            Column::make('jumlah', 'tamu.jumlah'),
            Column::make('nama', 'tamu.nama')->title('Nama Tamu'),
            Column::make('hubungan', 'tamu.hubungan'),
            Column::make('alamat', 'tamu.alamat'),
            Column::make('tanggal_tiba', 'tamu.tanggal_tiba'),
            Column::make('lama_menetap', 'tamu.lama_menetap'),
            Column::make('keluarga.kepala_keluarga', 'keluarga.kepala_keluarga')->title('Penerima Tamu'),
            Column::computed('action')
                  ->title('Aksi')
                  ->addClass('details-control')
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
        return 'Tamu_' . date('YmdHis');
    }
}
