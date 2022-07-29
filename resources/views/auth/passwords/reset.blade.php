@extends('layouts.empty', ['paceTop' => true, 'bodyExtraClass' => 'bg-white'])

@section('title', __('Atur Ulang Kata Sandi'))

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
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <form action="{{ request()->routeIs('admin*') ? route('admin.password.update') : route('password.update') }}" method="POST" class="margin-bottom-0" data-parsley-validate="true">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="form-group m-b-15">

                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $request->email ?? old('email') }}" data-parsley-required="true" autocomplete="email" placeholder="{{ __('E-Mail Address') }}">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group m-b-15">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" data-parsley-required="true" autocomplete="new-password" placeholder="{{ __('Kata Sandi Baru') }}" data-parsley-minlength="8"
                    data-parsley-errors-container=".errorspannewpassinput"
                    data-parsley-required-message="Masukkan kata sandi baru."
                    data-parsley-uppercase="1"
                    data-parsley-lowercase="1"
                    data-parsley-number="1">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group m-b-15">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" data-parsley-required="true" data-parsley-equalto="#password" autocomplete="new-password" placeholder="{{ __('Konfirmasi Kata Sandi') }}">
                </div>

                <div class="register-buttons">
                    <button type="submit" class="btn btn-success btn-block btn-lg">{{ __('Atur Ulang Kata Sandi') }}</button>
                </div>
                <p>
                    <br />
                    Ingat kata sandi? <a href="{{route('login')}}">Masuk</a>
                </p>
                <hr />
                <p class="text-center text-grey-darker">
                    &copy; <?= date('Y') ?> Mandiri Solusindo </p>
            </form>
        </div>
        <!-- end login-content -->
    </div>
    <!-- end right-container -->
</div>
<!-- end login -->
@endsection
