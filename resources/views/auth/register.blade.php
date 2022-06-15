@extends('layouts.empty', ['paceTop' => true, 'bodyExtraClass' => 'bg-white'])

@section('title', '')

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
            <form action="{{ route('register') }}" method="POST" class="margin-bottom-0">
                @csrf

                <div class="form-group m-b-15">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="{{ __('Nama') }}" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group m-b-15">

                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('Alamat Surel') }}">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group m-b-15">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('Kata Sandi') }}">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group m-b-15">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Konfirmasi Kata Sandi') }}">
                </div>

                <div class="register-buttons">
                    <button type="submit" class="btn btn-success btn-block btn-lg">{{ __('Register') }}</button>
                </div>
                <p>
                    <br />
                    Sudah punya akun? <a href="{{route('login')}}">Masuk</a>
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
