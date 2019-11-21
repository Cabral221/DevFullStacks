@extends('layouts.user.blog.app')


@section('head')
<style></style>
@endsection

@section('header')
    <header id="headerwrap" class="backstretched special-max-height">
        <div class="container vertical-center">
            <div class="intro-text vertical-center text-left smoothie">
                <div class="intro-heading wow fadeIn heading-font" data-wow-delay="0.2s">DevFullStacks</div>
                <div class="intro-sub-heading wow fadeIn secondary-font" data-wow-delay="0.4s">vous verrez <span class="rotate">des cours, des articles, un forum</span></div>
            </div>
        </div>
    </header>
@endsection


@section('main-content')
    <section>
        <div class="section-inner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12"><h2>Mes derniers articles...</h2></div>
                    @foreach ($posts as $post)
                        <div class="col-sm-4 mb100 wow match-height">
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
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12"><h2>Mes derniers formations...</h2> </div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4"></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12"><h2>Les derniers sujets...</h2> </div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4"></div>
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
@endsection

