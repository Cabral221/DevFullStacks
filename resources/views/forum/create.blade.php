@extends('layouts.user.blog.app',['title'=>'Forum'])

@section('header')
    <section class="dark-wrapper opaqued parallax" data-parallax="scroll" data-image-src="#" data-speed="0.7">
        <div class="section-inner text-center">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 mt150 wow">
                        <h2 class="section-heading">Vous avez un sujet de discussion ?</h2>
                        <div class="item-metas text-muted mb30 white">
                            <span class="meta-item">
                                Descendez pour le soumettre à la communauté !
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('main-content')
<div class="container">
    <div class="row  justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <h2>Creer un sujet</h2>
            <form action="{{ route('forum.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label for="title" class="control-label">Titre</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                    {!! $errors->first('title','<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                    <label for="topic" class="control-label">Sujet</label>
                    <textarea name="topic" id="topic" cols="10" rows="10" class="form-control" required></textarea>
                    {!! $errors->first('topic','<span class="help-block">:message</span>') !!}                
                </div>
                <div class="form-group">
                    <button type="submit" class="btn pull-right btn-primary">Soumettre</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop