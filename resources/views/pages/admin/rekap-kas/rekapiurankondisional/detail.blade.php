@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Rekap Iuran Wajib')

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

            <table border="1" cellpadding="2">
                <thead>
                    <tr>
                        <th>Jenis Iuran</th>
                        <th>Penerima</th>
                        <th>Pemberi</th>
                        <th>Total Biaya</th>
                        <th>Image</th>
                    </tr>
                </thead>
                @foreach ($rekap as $item)
                    <tbody>
                        <tr>
                            <td>{{ $item->iurankondisional->nama }}</td>
                            <td>{{ $item->petugastagihan->nama }}</td>
                            <td>{{ $item->pemberi }}</td>
                            <td>{{ $item->total_biaya }}</td>
                            <td> <img src="{{ asset($item->dokumen[0]['public_url']) }}" alt=""></td>
                        </tr>

                    </tbody>
                @endforeach

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