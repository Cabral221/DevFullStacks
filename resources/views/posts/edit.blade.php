@extends('layouts.base',['title'=>'Blog'])

@section('container')
<p><h2>Interface Blog</h2></p>
<h2>Modification d'evenement</h2>
<div class="row justify-content-center">
    <div class="col-md-8 col-md-offset-2 col-sm-10-col-sm-offset-1">
        <form action="{{ route('blog.update',$post) }}" method="POST" class="">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="title" class="col-form-label">Titre</label>
                <input type="text" name="title" id="title" class="form-control  {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title') ?? $post->title }}" required>
                {!! $errors->first('title','<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group">
                <label for="category_id">Catégorie</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option default>Selectionner....</option>
                    @foreach ($categories as $category)
                        <option class="form->control" value="{{ $category->id }}" {{ ($post->category_id == $category->id) ? 'selected' : '' }} >{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group {{ $errors->has('introduce') ? 'has-error' : '' }}">
                <label for="introduce" class="control-label">Introduction</label>
                <textarea name="introduce" id="introduce" cols="10" rows="3" class="form-control" required>{{ old('introduce') ?? $post->introduce }}</textarea>
                {!! $errors->first('introduce','<span class="help-block">:message</span>') !!}                
            </div>
            <div class="form-group">
                <label for="body" class="col-form-label">Contenu</label>
                <textarea name="body" id="body" cols="10" rows="10" class="form-control {{ $errors->has('body') ? 'is-invalid ' : '' }}" required>{{ old('body') ?? $post->body }}</textarea>
                {!! $errors->first('body','<span class="help-block">:message</span>') !!}                
            </div>
            <div class="form-group">
                <label class="control-label">
                    <input type="checkbox"  name="online" id="online" value="1" {{ ($post->online) ? 'checked' : '' }}>
                    En ligne ?
                </label>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

@stop