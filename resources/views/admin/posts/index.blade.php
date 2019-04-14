@extends('layouts.base')

@section('container')
    <p>Bonjour</p>
    <div class="row">
    @foreach ($posts as $post)
        <div class="col-4 mb-4 text-left">
            <div class="border border-dark rounded p-2">
                <div class="card-header">
                   <h3> {{ $post->title }} </h3>
                   @if ($post->category)
                       <p><em>{{ $post->category->name }}</em></p>
                   @endif
                </div>
                <div class="card-text">
                   <p> {!! $post->introduce !!} </p>
                </div>
                <a class="btn btn-primary" href="{{ route('blog.show',$post->slug) }}">Lire la suite</a>
                <a href="{{ route('post_like',$post->slug) }}" class="btn btn-link js-like">
                    @if (auth()->user() && $post->isLikeByUser(auth()->user()))
                        <i class="fas fa-thumbs-up"></i>
                        <span class="js-likes">{{ count($post->likes) }}</span>
                        <span class="js-label">Je n'aime plus</span>
                    @else
                        <i class="far fa-thumbs-up"></i>
                        <span class="js-likes">{{ count($post->likes) }}</span>
                        <span class="js-label">J'aime</span>
                    @endif
                </a>
            </div>
        </div>
    @endforeach
    </div>
@endsection