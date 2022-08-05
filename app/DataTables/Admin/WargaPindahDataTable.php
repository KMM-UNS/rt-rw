<?php

namespace App\DataTables\Admin;

use App\Models\Warga;
use App\Models\WargaPindah;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class WargaPindahDataTable extends DataTable
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
                $btn = $btn . '<a class="info btn btn-white"><i class="fas fa-plus"></i></a>';
                // $btn = $btn . '<a href="' . route('admin.warga.show', $row->id) . '" class="btn btn-default buttons-info"><i class="fas fa-eye"></i></a>';
                // $btn = $btn . '<a href="' . route('admin.warga.edit', $row->id) . '" class="btn btn-dark buttons-edit"><i class="fas fa-edit"></i></a>';
                // $btn = $btn . '<a href="' . route('admin.warga.destroy', $row->id) . '" class="btn btn-danger buttons-delete"><i class="fas fa-trash fa-fw"></i></a>';
                $btn = $btn . '</div>';
                return $btn;
            })
            ->addColumn('show', function($row){
                $warga = WargaPindah::where('warga_id', $row->id)->first();
                return view('pages.admin.warga.pindah.show', ['warga' => $warga]);
            })
            ->editColumn('tanggal_lahir', function($row){
                return $row->tanggal_lahir->isoFormat('DD MMMM YYYY');
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Models\Admin\WargaDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Warga $model)
    {
        return $model->with(['keluarga', 'agama', 'status_keluarga', 'warga_pindah'])->select('warga.*')->where('status_warga_id', 2)->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('wargapindah-table')
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
                    )
                    ->parameters([
                        'initComplete' => 'function(){

                        // 1. Dapatkan instance datatable di javascript
                        let table = this.api();

                        $("#wargapindah-table").on("click", ".info", function(){

                        // 2. dapatkan elemen `tr` yang mewakili baris dari ikon yang diklik
                        let tr = $(this).closest("tr");

                        // 3. dapatkan baris di datatable berdasarkan `tr` di atas
                        let row = table.row(tr);

                        // 4. check apakah baris sedang terlihat (visible)
                        if ( row.child.isShown() ) {

                        // jika posisi sekarang terlihat, maka hide
                        row.child.hide();
                        tr.removeClass("shown");
                        }
                        else {
                        // jika posisi sekarang tidak terlihat (hidden), maka perlihatkan
                        // dengan data "Helllo again"
                        row.child(row.data().show).show();
                        tr.addClass("shown");
                        }
                        })
                                                }'
                    ]);
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
            Column::make('nik', 'warga.nik')->title('NIK'),
            Column::make('nama', 'warga.nama'),
            Column::make('jenis_kelamin', 'warga.jenis_kelamin'),
            Column::make('agama.nama','agama.nama')->title('Agama'),
            Column::make('tempat_lahir', 'warga.tempat_lahir'),
            Column::make('tanggal_lahir', 'warga.tanggal_lahir'),
            Column::make('status_keluarga.nama','status_keluarga.nama')->title('Status dalam Keluarga'),
            Column::computed('action')
                  ->exportable(false)
                  ->title('Aksi')
                  ->printable(false)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'WargaPindah_' . date('YmdHis');
    }
}
