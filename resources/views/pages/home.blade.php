{{-- @extends('layouts.base',['title'=>'Welcome'])

@section('container')
<h1> Bienvenue à DevFullStack</h1>
<p>Cette page est l'accueil de notre Apli</p>
@stop --}}

@extends('layouts.user.blog.app')


@section('head')
<style></style>
@endsection

@section('header')
    <header id="headerwrap" class="backstretched special-max-height">
        <div class="container vertical-center">
            <div class="intro-text vertical-center text-left smoothie">
                <div class="intro-heading wow fadeIn heading-font" data-wow-delay="0.2s">Sur DevFullStack</div>
                <div class="intro-sub-heading wow fadeIn secondary-font" data-wow-delay="0.4s">vous verrez <span class="rotate">des cours, des articles, un forum</span></div>
            </div>
        </div>
    </header>
@endsection


@section('main-content')
    <section>
        <div class="section-inner">
            <div class="container">
                <h1> Bienvenue à DevFullStack</h1>
                <p>Cette page est l'accueil de notre Apli</p>
            </div>
        </div>
    </section>
@endsection


@section('footer')
    <script type="text/javascript">
    $(document).ready(function() {
        'use strict';
        jQuery('#headerwrap').backstretch([
            "{{ asset('user/assets/img/bg/bg1.jpg')}}",
            "{{ asset('user/assets/img/bg/bg2.jpg')}}",
            "{{ asset('user/assets/img/bg/bg3.jpg')}}"
        ], {
            duration: 8000,
            fade: 500
        });
    });
    </script>
@endsection

