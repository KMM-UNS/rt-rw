<?php

namespace App\DataTables\Admin;

use App\Models\RiwayatRumah;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RiwayatDataTable extends DataTable
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
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Models\Admin/RiwayatDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(RiwayatRumah $model)
    {
        $id = request()->segment(3);
        return $model->select('riwayat_rumah.*')->with(['rumah','keluarga'])->where('rumah_id', $id);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('riwayatdatatable-table')
                    ->columns($this->getColumns())
                    ->parameters([
                        'responsive' => true,
                        'autoWidth' => false
                    ]);
    //                 ->minifiedAjax()
    //                 ->dom('<"dataTables_wrapper dt-bootstrap"B<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex"l>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>')
    //                 ->orderBy(1)
    //                 ->buttons(
    //                     Button::make('create'),
    //                     Button::make('export'),
    //                     Button::make('print'),
    //                     Button::make('reset'),
    //                     Button::make('reload')
    //                 );
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
            Column::make('keluarga_id')->data('keluarga.kepala_keluarga')->title('Kepala Keluarga'),
            Column::make('tanggal_masuk'),
            Column::make('tanggal_keluar')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin/Riwayat_' . date('YmdHis');
    }
}
