<?php

namespace App\DataTables\Admin;

use App\Models\JadwalRonda;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class JadwalRondaDataTable extends DataTable
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
                $btn = $btn . '<a href="' . route('admin.keluarga.show', $row->id) . '" class="btn btn-primary buttons-info"><i class="fas fa-info fa-fw"></i></a>';
                $btn = $btn . '<a href="' . route('admin.keluarga.edit', $row->id) . '" class="btn btn-dark buttons-edit"><i class="fas fa-edit"></i></a>';
                $btn = $btn . '<a href="' . route('admin.keluarga.destroy', $row->id) . '" class="btn btn-danger buttons-delete"><i class="fas fa-trash fa-fw"></i></a>';
                $btn = $btn . '</div>';
                return $btn;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Models\Admin\JadwalRondaDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(JadwalRonda $model)
    {
        return $model->select('jadwal_ronda.*')->with(['warga', 'hari']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('jadwalrondadatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('<"dataTables_wrapper dt-bootstrap"B<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex"l>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>')
                    ->orderBy(1)
                    ->parameters([
                        'responsive' => true,
                        'autoWidth' => false
                    ])
                    ->buttons(
                        Button::make('create'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
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
            Column::make('hari_id')->data('hari.nama')->title('Hari')->searchable(true),
            Column::make('warga_id')->data('warga.nama')->title('Nama Warga'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin\JadwalRonda_' . date('YmdHis');
    }
}