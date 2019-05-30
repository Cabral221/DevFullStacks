<!DOCTYPE html>
<html lang="en">

<head>

{{-- head --}}
@include('layouts.user.blog.head')

</head>

<body id="page-top" class="index">

    <div class="master-wrapper">

        <div class="preloader">
            <div class="preloader-img">
                <span class="loading-animation animate-flicker"><img src="{{ asset('user/assets/img/loading.GIF')}}" alt="loading"/></span>
            </div>
        </div>


        <!-- Navigation -->
        @include('layouts.user.blog.header')

        <div id="search-wrapper">
            <button type="button" class="close">×</button>
            <div class="vertical-center text-center">
                <form>
                    <input type="search" value="" placeholder="Enter Search Term" />
                    <button type="submit" class="btn btn-primary btn-white">Search</button>
                </form>
            </div>
        </div>

        <!-- Header -->
        @section('header')
            @show

        {{-- Main content --}}
        @section('main-content')
            @show

        {{-- footer --}}
        @include('layouts.user.blog.footer')

</body>

</html>
