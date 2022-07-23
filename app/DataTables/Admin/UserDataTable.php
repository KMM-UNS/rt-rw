<?php

namespace App\DataTables\Admin;

use App\Models\Keluarga;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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
            ->setRowId(function ($row) {
                return $row->id;
            });
        // ->addColumn('action', function ($row) {
        //     $btn = '<div class="btn-group">';
        //     $btn = $btn . '<a href="' . route('admin.user.edit', $row->id) . '" class="btn btn-dark buttons-edit"><i class="fas fa-edit"></i></a>';
        //     $btn = $btn . '<a href="' . route('admin.user.destroy', $row->id) . '" class="btn btn-danger buttons-delete"><i class="fas fa-trash fa-fw"></i></a>';
        //     $btn = $btn . '</div>';

        //     return $btn;
        // });
    }
    // return datatables()
    //     ->eloquent($query)
    //     ->setRowId(function ($row) {
    //         return $row->id;
    //     })
    //     ->addColumn('action', function ($row) {
    //         $btn = '<div class="btn-group">';
    //         $btn = $btn . '<a href="' . route('admin.user.edit', $row->id) . '" class="btn btn-dark buttons-edit"><i class="fas fa-edit"></i></a>';
    //         $btn = $btn . '<a href="' . route('admin.user.destroy', $row->id) . '" class="btn btn-danger buttons-delete"><i class="fas fa-trash fa-fw"></i></a>';
    //         $btn = $btn . '</div>';

    //         return $btn;
    //     })
    //     ->editColumn('created_at', function ($row) {
    //         return $row->created_at->locale('id');
    //     });
    // )


    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Keluarga $model)
    {
        return $model->select('keluargas.*')->with(['postagihan']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('user-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('<"dataTables_wrapper dt-bootstrap"B<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex"l>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>')
            ->orderBy(1)
            // ->buttons(
            //     Button::make('create'),
            //     Button::make('export'),
            //     Button::make('print'),
            //     Button::make('reset'),
            //     Button::make('reload')
            // )
        ;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            // Column::computed('action')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->width(60)
            //     ->addClass('text-center'),
            Column::make('DT_RowIndex')->title('No')->orderable(false)->searchable(false)->addClass('text-center'),
            Column::make('warga')->title('Nama Lengkap'),
            Column::make('telp')->title('Nomor Telepon'),
            Column::make('postagihan.nama', 'postagihan.nama')->title('Pos'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
