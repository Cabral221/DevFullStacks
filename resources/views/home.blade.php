@extends('layouts.base')

@section('container')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
            <h2><a href="{{ route('forum.create') }}" class="badge badge-pill badge-primary">Ajouter un sujet</a></h2>
        </div>
    </div>
</div>
@endsection
