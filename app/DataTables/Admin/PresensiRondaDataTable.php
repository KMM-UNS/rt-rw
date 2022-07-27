<?php

namespace App\DataTables\Admin;

use App\Models\PresensiRonda;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PresensiRondaDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query, Request $request)
    {
        return datatables()
        ->eloquent($query)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $btn = '<div class="btn-group">';
            // $btn = $btn . '<a href="' . route('admin.ronda.presensi.edit', $row->id) . '" class="btn btn-dark buttons-edit"><i class="fas fa-edit"></i></a>';
            // $btn = $btn . '<a href="' . route('admin.ronda.presensi.destroy', $row->id) . '" class="btn btn-danger buttons-delete"><i class="fas fa-trash fa-fw"></i></a>';
            $btn = $btn . '</div>';
            return $btn;
        })
        ->filter(function($query) use($request) {
            // dd($request->all());
            if($request->has('tanggal_awal') && $request->has('tanggal_akhir')){
                $tanggal_awal = $request->get("tanggal_awal");
                $tanggal_akhir = $request->get("tanggal_akhir");
                if($tanggal_awal != null && $tanggal_akhir != null) {
                    return $query->where('tanggal', '>=' ,$tanggal_awal)->where('tanggal', '<=' ,$tanggal_akhir);
                } else {
                    return $query;
                }
            }
        }, true)
        ->editColumn('tanggal', function($row){
            return $row->tanggal->isoFormat('DD MMMM YYYY');
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Models\Admin\PresensiRondaDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PresensiRonda $model)
    {
        return $model->with(['hari', 'jadwal_ronda.warga'])->select('presensi_ronda.*');
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
            Button::make('reload')
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
                        Button::make('reload')
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
        return [
            Column::make('DT_RowIndex')->title('No')->orderable(false)->searchable(false)->addClass('text-center'),
            Column::make('hari.nama','hari.nama')->title('Hari'),
            Column::make('tanggal'),
            Column::make('jadwal_ronda.warga.nama','jadwal_ronda.warga.nama')->title('Nama Warga'),
            Column::make('kehadiran', 'presensi_ronda.kehadiran'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'PresensiRonda_' . date('YmdHis');
    }
}
