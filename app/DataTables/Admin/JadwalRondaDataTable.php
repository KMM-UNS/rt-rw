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
                $btn = $btn . '<a href="' . route('admin.ronda.jadwal.edit', $row->id) . '" class="btn btn-dark buttons-edit"><i class="fas fa-edit"></i></a>';
                $btn = $btn . '<a href="' . route('admin.ronda.jadwal.destroy', $row->id) . '" class="btn btn-danger buttons-delete"><i class="fas fa-trash fa-fw"></i></a>';
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

        return $model->whereHas('ronda', function ($query){
            return $query->where('status', 'aktif');
        })->whereHas('warga', function ($query){
            return $query->where('status_warga_id', 1);
        })->with(['warga','hari'])->select('jadwal_ronda.*')->newQuery();
        dd($model);
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
            // Button::make('reload')
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
                        // Button::make('reload')
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
        $columns = [
            Column::make('DT_RowIndex')->title('No')->orderable(false)->searchable(false)->addClass('text-center'),
            Column::make('hari.nama','hari.nama')->title('Hari'),
            Column::make('warga.nama','warga.nama')->title('Nama Warga'),

        ];

        if(auth()->user()->hasRole('admin')){
            $column = Column::computed('action')
            ->exportable(false)
            ->title('Aksi')
            ->printable(false)
            ->width(60)
            ->addClass('text-center');
            array_push($columns, $column);
        }


        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'JadwalRonda_' . date('YmdHis');
    }
}
