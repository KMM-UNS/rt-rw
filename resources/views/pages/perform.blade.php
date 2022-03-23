@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])
@section('title', 'Perform')

    @push('css')
        <link href="/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
        <link href="/assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />
        <link href="/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
        <link href="/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
    @endpush
@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Performa</a></li>
        <li class="breadcrumb-item active">Layanan</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Performa Layanan <small>Layanan</small></h1>
    <!-- end page-header -->
    <div class="row">
        <div class="col-12">
            <div class="panel panel-inverse" data-sortable-id="chart-js-2">
                <div class="panel-heading">
                    <h4 class="panel-title">Column Chart</h4>
                    <div class="panel-heading-btn">
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row form-group ">
                        <div class="col-md-12">
                            <div class="row row-space-10">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group">
                                            <input type="date" name="tanggal" class="form-control m-b-5" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">

                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <div class="input-group-text">Layanan</div>
                                        </div>
                                        <select name="layanan" class="select-2 form-control" id="layanan">
                                            <option value="skck">SKCK</option>
                                            <option value="skck">SPKT</option>
                                            <option value="skck">SKCK</option>
                                            <option value="skck">SKCK</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <button class="btn btn-primary btn-block"> <i class="fa fa-search"></i>
                                            Tampilkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="chart-js-2">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fa fa-chart"></i> Chart Jumlah Pelayanan per Wilayah</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                            data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                            data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div id="apex-bar-chart"></div>
                </div>
            </div>
            <!-- end panel -->
        </div>
        <div class="col-xl-6">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="chart-js-2">
                <div class="panel-heading">
                    <h4 class="panel-title">Rekap Jumlah layanan per wilayah</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                            data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                            data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Satuan Wilayah</td>
                                <td>Jumlah</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2</td>
                                <td>Polsek Satu</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Polsek Dua</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Polsek Tiga</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Polsek Empat</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Polsek Lima</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Polsek Enams</td>
                                <td>10</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end panel -->
        </div>
    </div>
@endsection
@push('scripts')
    <script src="/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
    <script src="/assets/js/demo/chart-apex.demo.js"></script>
    <script src="/assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
    <script src="/assets/plugins/gritter/js/jquery.gritter.js"></script>
    <script src="/assets/js/demo/dashboard-v2.js"></script>
@endpush
