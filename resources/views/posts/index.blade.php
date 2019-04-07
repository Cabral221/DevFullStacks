@extends('layouts.base',['title'=>'Blog'])

@section('container')
<p><h2>Interface Blog</h2></p>

@if (!Auth::guest())
    @if (Auth::user()->role)  
    <a href="{{ route('blog.create') }}" class="btn btn-primary">Créer un article</a>
    @endif
@endif

<h4>Nos Articles</h4>
@if (! $posts->isEmpty())
    <div class="row">
        @foreach ($posts as $post)
        <div class="col-4 mb-4">
            <div class="border border-dark rounded p-2">
                <div class="card-header">
                   <h3> {{ $post->title }} </h3>
                </div>
                <div class="card-text">
                   <p> {{ $post->body }} </p>
                </div>
                <a class="btn btn-primary" href="{{ route('blog.show',$post->slug) }}">Lire la suite</a>
                <a href="" class="btn btn-link">
                    <i class="far fa-thumbs-up"></i>
                    <span class="js-likes">10</span>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    {{-- <ul>
         @foreach ($posts as $post)
            <li><a href="{{ route('blog.show',$post->slug) }}">{{ $post->title }}</a></li>
        @endforeach
    </ul> --}}
    {{ $posts->links() }}
@else
    <p>Aucun article</p>
@endif
@stop