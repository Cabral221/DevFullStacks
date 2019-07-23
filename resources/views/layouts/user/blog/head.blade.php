    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Abdourahmane Diop">
    <link rel="shortcut icon" href="{{ asset('user/assets/img/ico/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('user/assets/img/ico/apple-touch-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('user/assets/img/ico/apple-touch-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('user/assets/img/ico/apple-touch-icon-72x72.png')}}">
    <link rel="apple-touch-icon" href="{{ asset('user/assets/img/ico/apple-touch-icon-57x57.png')}}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('user/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('user/assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('user/assets/css/plugins.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('user/assets/css/style.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.css') }}">
    {{-- <link href="{{ asset('user/assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"> --}}
    <link href="{{ asset('user/assets/css/pe-icons.css')}}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.css') }}"> --}}

    @section('head')
        @show