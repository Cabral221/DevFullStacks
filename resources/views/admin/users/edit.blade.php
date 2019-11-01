@extends('layouts.admin.app')

@section('container')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Modification de informations personnelles
        <small>Attention accés interdit à toutes personnes etrangées</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Editors</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">


                      <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Modifier les information de l'administrateur</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('admin.user.update',$user) }}" method="POST" class="was-validated" enctype="multipart/form-data">
              {{ method_field('PUT') }}
              {{ csrf_field() }}
              <div class="box-body">
                <div class="col-lg-6">
                    <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="Nom de l'admin'" value="{{  old('name') ?? $user->name }}" required autofocus>
                    {!! $errors->first('name','<div class="valid-feedback">:message</div>') !!}
                  </div>
                  <div class="form-group">
                    <label for="email">Adresse Email</label>
                    <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" placeholder="Adresse Email" value="{{ old('email') ?? $user->email }}" required>
                    {!! $errors->first('email','<div class="valid-feedback">:message</div>') !!}
                  </div>
                  <div class="form-group">
                    <label for="phone">N° Téléphone (+ind)</label>
                    <input type="number" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" id="phone" name="phone" placeholder="numéro de téléphone plus indecatif pays" value="{{ old('phone') ?? $user->phone }}" required>
                    {!! $errors->first('phone','<div class="valid-feedback">:message</div>') !!}
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Status Super Admin</label>
                    <div class="checkbox">
                      <label for="status"><input type="checkbox" name="status" id="status" value="1" @if ($user->status == 1 || $user->id == 1)
                          checked
                      @endif >  status</label>
                    </div>
                  </div>
                  <div class="form-form">
                    <label class="col-form-label">Assigner un ou plusieurs rôles</label>
                    <div class="row">
                      @foreach ($roles as $role)
                      <div class="col-lg-3">
                        <div class="checkbox">
                          <label for="{{ $role->slug }}"><input type="checkbox" name="role[]" id="{{ $role->slug }}" value="{{  $role->id ?? old('role') }}" @foreach ($user->roles as $user_role) @if($user_role->id == $role->id) checked @endif @endforeach>  {{ $role->name }}</label>
                        </div>
                      </div>                              
                      @endforeach
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
                <div class="col-lg-6">
                  {{-- Quelques choses ici  --}}

                  {{-- Quelques choses ici  --}}
                </div>
              </div>
              <!-- /.box-body -->
            </form>
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@section('footer')
    <script src="{{ asset('admins/ckeditor/ckeditor.js') }}"></script>
    <script>
      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace( 'introduce' );

      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace( 'body' );
    </script>
@endsection