@extends('layouts.base',['title'=>'Forum'])

@section('container')
<p><h2>Interface Forum</h2></p>
<hr>
@if (!Auth::guest())
    <a href="{{ route('forum.create') }}" class="btn btn-primary">Créer un sujet</a>
@endif

<hr>
<div class="row justify-content-center">
    <div class="col-md-2">
        {{ $topic->user->name }}
        {{ $formatDate($topic->created_at) }}
    </div>
    <div class="col-md-8">
        <div class="topic">
            {{ $topic->topic }}
        </div>
    </div>
    <div class="col-md-2">
        Résolue
    </div>
</div>
<div class="row justify-content">
    <div class="col-md-8 col-md-offset-2 col-sm-10-col-sm-offset-1">
    {{-- Formulaire de commentaire --}}
    <form action="{{ route('blog.comment.store',$topic) }}" method="POST">
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
    </div> 
</div>

<div class="row justify-content">
    {{-- Liste des commentaires --}}
    @if (! $comments->isEmpty())
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
@stop