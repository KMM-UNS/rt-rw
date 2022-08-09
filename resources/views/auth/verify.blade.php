@extends('layouts.empty', ['paceTop' => true, 'bodyExtraClass' => 'bg-white'])

@section('title', 'Verifikasi')

@push('css')
<link href="{{ asset('/assets/plugins/smartwizard/dist/css/smart_wizard.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/css/default/style.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<!-- begin login -->
<div class="login login-with-news-feed">
    <!-- begin news-feed -->
    <div class="news-feed">
        <div class="news-image" style="background-image: url(/assets/img/login-bg/front.png)"></div>
        <div class="news-caption">
            <h4 class="caption-title"><b>e</b>RT RW</h4>
			<p>
				Sistem Informasi Layanan RT RW
			</p>
        </div>
    </div>
    <!-- end news-feed -->
    <!-- begin right-content -->
    <div class="right-content">
        <!-- begin login-header -->
        <div class="login-header mx-auto">
            <a href="#"><img src="{{asset('assets/img/login-bg/logo.png')}}" width="150"></a>
        </div>
        <!-- end login-header -->
        <!-- begin login-content -->
        <div class="login-content">
            <h6 class="text-center">
                {{ __('Verifikasi Nomor Telepon Anda') }}
            </h6>
            <div class="body">
                @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{session('error')}}
                </div>
                @endif
                <div class="text-center my-2">
                    Masukkan kode OTP yang sudah dikirim ke nomor:
                    <strong class="text-center my-3">
                        {{session('phone_number')}}
                    </strong>
                </div>
                <form action="{{route('verify')}}" method="post">
                    @csrf
                    <div class="form-group m-b-15">
                        <input type="hidden" name="phone_number" value="{{session('phone_number')}}">
                        <input id="otp" type="tel"
                                class="form-control @error('otp') is-invalid @enderror"
                                name="otp" value="{{ old('otp') }}" placeholder="{{ __('Kode OTP')}}" required>

                        @error('otp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="register-buttons">
                        <button type="submit" class="btn btn-success btn-block btn-lg">{{ __('Verifikasi') }}</button>
                    </div>

                </form>

                  <form action="{{route('resend')}}" method="post">
                    @csrf
                    <div class="form-group m-b-15">
                        <input type="hidden" name="phone_number" value="{{session('phone_number')}}">
                    </div>

                    <div class="register-buttons">
                        <button type="submit" class="btn btn-default btn-block btn-lg">{{ __('Kirim Ulang OTP') }}</button>
                    </div>

                </form>
            </div>
                <hr />
                <p class="text-center text-grey-darker">
                    &copy; <?= date('Y') ?> Mandiri Solusindo </p>
        </div>
       </div>
    <!-- end right-container -->
</div>
<!-- end login -->
@endsection

@push('script')
    <script src="{{ asset('/assets/plugins/parsleyjs/dist/parsley.js') }}"></script>
    <script src="{{ asset('/assets/js/parsley/language-id.js') }}"></script>
@endpush
