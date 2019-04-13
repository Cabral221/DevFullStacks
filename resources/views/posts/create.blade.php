@extends('layouts.base',['title'=>'Blog'])

@section('container')
<p><h2>Interface Blog</h2></p>
<h2>Création d'article</h2>
<div class="row justify-content-center">
    <div class="col-md-8 col-md-offset-2 col-sm-10-col-sm-offset-1">
        <form action="{{ route('blog.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title" class="control-label">Titre</label>
                <input type="text" name="title" id="title" class="form-control" required>
                {!! $errors->first('title','<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group {{ $errors->has('introduce') ? 'has-error' : '' }}">
                <label for="introduce" class="control-label">Introduction</label>
                <textarea name="introduce" id="introduce" cols="10" rows="3" class="form-control" required></textarea>
                {!! $errors->first('introduce','<span class="help-block">:message</span>') !!}                
            </div>
            <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                <label for="body" class="control-label">Contenu</label>
                <textarea name="body" id="body" cols="10" rows="10" class="form-control" required></textarea>
                {!! $errors->first('body','<span class="help-block">:message</span>') !!}                
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

@stop