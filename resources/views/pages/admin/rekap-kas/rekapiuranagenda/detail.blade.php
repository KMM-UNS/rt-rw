@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Rekap Iuran Agenda')

@push('css')
    <!-- datatables -->
    <link href="{{ asset('/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('/assets/plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" />
    <!-- end datatables -->
@endpush

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Master Data</a></li>
        <li class="breadcrumb-item active">@yield('title')</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Master Data<small> @yield('title')</small></h1>
    <!-- end page-header -->


    <!-- begin panel -->
    <div class="panel panel-inverse">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">DataTable - @yield('title')</h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                        class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i
                        class="fa fa-minus"></i></a>
            </div>
        </div>
        <!-- begin panel-body -->
        <div class="panel-body">
            {{-- {{ $kas }} --}}
            <table border="1" cellpadding="2" class="table">
                <thead>
                    <tr>
                        <th scope="col">Jenis Iuran</th>
                        <th scope="col">Penerima</th>
                        <th scope="col">Warga</th>
                        <th scope="col">Image</th>
                        <th scope="col">Total Biaya</th>
                    </tr>
                </thead>
                @foreach ($rekap as $item)
                    @php
                        $total_biaya = number_format($item->total_biaya, 2, ',', '.');
                    @endphp
                    <tbody>
                        <tr>
                            <td>{{ $item->iuranagenda->nama }}</td>
                            <td>{{ $item->petugastagihan->nama }}</td>
                            <td>{{ $item->warga }}</td>
                            <td> <img src="{{ asset($item->dokumen[0]['public_url']) }}" alt=""
                                    class="img-rounded height-80"></td>
                            <td>Rp.{{ $item->total_biaya }}</td>
                        </tr>
                    </tbody>
                @endforeach
                <td colspan="4">TOTAL</td>
                <td>Rp.{{ $total }}</td>

            </table>

        </div>
        <!-- end panel-body -->
    @endsection

    @push('scripts')
        <!-- datatables -->
        <script src="{{ asset('assets/js/custom/datatable-assets.js') }}"></script>
        {{-- {{ $dataTable->scripts() }} --}}
        <!-- end datatables -->

        <script src="{{ asset('assets/js/custom/delete-with-confirmation.js') }}"></script>
        <script>
            $(document).on('delete-with-confirmation.success', function() {
                $('.buttons-reload').trigger('click')
            })
        </script>
    @endpush
