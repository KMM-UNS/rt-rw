@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Manajemen Pengeluaran')

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
        <li class="breadcrumb-item"><a href="javascript:;">Pengeluaran</a></li>
        <li class="breadcrumb-item active">@yield('title')</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Pengeluaran<small> @yield('title')</small></h1>
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
        <!-- end panel-heading -->
        <!-- begin panel-body -->
        {{-- <div class="panel-body">
            {{ $dataTable->table() }}
        </div> --}}
        <a href="{{ url('admin/manajemen-keuangan/manajemen-pengeluaran/create') }}"
            class="btn btn-outline-info">CREATE</a>
        <form action="{{ route('admin.manajemen-keuangan.manajemen-pengeluaran.store') }}" id="form" name="form"
            method="POST" data-parsley-validate="true" enctype="multipart/form-data">
            @csrf
            @if (isset($data))
                {{ method_field('PUT') }}
            @endif
            <div class="panel-body">
                {{-- {{ $rekap }} --}}
                <a href="{{ url('admin/rekap-kas/export-rekapwajib') }}" class="btn btn-success"> Export To Excel</a>
                <a href="{{ url('admin/manajemen-keuangan/manajemen-pengeluaran/cetak_pdf') }}" class="btn btn-primary"
                    target="_blank">CETAK
                    PDF</a>
                <table border="1" cellpadding="2" class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nominal</th>
                            <th scope="col">Keterangan</th>

                        </tr>
                    </thead>

                    <tbody>
                        {{-- <tr>
                            <td>Kas Iuran Wajib</td>
                            <td>Rp.</td>

                        </tr>
                        <tr>
                            <td>Kas Iuran Kondisional</td>
                            <td>Rp.</td>
                        </tr>
                        <tr>
                            <td>Kas Iuran Sukarela</td>
                            <td>Rp.</td>
                        </tr>
                        <tr>
                            <td>Kas Iuran Agenda</td>
                            <td>Rp.</td>
                        </tr> --}}
                        @foreach ($pengeluarann as $item)
                            <tr>
                                <td>{{ $item->keterangan }}</td>
                                <td>Rp.{{ $item->nominal }}</td>
                            </tr>
                        @endforeach

                    </tbody>

                    <td><b>Total</b></td>
                    <td colspan="1"><b>Rp. {{ $pengeluarannn }}</b></td>



                </table>

            </div>
            <!-- end panel-body -->
        </form>
        <!-- end panel-body -->
    </div>

    <!-- end panel -->
@endsection
