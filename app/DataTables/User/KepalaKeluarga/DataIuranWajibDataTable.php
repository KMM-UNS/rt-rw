<?php

namespace App\DataTables\User\KepalaKeluarga;

use App\App\Models\User\KepalaKeluarga\DataIuranWajib;
use App\Models\Keluarga;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DataIuranWajibDataTable extends DataTable
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
            ->addColumn('action', 'user\kepalakeluarga\dataiuranwajib.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Models\User\KepalaKeluarga\DataIuranWajib $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Keluarga $model)
    {
        return $model->select('keluargaas.*')->with(['pos']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('user\kepalakeluarga\dataiuranwajib-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('<"dataTables_wrapper dt-bootstrap"B<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex"l>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
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
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('id'),
            Column::make('no_kk'),
            Column::make('kepala_keluarga'),
            Column::make('pos_tagihan')->data('pos.nama'),
            Column::make('telp'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User\KepalaKeluarga\DataIuranWajib_' . date('YmdHis');
    }
}
