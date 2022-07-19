<?php

namespace App\DataTables\Admin\KasRT;

use App\Models\KasIuranKondisional;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KasIuranKondisionalDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group">';
                $btn = $btn . '<a href="' . route('admin.kas-rt.kas-iurankondisional.edit', $row->id) . '" class="btn btn-dark buttons-edit"><i class="fas fa-edit"></i></a>';
                $btn = $btn . '<a href="' . route('admin.kas-rt.kas-iurankondisional.destroy', $row->id) . '" class="btn btn-danger buttons-delete"><i class="fas fa-trash fa-fw"></i></a>';
                $btn = $btn . '</div>';

                return $btn;
            })
            ->editColumn('status', function ($row) {
                if ($row->status == '1') {
                    $label = '<label for="" class="label label-success">Sudah Bayar</label>';
                    return  $label;
                }
                $label = '<label for="" class="label label-danger">Belum Bayar</label>';
                return  $label;
            })
            ->rawColumns(['status', 'action']);

        // ->addColumn('image', function ($row) {
        //     $img = '<img src="' . asset($row->dokumen[0]['public_url']) . '" class="img-rounded height-80" >';
        //     return $img;
        // })
        // // raw column berfungsi untuk menjalankan tag html
        // ->rawColumns(['image', 'action']);
    }


    public function query(KasIuranKondisional $model)
    {
        return $model->with(['iurankondisional', 'petugastagihan', 'postagihankondisional', 'warga_kondisional'])->select('kas_iuran_kondisionals.*');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('kasiurankondisional-table')
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
            Column::make('iurankondisional.nama', 'iurankondisional.nama')->title('Jenis Iuran kondisional'),
            Column::make('tanggal'),
            Column::make('petugastagihan.nama', 'petugastagihan.nama')->title('Nama Petugas'),
            Column::make('warga_kondisional.warga', 'warga_kondisional.warga')->title('Nama Warga'),
            Column::make('postagihankondisional.nama', 'postagihankondisional.nama')->title('Pos'),
            Column::make('total_biaya'),
            Column::make('status'),
        ];
    }


    protected function filename()
    {
        return 'KasIuranKondisional_' . date('YmdHis');
    }
}
