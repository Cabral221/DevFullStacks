@extends('layouts.base',['title'=>'Forum'])

@section('container')
<h1> Bienvenue à DevFullStack</h1>
<p><h2>Interface Forum</h2></p>
<hr>
@if (!Auth::guest())
    <a href="{{ route('forum.create') }}" class="btn btn-primary">Créer un sujet</a>
@endif

<hr>
@if (! $topics->isEmpty())
    @foreach ($topics as $topic)
        <div class="row topic">
            <div class="col-md-2">{{ $topic->user->name }}</div>
            <div class="col-md-8">{{ $topic->topic }}</div>
            <div class="col-md-2">
                <a href="{{ route('forum.show',$topic) }}" class="badge badge-pill badge-primary">Lire la suite</a>
            </div>
        </div>        
    @endforeach
    {{ $topics->links() }}
@else
    <p>Pas de sujets pour le moment !</p>
@endif
@stop