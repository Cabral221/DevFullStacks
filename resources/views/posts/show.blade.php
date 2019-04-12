@extends('layouts.base',['title'=>$post->title])

@section('container')
<div class="justify-content-center">
<p><h2>Interface Blog</h2></p>
<div class="blog-post">
    <h3 class="blog-post-title">{{ $post->title }}</h3>
    <p class="blog-post-meta">publié le {{ $post->created_at }}</p>
    <p>{{ $post->introduce }}</p>
    <p>{{ $post->body }}</p>
    <div class="vote text-center">
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

@if (!Auth::guest())
    @if (Auth::user()->role && Auth::user()->id == $post->user_id)    
        <hr>
        <a class="btn btn-primary" href="{{ route('blog.edit',$post) }}">Modifier l'article</a>
        <form action="{{ route('blog.destroy',$post) }}" method="POST" class="form-inline-block">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="submit" value="Supprimer" class="btn btn-danger">
        </form>
    @endif
@endif
<hr>
<div class="col-md-8 col-md-offset-4 col-sm-10 col-sm-offset-2">
    {{-- Formulaire de commentaire --}}
    <form action="{{ route('blog.comment.store',$post) }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
            <label for="comment" class="control-label sr-only">commentaire</label>
            <textarea name="comment" id="comment" cols="10" rows="4" class="form-control" placeholder="Vos commentaires ici" required></textarea>
            {!! $errors->first('comment','<span class="help-block">:message</span>') !!}                
        </div>
        <div class="form-group">
            @if (Auth::guest())
                <a href="{{ route('login') }}" class="btn btn-block btn-primary">connectez-vous pour laisser un commentaire</a>
            @else
                <button type="submit" class="btn btn-block btn-primary">Commentez</button>
            @endif
        </div>
    </form>
    {{-- Liste des commentaires --}}
    @if (! $comments->isEmpty())
    <h4>#{{ $comments->count()}} commentaires</h4>
        @foreach ($comments as $comment)
            <div class="comment">
            <blockquote class="blockquote">
                <footer class="blockquote-footer">{{ $comment->user->name }} -- <cite title="Source Title">{{ $comment->updated_at }}</cite></footer>
                <p class="mb-0"><small>{{ $comment->comment }}</small></p>
                @if (!Auth::guest())
                    @if (Auth::user()->role && Auth::user()->id == $post->user_id)  
                        <div class="action">
                            <form action="{{ route('blog.comment.destroy',['post'=>$post,'comment'=>$comment]) }}" method="POST" class="form-inline-block">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="submit" value="Supprimer" class="btn btn-danger">
                            </form>
                        </div>
                    @endif
                @endif
            </blockquote>
            </div>
        @endforeach
    @else
        <p>Pas de commentaires pour le moment</p>
    @endif
</div>
</div>
@stop
@section('javascript')
    <script src="{{ asset('js/jslike.js') }}"></script>    
@endsection