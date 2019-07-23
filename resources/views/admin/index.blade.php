{{-- @extends('layouts.base')

@section('container')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8"> --}}
           {{-- <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width: 150px;height:150px;float:left;border-radius:50%; margin-right:20px;"> --}}
           {{-- <h2>{{ Auth::user()->name }}</h2>
           <form action="{{ route('update_avatar') }}" enctype='multipart/form-data' method="POST">
                {{ csrf_field() }}
                <label for="">Changer l'avatar</label>
                <input type="file" name="avatar" id="">
                <input type="submit" value="Enregister" class="pull-right btn btn-sm btn-primary">
            </form> --}}
            {{-- <h2><a href="{{ route('forum.create') }}" class="badge badge-pill badge-primary">Ajouter un sujet</a></h2> --}}
            {{-- <h1>Admin dashbord</h1>
            <h2>T'es connecté en tant qu ' <strong>ADMIN</strong> </h2>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.admin.app')

@section('container')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blank page
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Admin dashbord</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2>T'es connecté en tant qu ' <strong>ADMIN</strong> </h2>
                </div>
            </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
{{-- <div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
           
            <h1>Admin dashbord</h1>
            <h2>T'es connecté en tant qu ' <strong>ADMIN</strong> </h2>
        </div>
    </div>
</div> --}}
@endsection