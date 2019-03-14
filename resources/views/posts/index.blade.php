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
    <ul>
        @foreach ($posts as $post)
            <li><a href="{{ route('blog.show',$post->slug) }}">{{ $post->title }}</a></li>
        @endforeach
    </ul>
    {{ $posts->links() }}
@else
    <p>Aucun article</p>
@endif
@stop