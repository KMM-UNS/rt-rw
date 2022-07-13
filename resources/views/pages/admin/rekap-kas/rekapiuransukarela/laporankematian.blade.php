@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Data Lansia')

@push('css')
@endpush

@section('content')

    <!-- begin page-header -->
    {{-- <h1 class="page-header">
        <center>Laporan Kematian Lansia</center>
    </h1> --}}
    <!-- end page-header -->
    <div class="d-flex justify-content-center ">
        <div class="col-12 ui-sortable">
            <div class="panel panel-inverse">
                </br>
                <h1 class="page-header">
                    <center>Laporan Kematian Lansiaaa</center>
                </h1>

                <form action="/admin/rekap kas/laporankematian" method="post">
                    @csrf
                    <div class="panel-body">
                        <div class="form-group">
                            {{-- <div class="col-md-1 my-auto">
                                <label for="bulan"><strong>Jenis Iuran</strong></label>
                            </div>
                            <div class="col-md-3 ">
                                <x-form.Dropdown name="jenis_iuran_id" :options="$jenis_iuran" selected="{{{ old('jenis_iuran_id') ?? ($data['jenis_iuran_id'] ?? null) }}}" required />
                            </div> --}}
                            <div class="input-group mb-3">
                                <label for="label"> Tanggal Awal</label>
                                <input type="date" name="tglawal" id="tglawal" class="form-control" />
                            </div>
                            <div class="input-group mb-3">
                                <label for="label"> Tanggal Akhir</label>
                                <input type="date" name="tglakhir" id="tglakhir" class="form-control" />
                            </div>
                            <button class="btn btn-primary btn-md float-right " type="submit" name="submit"
                                value="table">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @isset($data)
        <div class="panel panel-inverse">
            <br>

            <div class="panel-body">
                <center>
                    <h4> Laporan Kematian Lansia</h4>
                </center>
                <a href="/admin/data-lansia/cetaklaporankematian/{{ $startDate }}/{{ $endDate }}"
                    class="btn btn-secondary btn-sm float-right mr-4"><i class="fa fa-print fa-fw"></i> Cetak Laporan </a>
                <br>

                <div class="form-group my-5">

                    <table id="rekaps" class="table table-bordered my-5" align="center" rules="all" border="1px"
                        style="width: 95%; margin-top: 1 rem;
    margin-bottom: 1 rem;">
                        <tr>
                            <th>No. </th>
                            <th>Nama Lansia </th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Tanggal Meninggal</th>
                        </tr>
                        @foreach ($data as $cetak)
                            <tr>
                                <td> banyak</td>
                                {{-- <td>{{ $cetak->iuransukarela->nama }}</td> --}}
                                <td> banyak</td>
                                <td>banyak</td>
                                <td> banyak</td>
                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>


        </div>

    @endisset
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#rekaps').DataTable({
                pageLength: 10,
                processing: true,
                serverSide: false,
                dom: 'Blfrtip',
            });

        });
    </script>
@endpush
