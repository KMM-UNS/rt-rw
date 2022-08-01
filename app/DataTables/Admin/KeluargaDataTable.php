<?php

namespace App\DataTables\Admin;

use App\Models\Keluarga;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KeluargaDataTable extends DataTable
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
                $btn = $btn . '<a href="' . route('admin.keluarga.show', $row->id) . '" class="btn btn-default buttons-info"><i class="fas fa-eye fa-fw"></i></a>';
                // $btn = $btn . '<a href="' . route('admin.keluarga.edit', $row->id) . '" class="btn btn-dark buttons-edit"><i class="fas fa-edit"></i></a>';
                // $btn = $btn . '<a href="' . route('admin.keluarga.destroy', $row->id) . '" class="btn btn-danger buttons-delete"><i class="fas fa-trash fa-fw"></i></a>';
                $btn = $btn . '</div>';
                return $btn;
            })
            ->editColumn('verified_at', function ($row){
                if($row->verified_at == null){
                    return "-";
                } else {
                    return $row->verified_at;
                }
            }, true);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Models\Admin\KeluargaDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Keluarga $model)
    {
        return $model->with('status_tinggal')->select('keluarga.*')->orderBy('created_at', 'DESC')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('keluarga-table')
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
            Column::make('no_kk','keluarga.no_kk')->title('No KK'),
            Column::make('kepala_keluarga','keluarga.kepala_keluarga'),
            Column::make('status_tinggal.nama', 'status_tinggal.nama')->title('Status'),
            Column::make('verified_at')->title('Terverifikasi pada'),
            Column::computed('action')
            ->title('Aksi')
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
        return 'Keluarga_' . date('YmdHis');
    }
}
