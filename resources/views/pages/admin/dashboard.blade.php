@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])
@section('title', 'Dashboard')

@push('css')
<link href="/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
<link href="/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
<link href="/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
@endpush

@section('content')
<h1 class="page-header mb-3 text-center">Statistik Warga</h1>

<div class="row">
    <div class="col-xl-8">
        <div class="card border-0 bg-white text-white mb-3 overflow-hidden">
            <div class="card-body">

            </div>
        </div>
        <!-- end product -->
        <!-- begin product -->
        <div class="d-flex align-items-center m-b-15">
          <div class="widget-img rounded-lg width-30 m-r-10 bg-white p-3">
            <div class="h-100 w-100" style="background: url(/assets/img/product/product-10.jpg) center no-repeat; background-size: auto 100%;"></div>
          </div>
          <div class="text-truncate">
            <div>Apple iPhone XS Max (2019)</div>
            <div class="text-grey">$3,399</div>
          </div>
          <div class="ml-auto text-center">
            <div class="f-s-13"><span data-animation="number" data-value="129">0</span></div>
            <div class="text-grey f-s-10">sold</div>
          </div>
        </div>
        <!-- end product -->
        <!-- begin product -->
        <div class="d-flex align-items-center m-b-15">
          <div class="widget-img rounded-lg width-30 m-r-10 bg-white p-3">
            <div class="h-100 w-100" style="background: url(/assets/img/product/product-11.jpg) center no-repeat; background-size: auto 100%;"></div>
          </div>
          <div class="text-truncate">
            <div>Huawei Y5 (2019)</div>
            <div class="text-grey">$99.00</div>
          </div>
          <div class="ml-auto text-center">
            <div class="f-s-13"><span data-animation="number" data-value="96">0</span></div>
            <div class="text-grey f-s-10">sold</div>
          </div>
        </div>
        <!-- end product -->
        <!-- begin product -->
        <div class="d-flex align-items-center">
          <div class="widget-img rounded-lg width-30 m-r-10 bg-white p-3">
            <div class="h-100 w-100" style="background: url(/assets/img/product/product-12.jpg) center no-repeat; background-size: auto 100%;"></div>
          </div>
          <div class="text-truncate">
            <div>Huawei Nova 4 (2019)</div>
            <div class="text-grey">$499.00</div>
          </div>
          <div class="ml-auto text-center">
            <div class="f-s-13"><span data-animation="number" data-value="55">0</span></div>
            <div class="text-grey f-s-10">sold</div>
          </div>
        </div>
        <!-- end product -->
      </div>
      <!-- end card-body -->
    </div>
    <!-- end card -->
  </div>
  <!-- end col-4 -->
  <!-- begin col-4 -->
  <div class="col-xl-4 col-lg-6">
    <!-- begin card -->
    <div class="card border-0 bg-dark text-white mb-3">
      <!-- begin card-body -->
      <div class="card-body">
        <!-- begin title -->
        <div class="mb-3 text-grey">
          <b>MARKETING CAMPAIGN</b>
          <span class="ml-2"><i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-title="Marketing Campaign" data-placement="top" data-content="Campaign that run for getting more returning customers."></i></span>
        </div>
        <!-- end title -->
        <!-- begin row -->
        <div class="row align-items-center p-b-1">
          <!-- begin col-4 -->
          <div class="col-4">
            <div class="height-100 d-flex align-items-center justify-content-center">
              <img src="/assets/img/svg/img-2.svg" class="mw-100 mh-100" />
    <div class="col-xl-4">
        <div class="card border-0 bg-white mb-3 overflow-hidden">
            <div class="card-body">
                {!! $genderChart->container() !!}
            </div>
          </div>
          <!-- end col-4 -->
          <!-- begin col-8 -->
          <div class="col-8">
            <div class="m-b-2 text-truncate">Email Marketing Campaign</div>
            <div class="text-grey m-b-2 f-s-11">Mon 12/6 - Sun 18/6</div>
            <div class="d-flex align-items-center m-b-2">
              <div class="flex-grow-1">
                <div class="progress progress-xs rounded-corner bg-white-transparent-1">
                  <div class="progress-bar progress-bar-striped bg-indigo" data-animation="width" data-value="80%" style="width: 0%"></div>
                </div>
              </div>
              <div class="ml-2 f-s-11 width-30 text-center"><span data-animation="number" data-value="80">0</span>%</div>
            </div>
            <div class="text-grey f-s-11 m-b-15 text-truncate">
              57.5% people click the email
            </div>
            <a href="#" class="btn btn-xs btn-indigo f-s-10 pl-2 pr-2">View campaign</a>
          </div>
          <!-- end col-8 -->
        </div>
        <div class="card border-0 bg-white mb-3 overflow-hidden">
            <div class="card-body">
                {!! $pendidikanChart->container() !!}
            </div>
        </div>
        <div class="card border-0 bg-white mb-3 overflow-hidden">
            <div class="card-body">
                {!! $pekerjaanChart->container() !!}
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')

<!-- genderChart script -->
<script src="{{ $genderChart->cdn() }}"></script>
{{ $genderChart->script() }}

<!-- pendidikanChart script -->
<script src="{{ $pendidikanChart->cdn() }}"></script>
{{ $pendidikanChart->script() }}

<!-- pekerjaanChart script -->
<script src="{{ $pekerjaanChart->cdn() }}"></script>
{{ $pekerjaanChart->script() }}

<script src="/assets/plugins/d3/d3.min.js"></script>
<script src="/assets/plugins/nvd3/build/nv.d3.js"></script>
<script src="/assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
<script src="/assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js"></script>
<script src="/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
<script src="/assets/plugins/moment/moment.js"></script>
<script src="/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="/assets/js/demo/dashboard-v3.js"></script>
@endpush
