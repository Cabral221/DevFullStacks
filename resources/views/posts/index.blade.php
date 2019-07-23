{{-- @extends('layouts.base',['title'=>'Blog'])

@section('container')
<p><h2>Interface Blog</h2></p>

@if (!Auth::guest())
    @if (Auth::user()->role)  
    <a href="{{ route('blog.create') }}" class="btn btn-primary">Créer un article</a>
    @endif
@endif

<h4>Nos Articles</h4>
@if (! $posts->isEmpty())
    <div class="row text-center">
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
    {{-- <ul>
         @foreach ($posts as $post)
            <li><a href="{{ route('blog.show',$post->slug) }}">{{ $post->title }}</a></li>
        @endforeach
    </ul> --}}
    {{-- {{ $posts->links() }} --}}
{{-- @else --}}
    {{-- <p>Aucun article</p> --}}
{{-- @endif --}}
{{-- @stop --}} 

{{-- ---------------------------------------------------- --}}


@extends('layouts.user.blog.app')


@section('head')

    <style>
        .fa-heart:hover{
            color: red;
        }
    </style>
@endsection

@section('header')
    <header id="headerwrap" class="backstretched special-max-height">
        <div class="container vertical-center">
            <div class="intro-text vertical-center text-left smoothie">
                <div class="intro-heading wow fadeIn heading-font" data-wow-delay="0.2s">This Is Kompleet</div>
                <div class="intro-sub-heading wow fadeIn secondary-font" data-wow-delay="0.4s">Sur DevFullstack, vous avez <span class="rotate">des cours, des articles, un forum</span></div>
            </div>
        </div>
    </header>
@endsection


@section('main-content')
    <section>
            <div class="section-inner">
                <div class="container">
                    <div class="row" id="app">
                        {{--  --}}
                        @foreach ($posts as $post)                       
                        <div class="col-sm-4 blog-item mb100 wow match-height">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="hover-item mb30">
                                        <img src="{{ 
                                            ($post->image != null) ? Storage::disk('local')->url($post->image) : Storage::disk('local')->url($post->category->image) 
                                        }}" class="img-responsive smoothie" alt="title">
                                        <div class="overlay-item-caption smoothie"></div>
                                        <div class="hover-item-caption smoothie">
                                            <h3 class="vertical-center smoothie"><a href="{{ route('blog.show',$post) }}" class="smoothie btn btn-primary page-scroll" title="view article">Voir</a></h3>
                                        </div>
                                    </div>
                                    {{-- {{ dd($post->image != null) }} --}}
                                    <h2 class="post-title">{{ $post->title }}</h2>
                                    <div class="item-metas text-muted mb30">
                                        <span class="meta-item"><i class="fas fa-tag"></i> Catégorie <span>{{ $post->category->name }}</span></span>
                                        {{--  --}}
                                        <span class="meta-item">
                                            <a href="{{ route('post_like',$post->slug) }}" class="js-like">
                                                @if (auth()->user() && $post->isLikeByUser(auth()->user()))
                                                    <i class="fas fa-thumbs-up"></i>
                                                    <span class="js-likes"> {{ count($post->likes) }}</span>
                                                    <span class="js-label meta-item"> Je n'aime plus</span>
                                                @else
                                                    <i class="far fa-thumbs-up"></i>
                                                    <span class="js-likes"> {{ count($post->likes) }}</span>
                                                    <span class="js-label meta-item"> J'aime</span>
                                                @endif
                                            </a>
                                        </span>
                                        {{--  --}}
                                        <span class="meta-item"><i class="fas fa-comments"></i> Commentaire(s) <span>{{ $post->comments->count() }}</span></span>
                                    </div>
                                    <p>{!! $post->introduce !!}</p>
                                    <a class="btn btn-primary mt30" href="{{ route('blog.show',$post) }}">La suite</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{--  --}}
                    </div>

                    <div class="row paging text-center">
                        {{ $posts->links() }}
                        {{-- <a class="btn btn-primary mt30" href="#">Older Posts</a> --}}
                    </div>
                </div>
            </div>
        </section>

@endsection


@section('footer')
    <script type="text/javascript">
    $(document).ready(function() {
        'use strict';
        jQuery('#headerwrap').backstretch([
            "{{ asset('user/assets/img/bg/bg1.jpg')}}",
            "{{ asset('user/assets/img/bg/bg2.jpg')}}",
            "{{ asset('user/assets/img/bg/bg3.jpg')}}"
        ], {
            duration: 8000,
            fade: 500
        });
    });
    </script>
    <script src="{{ asset('js/jslike.js') }}"></script>
@endsection