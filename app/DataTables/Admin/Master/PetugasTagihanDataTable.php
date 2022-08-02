<?php

namespace App\DataTables\Admin\Master;

use App\Models\PetugasTagihan;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PetugasTagihanDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->setRowId(function ($row) {
                return $row->id;
            })
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group">';
                $btn = $btn . '<a href="' . route('admin.master-data.petugas-tagihan.edit', $row->id) . '" class="btn btn-dark buttons-edit"><i class="fas fa-edit"></i></a>';
                $btn = $btn . '<a href="' . route('admin.master-data.petugas-tagihan.destroy', $row->id) . ' "class= "btn btn-danger buttons-delete"><i class="fas fa-trash fa-fw"></i></a>';

                $btn = $btn . '</div>';

                return $btn;
            })

            // ->addColumn('image', function ($row) {
            //     $img = '<img src="' . asset($row->dokumen[0]['public_url']) . '" class="img-rounded height-80" >';
            //     return $img;
            // })
            // // ->rawColumns(['image', 'action'])

            // // ->editColumn('image', function ($row) {
            // //     $img = '<img src="' . asset($row->dokumen->first()['public_url']) . '" class="img-rounded height-80" >';
            // //     return $img;
            // // })
            // // raw column berfungsi untuk menjalankan tag html
            // ->rawColumns(['image', 'action']);

            ->addColumn('image', function ($row) {
                $img = '<img src="' . asset($row->dokumen->first()['public_url']) . '" class="img-rounded height-80" >';
                return $img;
            })
            // raw column berfungsi untuk menjalankan tag html
            ->rawColumns(['image', 'action']);
    }


    public function query(PetugasTagihan $model)
    {
        return $model->select('petugas_tagihans.*')->with(['pos']);
    }


    public function html()
    {
        return $this->builder()
            ->setTableId('petugastagihan-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('<"dataTables_wrapper dt-bootstrap"B<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex"l>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>')
            ->orderBy(1)
            ->buttons(
                // Button::make('create'),
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
            Column::make('nama'),
            Column::make('ttgl'),
            Column::make('no_telp'),
            Column::make('alamat'),
            Column::make('pos')->data('pos.nama'),
            Column::computed('image'),
        ];
    }


    protected function filename()
    {
        return 'PetugasTagihan_' . date('YmdHis');
    }
}
