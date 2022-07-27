<?php

namespace App\DataTables\Admin;

use App\Models\Rumah;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RumahDataTable extends DataTable
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
                $btn = $btn . '<a href="' . route('admin.rumah.show', $row->id) . '" class="btn btn-white buttons-info"><i class="fas fa-eye fa-fw"></i></a>';
                if(auth()->user()->hasRole('admin')){
                    $btn = $btn . '<a href="' . route('admin.rumah.edit', $row->id) . '" class="btn btn-dark buttons-edit"><i class="fas fa-edit"></i></a>';
                    $btn = $btn . '<a href="' . route('admin.rumah.destroy', $row->id) . '" class="btn btn-danger buttons-delete"><i class="fas fa-trash fa-fw"></i></a>';
                }
                $btn = $btn . '</div>';
                return $btn;
            });
            // membuat img tag dan memanggil relasi dokumen
            // dokumen[0]['public_url'] berarti mengambil isi dari dokumen index ke-0 kolom public url yang mana isinya adalah link ke dokumen yang diupload
            // tag img dapat diubah sesuai keinginan
            // ->addColumn('image', function($row){
            //     $img = '<img src="'.asset(empty($row->dokumen) ? $row->dokumen->first()['public_url'] : '') .'" class="img-rounded height-80" >';
            //     return $img;
            // })
            // raw column berfungsi untuk menjalankan tag html
            // ->rawColumns(['image', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Models\Admin\RumahDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Rumah $model)
    {
        return $model->with(['status_penggunaan_rumah', 'status_hunian'])->select('rumah.*')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        // jika yang login admin
        if(auth()->user()->hasRole('admin')){
            return $this->builder()
            ->setTableId('rumah-table')
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
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
        } else {
            return $this->builder()
                    ->setTableId('rumah-table')
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
                    );
        }

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
            Column::make('alamat'),
            Column::make('nomor_rumah'),
            Column::make('status_penggunaan_rumah.nama','status_penggunaan_rumah.nama')->title('Status Penggunaan'),
            Column::make('status_hunian.nama','status_hunian.nama')->title('Status Hunian'),
            // memanggil column yang sudah dibuat di atas
            // Column::computed('image'),
            Column::computed('action')
                  ->exportable(false)
                  ->title('Aksi')
                  ->printable(false)
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
        return 'Rumah_' . date('YmdHis');
    }
}
