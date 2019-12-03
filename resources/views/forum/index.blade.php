@extends('layouts.user.blog.app',['title'=>'Forum'])

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
<div class="container">
    <div class="row">
        <ul>
            <li></li>
        </ul>
    </div>
    @if (!Auth::guest())
        <hr>
        <div class="row mt-5">
            <div class="col-md-8 col-md-offset-2 text-center">
                <a href="{{ route('forum.create') }}" class="btn btn-primary pull">Créer un sujet</a>
            </div>
        </div>
    @endif

    <hr>
    @if (! $topics->isEmpty())
        <div class="panel panel-primary">
            <div class="panel-heading panel-heading-custom text-center">
                <h4>Derniers sujets</h4>
            </div>
            <table class="table">
                <tr>
                    <td>Sujet</td>
                    <td>Réponses</td>
                    <td>Résolution</td>
                    <td>Auteur</td>
                    <td>Date</td>
                </tr>
                @foreach ($topics as $topic)
                    <tr>
                        <td><a href="{{ route('forum.show',$topic) }}"><p style="font-weight:700;">{{ $topic->title }}</p></a></td>
                        <td>{{ $topic->comments()->count() }}</td>
                        <td><i class="fa{{ $topic->setStat() ? 's fa-check-circle' : ' fa-times' }}" aria-hidden="true" style="font-size:28px;{{ $topic->setStat() ? 'color:green' : 'color:red' }};"></i></td>
                        <td>{{ $topic->user->name }}</td>
                        <td>{{ $topic->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </table>
        </div>       
        {{ $topics->links() }}
    @else
        <p>Pas de sujets pour le moment !</p>
    @endif

   
</div>
@stop

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
