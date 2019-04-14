@extends('layouts.base',['title'=>'Blog'])

@section('container')
<p><h2>Interface Blog</h2></p>
<h2>Modification d'evenement</h2>
<div class="row justify-content-center">
    <div class="col-md-8 col-md-offset-2 col-sm-10-col-sm-offset-1">
        @include('form')
    </div>
</div>

@stop