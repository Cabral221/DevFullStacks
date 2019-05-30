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
        <link href="" rel="stylesheet">
@endsection

@section('header')
    <header id="headerwrap" class="backstretched special-max-height">
        <div class="container vertical-center">
            <div class="intro-text vertical-center text-left smoothie">
                <div class="intro-heading wow fadeIn heading-font" data-wow-delay="0.2s">This Is Kompleet</div>
                <div class="intro-sub-heading wow fadeIn secondary-font" data-wow-delay="0.4s">Take a look our <span class="rotate">awesome home pages, sexy portfolio items, flexible blog examples</span></div>
            </div>
        </div>
    </header>
@endsection


@section('main-content')
    <section>
            <div class="section-inner">
                <div class="container">
                    <div class="row">

                        <div class="col-sm-4 blog-item mb100 wow match-height">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="hover-item mb30">
                                        <img src="{{ asset('user/assets/img/news/1.jpg') }}" class="img-responsive smoothie" alt="title">
                                        <div class="overlay-item-caption smoothie"></div>
                                        <div class="hover-item-caption smoothie">
                                            <h3 class="vertical-center smoothie"><a href="{{ route('blog.show','mon-premier-article') }}" class="smoothie btn btn-primary page-scroll" title="view article">View</a></h3>
                                        </div>
                                    </div>
                                    <h2 class="post-title">The Ultimate Experience</h2>
                                    <div class="item-metas text-muted mb30">
                                        <span class="meta-item"><i class="pe-icon pe-7s-folder"></i> POSTED IN <span>News</span></span>
                                        <span class="meta-item"><i class="pe-icon pe-7s-ticket"></i> TAGS <span>Photography</span></span>
                                        <span class="meta-item"><i class="pe-icon pe-7s-user"></i> AUTHOR <span>Danny Jones</span></span>
                                        <span class="meta-item"><i class="pe-icon pe-7s-comment"></i> COMMENTS <span>3</span></span>
                                    </div>
                                    <p>Behind sooner dining so window excuse he summer. Breakfast met certainty and fulfilled propriety led. Waited get either are wooded little her. Contrasted unreserved as mr particular collecting it everything as indulgence. Seems ask meant merry could put. Age old begin had boy noisy table front whole given.</p>
                                    <a class="btn btn-primary mt30" href="{{ route('blog.show','mon-premier-article') }}">Read More</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 blog-item mb100 wow match-height">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="hover-item mb30">
                                        <img src="{{ asset('user/assets/img/news/2.jpg')}}" class="img-responsive smoothie" alt="title">
                                        <div class="overlay-item-caption smoothie"></div>
                                        <div class="hover-item-caption smoothie">
                                            <h3 class="vertical-center smoothie"><a href="single-post-right-sidebar.html" class="smoothie btn btn-primary page-scroll" title="view article">View</a></h3>
                                        </div>
                                    </div>
                                    <h2 class="post-title">The Ultimate Experience</h2>
                                    <div class="item-metas text-muted mb30">
                                        <span class="meta-item"><i class="pe-icon pe-7s-folder"></i> POSTED IN <span>News</span></span>
                                        <span class="meta-item"><i class="pe-icon pe-7s-ticket"></i> TAGS <span>Photography</span></span>
                                        <span class="meta-item"><i class="pe-icon pe-7s-user"></i> AUTHOR <span>Danny Jones</span></span>
                                        <span class="meta-item"><i class="pe-icon pe-7s-comment"></i> COMMENTS <span>3</span></span>
                                    </div>
                                    <p>Behind sooner dining so window excuse he summer. Breakfast met certainty and fulfilled propriety led. Waited get either are wooded little her. Contrasted unreserved as mr particular collecting it everything as indulgence. Seems ask meant merry could put. Age old begin had boy noisy table front whole given.</p>
                                    <a class="btn btn-primary mt30" href="single-post-right-sidebar.html">Read More</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 blog-item mb100 wow match-height">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="hover-item mb30">
                                        <img src="{{ asset('user/assets/img/news/3.jpg')}}" class="img-responsive smoothie" alt="title">
                                        <div class="overlay-item-caption smoothie"></div>
                                        <div class="hover-item-caption smoothie">
                                            <h3 class="vertical-center smoothie"><a href="single-post-right-sidebar.html" class="smoothie btn btn-primary page-scroll" title="view article">View</a></h3>
                                        </div>
                                    </div>
                                    <h2 class="post-title">The Ultimate Experience</h2>
                                    <div class="item-metas text-muted mb30">
                                        <span class="meta-item"><i class="pe-icon pe-7s-folder"></i> POSTED IN <span>News</span></span>
                                        <span class="meta-item"><i class="pe-icon pe-7s-ticket"></i> TAGS <span>Photography</span></span>
                                        <span class="meta-item"><i class="pe-icon pe-7s-user"></i> AUTHOR <span>Danny Jones</span></span>
                                        <span class="meta-item"><i class="pe-icon pe-7s-comment"></i> COMMENTS <span>3</span></span>
                                    </div>
                                    <p>Behind sooner dining so window excuse he summer. Breakfast met certainty and fulfilled propriety led. Waited get either are wooded little her. Contrasted unreserved as mr particular collecting it everything as indulgence. Seems ask meant merry could put. Age old begin had boy noisy table front whole given.</p>
                                    <a class="btn btn-primary mt30" href="single-post-right-sidebar.html">Read More</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 blog-item mb100 wow match-height">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="hover-item mb30">
                                        <img src="{{ asset('user/assets/img/news/4.jpg')}}" class="img-responsive smoothie" alt="title">
                                        <div class="overlay-item-caption smoothie"></div>
                                        <div class="hover-item-caption smoothie">
                                            <h3 class="vertical-center smoothie"><a href="single-post-right-sidebar.html" class="smoothie btn btn-primary page-scroll" title="view article">View</a></h3>
                                        </div>
                                    </div>
                                    <h2 class="post-title">The Ultimate Experience</h2>
                                    <div class="item-metas text-muted mb30">
                                        <span class="meta-item"><i class="pe-icon pe-7s-folder"></i> POSTED IN <span>News</span></span>
                                        <span class="meta-item"><i class="pe-icon pe-7s-ticket"></i> TAGS <span>Photography</span></span>
                                        <span class="meta-item"><i class="pe-icon pe-7s-user"></i> AUTHOR <span>Danny Jones</span></span>
                                        <span class="meta-item"><i class="pe-icon pe-7s-comment"></i> COMMENTS <span>3</span></span>
                                    </div>
                                    <p>Behind sooner dining so window excuse he summer. Breakfast met certainty and fulfilled propriety led. Waited get either are wooded little her. Contrasted unreserved as mr particular collecting it everything as indulgence. Seems ask meant merry could put. Age old begin had boy noisy table front whole given.</p>
                                    <a class="btn btn-primary mt30" href="single-post-right-sidebar.html">Read More</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 blog-item mb100 wow match-height">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="hover-item mb30">
                                        <img src="{{ asset('user/assets/img/news/5.jpg')}}" class="img-responsive smoothie" alt="title">
                                        <div class="overlay-item-caption smoothie"></div>
                                        <div class="hover-item-caption smoothie">
                                            <h3 class="vertical-center smoothie"><a href="single-post-right-sidebar.html" class="smoothie btn btn-primary page-scroll" title="view article">View</a></h3>
                                        </div>
                                    </div>
                                    <h2 class="post-title">The Ultimate Experience</h2>
                                    <div class="item-metas text-muted mb30">
                                        <span class="meta-item"><i class="pe-icon pe-7s-folder"></i> POSTED IN <span>News</span></span>
                                        <span class="meta-item"><i class="pe-icon pe-7s-ticket"></i> TAGS <span>Photography</span></span>
                                        <span class="meta-item"><i class="pe-icon pe-7s-user"></i> AUTHOR <span>Danny Jones</span></span>
                                        <span class="meta-item"><i class="pe-icon pe-7s-comment"></i> COMMENTS <span>3</span></span>
                                    </div>
                                    <p>Behind sooner dining so window excuse he summer. Breakfast met certainty and fulfilled propriety led. Waited get either are wooded little her. Contrasted unreserved as mr particular collecting it everything as indulgence. Seems ask meant merry could put. Age old begin had boy noisy table front whole given.</p>
                                    <a class="btn btn-primary mt30" href="single-post-right-sidebar.html">Read More</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 blog-item mb100 wow match-height">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="hover-item mb30">
                                        <img src="{{ asset('user/assets/img/news/6.jpg')}}" class="img-responsive smoothie" alt="title">
                                        <div class="overlay-item-caption smoothie"></div>
                                        <div class="hover-item-caption smoothie">
                                            <h3 class="vertical-center smoothie"><a href="single-post-right-sidebar.html" class="smoothie btn btn-primary page-scroll" title="view article">View</a></h3>
                                        </div>
                                    </div>
                                    <h2 class="post-title">The Ultimate Experience</h2>
                                    <div class="item-metas text-muted mb30">
                                        <span class="meta-item"><i class="pe-icon pe-7s-folder"></i> POSTED IN <span>News</span></span>
                                        <span class="meta-item"><i class="pe-icon pe-7s-ticket"></i> TAGS <span>Photography</span></span>
                                        <span class="meta-item"><i class="pe-icon pe-7s-user"></i> AUTHOR <span>Danny Jones</span></span>
                                        <span class="meta-item"><i class="pe-icon pe-7s-comment"></i> COMMENTS <span>3</span></span>
                                    </div>
                                    <p>Behind sooner dining so window excuse he summer. Breakfast met certainty and fulfilled propriety led. Waited get either are wooded little her. Contrasted unreserved as mr particular collecting it everything as indulgence. Seems ask meant merry could put. Age old begin had boy noisy table front whole given.</p>
                                    <a class="btn btn-primary mt30" href="single-post-right-sidebar.html">Read More</a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row paging text-center">
                        <a class="btn btn-primary mt30" href="#">Older Posts</a>
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