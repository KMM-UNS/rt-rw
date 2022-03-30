<?php

namespace App\DataTables\Admin\KasRT;

use App\Models\KasIuranWajib;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KasIuranWajibDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->setRowId(function ($row) {
                return $row->id;
            })
            // ->editColumn('created_at', function ($row) {
            //     return $row->created_at->isoFormat('Y-m-d');
            // })
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group">';
                $btn = $btn . '<a href="' . route('admin.kas-rt.kas-iuranwajib.edit', $row->id) . '" class="btn btn-dark buttons-edit"><i class="fas fa-edit"></i></a>';
                $btn = $btn . '<a href="' . route('admin.kas-rt.kas-iuranwajib.destroy', $row->id) . '" class="btn btn-danger buttons-delete"><i class="fas fa-trash fa-fw"></i></a>';
                $btn = $btn . '</div>';

                return $btn;
            });
    }
    public function query(KasIuranWajib $model)
    {
        return $model->select('kas_iuran_wajibs.*')->with(['iuranwajib']);
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('kasiuranwajib-table')
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

    protected function getColumns()
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('id'),
            Column::make('jenis_iuran_id')->data('iuranwajib.nama'),
            Column::make('bulan'),
            Column::make('tahun'),
            Column::make('penerima'),
            Column::make('pemberi'),
            Column::make('total_biaya'),
            Column::make('bukti_pembayaran'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    protected function filename()
    {
        return 'KasIuranWajib_' . date('YmdHis');
    }
}
