@extends('layouts.base')

@section('container')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           {{-- <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width: 150px;height:150px;float:left;border-radius:50%; margin-right:20px;"> --}}
           {{-- <h2>{{ Auth::user()->name }}</h2>
           <form action="{{ route('update_avatar') }}" enctype='multipart/form-data' method="POST">
                {{ csrf_field() }}
                <label for="">Changer l'avatar</label>
                <input type="file" name="avatar" id="">
                <input type="submit" value="Enregister" class="pull-right btn btn-sm btn-primary">
            </form> --}}
            {{-- <h2><a href="{{ route('forum.create') }}" class="badge badge-pill badge-primary">Ajouter un sujet</a></h2> --}}
            <h1>Admin dashbord</h1>
            <h2>T'es  connecté en tant qu ' <strong>ADMIN</strong> </h2>
        </div>
    </div>
</div>
@endsection
