@extends('layouts.user.blog.app')

@section('header')
    <section class="dark-wrapper opaqued parallax" data-parallax="scroll" data-image-src="#" data-speed="0.7">
        <div class="section-inner text-center">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 mt150 wow">
                        <h2>Bienvenu à la communauté DevFullStacks</h2>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header"><h2>Restaurer votre mot de passe</h2></div>
                <br>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="">
                                <button type="submit" class="btn btn-block btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
