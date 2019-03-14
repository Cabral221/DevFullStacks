@extends('layouts.base',['title'=>'Forum'])

@section('container')
<div class="container">
    <div class="row  justify-content-center">
        <div class="col-md-8">
            <h2>Creer un sujet</h2>
            <form action="{{ route('forum.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                    <label for="topic" class="control-label">Sujet</label>
                    <textarea name="topic" id="topic" cols="10" rows="10" class="form-control" required></textarea>
                    {!! $errors->first('topic','<span class="help-block">:message</span>') !!}                
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary">Soumettre</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop