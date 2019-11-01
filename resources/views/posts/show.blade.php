{{-- @extends('layouts.base',['title'=>$post->title])

@section('container')
<div class="justify-content-center">
<p><h2>Interface Blog</h2></p>
<div class="blog-post">
    <h3 class="blog-post-title">{!! $post->title !!}</h3>
    <p class="blog-post-meta">publié le {{ $post->created_at }}</p>
    <p>{!! $post->introduce !!}</p>
    <p>{!! $post->body !!}</p>
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
    {{-- <form action="{{ route('blog.comment.store',$post) }}" method="POST">
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
    </form> --}}
    
    {{-- Liste des commentaires --}}
    {{-- @if (! $comments->isEmpty())
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
@stop --}} 

@extends('layouts.user.blog.app')

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/prism.css') }}">
    <style>
        .fa-heart:hover{
            color: red;
        }
    </style>
@endsection

@section('header')
    <section class="dark-wrapper opaqued parallax" data-parallax="scroll" data-image-src="{{ ($post->image != null) ? Storage::disk('local')->url($post->image) : Storage::disk('local')->url($post->category->image) }}" data-speed="0.7">
        <div class="section-inner text-center">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 mt30 wow">
                        <h2 class="section-heading">{!! $post->title !!}</h2>
                        <div class="item-metas text-muted mb30 white">
                            <span class="meta-item">
                                <a href="{{ route('category',$post->category->slug) }}">
                                    <i class="pe-icon pe-7s-ticket"></i> Catégorie <span>{{ $post->category->name }}</span>
                                </a>
                            </span>
                            <span class="meta-item"><i class="pe-icon pe-7s-user"></i> Auteur <span>{{ $post->admin->name }}</span></span>
                            {{-- <span class="meta-item"><i class="pe-icon pe-7s-comment"></i> COMMENTS <span>3</span></span> --}}
                            <span class="meta-item post-date"><i class="pe-icon pe-7s-clock"></i> Posté <span>{{  $post->created_at->diffForHumans() }}</span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('main-content')
    <section>
        <div class="section-inner">
            <div class="container">
                <div class="row">
                    <div id="post-content" class="col-sm-8 col-sm-offset-2 blog-item mb60 wow">
                        <div class="row">
                            <div class="col-sm-12 single-post-content">
                                    <a href="{{ route('category',$post->category) }}">
                                        <i class="pe-icon pe-7s-ticket"></i> Catégorie <span>{{ $post->category->name }}</span>
                                    </a>
                                    {{--  --}}
                                    <span class="pull-right">
                                        <a href="{{ route('post_like',$post->slug) }}" class="js-like">
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
                                    </span>
                                    {{--  --}}
                                <p>{!! $post->body !!}</p>
                                <div data-easyshare data-easyshare-url="http://www.distinctivethemes.com/">
                                    <!-- Total -->
                                    <button data-easyshare-button="total">
                                        <span>Total</span>
                                    </button>
                                    <span data-easyshare-total-count>0</span>

                                    <!-- Facebook -->
                                    <button data-easyshare-button="facebook">
                                        <span>Share</span>
                                    </button>
                                    <span data-easyshare-button-count="facebook">0</span>

                                    <!-- Twitter -->
                                    <button data-easyshare-button="twitter" data-easyshare-tweet-text="">
                                        <span>Tweet</span>
                                    </button>
                                    <span data-easyshare-button-count="twitter">0</span>

                                    <!-- Google+ -->
                                    <button data-easyshare-button="google">
                                        <span>+1</span>
                                    </button>
                                    <span data-easyshare-button-count="google">0</span>

                                    <div data-easyshare-loader>Loading...</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="comments-list" class="col-sm-8 col-sm-offset-2 gap wow">
                        <div class="mt60 mb50 single-section-title">
                            <h3>{{ $post->comments->count() }} Comment(s)</h3>
                        </div>
                        <div class="allComment" style="height:1000px;background-color:#DDD">
                            <div id="appComment">
                                <comments 
                                    :id='{{ $post->id }}' 
                                    type='Post' ip="f528764d624db129b32c21fbca0cb8d6"></comments>
                                {{-- <comments model="Post" id="1"></comments> --}}
                            </div>
                        </div>
                        {{-- <div class="media">
                            <div class="pull-left">
                                <img class="avatar comment-avatar" src="assets/img/users/1.jpg" alt="">
                            </div>
                            <div class="media-body">
                                <div class="well">
                                    <div class="media-heading">
                                        <span class="heading-font">Dave Evans</span>&nbsp; <small class="secondary-font">30th Jan, 2015</small>
                                    </div>
                                    <p>Was are delightful solicitude discovered collecting man day. Resolving neglected sir tolerably but existence conveying for. Day his put off unaffected literature partiality inhabiting.</p>
                                    <a class="btn btn-primary pull-right" href="#">Reply</a>
                                </div>
                                <div class="media">
                                    <div class="pull-left">
                                        <img class="avatar comment-avatar" src="assets/img/users/2.jpg" alt="">
                                    </div>
                                    <div class="media-body">
                                        <div class="well">
                                            <div class="media-heading">
                                                <span class="heading-font">Dave Evans</span>&nbsp; <small>30th Jan, 2015</small>
                                            </div>
                                            <p>Wicket longer admire do barton vanity itself do in it. Preferred to sportsmen it engrossed listening. Park gate sell they west hard for the. Abode stuff noisy manor blush yet the far. Up colonel so between removed so do.</p>
                                            <a class="btn btn-primary pull-right" href="#">Reply</a>
                                        </div>
                                    </div>
                                </div>
                                <!--/.media-->
                            </div>
                        </div> --}}
                        <!--/.media-->
                        {{-- <div class="media">
                            <div class="pull-left">
                                <img class="avatar comment-avatar" src="assets/img/users/3.jpg" alt="">
                            </div>
                            <div class="media-body">
                                <div class="well">
                                    <div class="media-heading">
                                        <span class="heading-font">Dave Evans</span>&nbsp; <small>30th Jan, 2015</small>
                                    </div>
                                    <p>Quitting informed concerns can men now. Projection to or up conviction uncommonly delightful continuing. In appetite ecstatic opinions hastened by handsome admitted.</p>
                                    <a class="btn btn-primary pull-right" href="#">Reply</a>
                                </div>
                            </div>
                        </div> --}}
                        <!--/.media-->

                        {{-- <div id="comments-form" class="row wow">
                            <div class="col-md-12">
                                <div class="mt60 mb50 single-section-title">
                                    <h3>Leave A Reply</h3>
                                </div>
                                <div id="comment_message"></div>
                                <form method="post" id="commentform" class="comment-form">
                                    <input type="text" class="form-control col-md-4" name="name1" placeholder="Your Name *" id="name1" required data-validation-required-message="Please enter your name." />
                                    <input type="text" class="form-control col-md-4" name="email1" placeholder="Your Email *" id="email1" required data-validation-required-message="Please enter your email address." />
                                    <input type="text" class="form-control col-md-4" name="website1" placeholder="Your URL *" id="website1" required data-validation-required-message="Please enter your web address." />
                                    <textarea name="comments1" class="form-control" id="comments1" placeholder="Your Message *" required data-validation-required-message="Please enter a message."></textarea>
                                    <a class="btn btn-primary pull-right" href="#">Reply</a>
                                </form>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    <script src="{{ asset('js/prism.js') }}"></script>
    <script src="{{ asset('js/jslikeone.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection