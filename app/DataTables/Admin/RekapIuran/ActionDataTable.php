<?php

namespace App\DataTables\Admin\RekapIuran;

use App\App\Models\Admin\RekapIuran\Action;
use App\Models\KasIuranAgenda;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ActionDataTable extends DataTable
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
            ->addColumn('action', 'admin\rekapiuran\action.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Models\Admin\RekapIuran\Action $model
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function query(KasIuranAgenda $model)
    {
        return $model->newQuery('rekap_iuran_agendas.*')->with(['jenis_iuranagenda', 'nama_petugas']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('admin\rekapiuran\action-table')

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
            // Column::make('id'),
            Column::make('jenis_iuran_id')->data('iuranagenda.nama'),
            Column::make('nama_petugas_id')->data('petugastagihan.nama'),
            Column::make('pemberi')->data('petugastagihan.nama'),
            Column::computed('image'),
            Column::make('total_biaya'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Action_' . date('YmdHis');
    }
}
