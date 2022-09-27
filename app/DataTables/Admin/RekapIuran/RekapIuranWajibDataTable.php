<?php

namespace App\DataTables\Admin\RekapIuran;

use App\Models\RekapIuranWajib;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RekapIuranWajibDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->setRowId(function ($row) {
                return $row->id;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Models\Admin\RekapIuran\RekapIuranWajib $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(RekapIuranWajib $model)
    {
        return $model->newQuery('rekap_iuran_wajibs.*')->with(['nama_bulans', 'tahun', 'jenisiuranwajib']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('rekapiuranwajib-table')
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
            Column::make('jenis_iuran_id')->data('jenisiuranwajib.jenis_iuran_id'),
            Column::make('bulan')->data('namabulanss.nama'),
            Column::make('tahun')->data('tahun.nama')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'RekapIuranWajib_' . date('YmdHis');
    }
}
