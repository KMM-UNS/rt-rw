<!-- ================== BEGIN BASE JS ================== -->
<script src="{{ asset('/assets/js/app.min.js') }}"></script>
<script src="{{ asset('/assets/js/theme/default.min.js') }}"></script>
<!-- ================== END BASE JS ================== -->

<script src="{{ asset('/assets/js/custom/select2.autofocus.fix.js') }}"></script>
<script src="{{ $cdn ?? asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
@include('sweetalert::alert')
@stack('scripts')
