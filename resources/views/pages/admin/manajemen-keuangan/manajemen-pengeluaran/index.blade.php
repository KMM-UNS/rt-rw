@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Manajemen Pengeluaran')

@push('css')
    <!-- datatables -->
    <link href="{{ asset('/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('/assets/plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" />
    <!-- end datatables -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
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
        <form action="{{ route('admin.manajemen-keuangan.manajemen-pengeluaran.store') }}" id="form" name="form"
            method="POST" data-parsley-validate="true" enctype="multipart/form-data">
            @csrf
            @if (isset($data))
                {{ method_field('PUT') }}
            @endif
            <div class="panel-body">
                {{-- {{ $rekap }} --}}
                <a href="{{ url('admin/manajemen-keuangan/manajemen-pengeluaran/create') }}"
                    class="btn btn-success">CREATE</a>
                <a href="{{ url('admin/manajemen-keuangan/manajemen-pengeluaran/cetak_pdf') }}" class="btn btn-primary"
                    target="_blank">CETAK
                    PDF</a>
                <table border="1" cellpadding="2" class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Nominal</th>
                            <th scope="col">Foto Bukti</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $no = 0;
                        @endphp
                        @foreach ($pengeluarann as $item)
                            <tr>
                                @php
                                    $no++;
                                @endphp
                                <td class="text-center">{{ $no }}</td>
                                <td>{{ date('d M Y', strtotime($item->tanggal)) }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>Rp.{{ number_format($item->nominal, 0) }}</td>
                                <td> <img src="{{ asset($item->dokumen->first()['public_url']) }}" alt="Foto Pengeluaran"
                                        width="200"></td>
                                <td>
                                    <form
                                        action="{{ route('admin.manajemen-keuangan.manajemen-pengeluaran.destroy', $item->id) }}"
                                        method="POST">
                                        <a class="btn btn-primary"
                                            href="{{ route('admin.manajemen-keuangan.manajemen-pengeluaran.edit', $item->id) }}">Edit</a>
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-flat show_confirm"
                                            data-toggle="tooltip" title='Delete'>Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <td></td>
                    <td></td>
                    <td colspan="cols-3"><b>Total</b></td>
                    <td colspan="cols-1"><b>Rp. {{ number_format($pengeluarannn, 0) }}</b></td>



                </table>

            </div>
            <!-- end panel-body -->
        </form>
        <!-- end panel-body -->
    </div>

    <!-- end panel -->
@endsection

@push('scripts')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: 'Anda yakin?',
                    text: "Data yang sudah dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endpush
