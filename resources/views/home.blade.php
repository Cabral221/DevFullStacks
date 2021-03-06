@extends('layouts.user.blog.app')

@section('head')

    <style>
        .fa-heart:hover{
            color: red;
        }
    </style>
@endsection

@section('header')
    <section class="dark-wrapper opaqued parallax" data-parallax="scroll" data-image-src="{{ Storage::disk('local')->url("user-home") }}" data-speed="0.7">
        <div class="section-inner">
            <div class="container">
                <br><br>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width: 150px;height:150px;float:left;border-radius:50%; margin-right:20px;">
                        <h2>{{ Auth::user()->name }}</h2>
                        <form action="{{ route('update_avatar') }}" enctype='multipart/form-data' method="POST">
                            {{ csrf_field() }}
                            <label for="">Changer l'avatar</label>
                            <input type="file" name="avatar" id="">
                            <input type="submit" value="Enregister" class="pull-right btn btn-sm btn-primary">
                        </form>
                        {{-- <h2><a href="{{ route('forum.create') }}" class="badge badge-pill badge-primary">Ajouter un sujet</a></h2> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width: 150px;height:150px;float:left;border-radius:50%; margin-right:20px;">
           <h2>{{ Auth::user()->name }}</h2>
           <form action="{{ route('update_avatar') }}" enctype='multipart/form-data' method="POST">
                {{ csrf_field() }}
                <label for="">Changer l'avatar</label>
                <input type="file" name="avatar" id="">
                <input type="submit" value="Enregister" class="pull-right btn btn-sm btn-primary">
            </form>
            {{-- <h2><a href="{{ route('forum.create') }}" class="badge badge-pill badge-primary">Ajouter un sujet</a></h2> --}}
        </div>
    </div>
</div>
@endsection
