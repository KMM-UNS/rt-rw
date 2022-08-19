<meta charset="utf-8" />
<title>Color Admin @yield('title')</title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta content="" name="description" />
<meta content="" name="author" />

<!-- ================== BEGIN BASE CSS STYLE ================== -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
<link href="{{ asset('/assets/css/default/app.min.css') }}" rel="stylesheet" />
{{-- {{ HTML::style('assets/css/default/app.min.css') }} --}}
{{-- <link href="{{ URL::asset('assets/css/default/app.min.css') }}" rel="stylesheet"> --}}
<!-- ================== END BASE CSS STYLE ================== -->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" /> --}}

@stack('css')
