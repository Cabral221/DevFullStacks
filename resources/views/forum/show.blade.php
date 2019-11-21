@extends('layouts.user.blog.app',['title'=>'Forum'])

@section('header')
    <section class="dark-wrapper opaqued parallax" data-parallax="scroll" data-image-src="#" data-speed="0.7">
        <div class="section-inner text-center">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 mt150 wow">
                        <h2 class="section-heading">{!! $topic->title !!}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center  mt20">
                @if (!Auth::guest())
                    <a href="{{ route('forum.create') }}" class="btn btn-primary">Créer un sujet</a>
                @endif
            </div>
        </div>
        <hr>
        <div class="container-forum">
            <div class="row justify-content-center">

                <div class="col-md-10 col-md-offset-1">
                    <div class="media media-topic">
                        <div class="pull-left">
                            <a href="#">
                                <img class="media-object" src="/uploads/avatars/{{ $topic->user->avatar }}" alt="..." style="width: 64px;height:64px;postion:absolute; top:10px; left:10px;border-radius:50%;">
                            </a>
                        </div>
                        <div class="media-body">
                            <h6 class="media-heading">{{ $topic->user->name }}</h6>
                            <p><b>#{{ $topic->id }}</b> {{ $topic->title }}</p>
                            <br>
                            <p>{!! $topic->topic !!}</p>
                            <p class="pull-right"><small>{{ $formatDate($topic->created_at) }}</small></p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row justify-content-center">
                <div class="col-md-8 col-md-offset-2">
                {{-- Liste des commentaires --}}
                    @if (! $comments->isEmpty())
                        <h4>#{{ $comments->count() }} réponses</h4>
                        @foreach ($comments as $comment)
                            <div class="media media-topic">
                                <div class="pull-left">
                                    <a href="#">
                                        <img class="media-object" src="/uploads/avatars/{{ $comment->user->avatar }}" alt="..." style="width: 64px;height:64px;postion:absolute; top:10px; left:10px;border-radius:50%;">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <blockquote class="blockquote">
                                        <h6 class="media-heading">{{ $comment->user->name }}</h6>
                                        <p>{!! $comment->comment !!}</p>

                                        <p class="pull-right"><small>{{ $formatDate($comment->created_at) }}</small></p>
                                    </blockquote>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>Pas de commentaires pour le moment</p>
                    @endif
                </div>
            </div>

            
            <div class="row justify-content">
                <div class="col-md-8 col-md-offset-2 col-sm-10-col-sm-offset-1 container-form-forum">
                    {{-- Formulaire de commentaire --}}
                    <form action="{{ route('forum.comment.store',$topic) }}" method="POST">
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
           
        </div>
        

        
    </div>
@stop