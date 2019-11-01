@extends('layouts.admin.app')

@section('head')
<link rel="stylesheet" href="{{ asset('admins/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('container')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gerer les permissions ici !
        <small></small>
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
              <h3 class="box-title">Permissions et Limites</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-lg-offset col-lg-4">
                <div class="box">
                  <div class="box-header">
                      <h3 class="box-title">Modifier la permission</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <!-- form start -->
                    <form role="form" action="{{ route('admin.user.permission.update',$permission) }}" method="post" class="was-validated" enctype="multipart/form-data">
                      {{-- <div class="box-body"> --}}
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="name">Nom de la permission</label>
                          <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="Le nom de la permission" value="{{ old('name') ?? $permission->name }}" required>
                          {!! $errors->first('name','<div class="valid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                          <label for="permission_type">Type de permission</label>
                          <select name="permission_type" id="type" class="form-control">
                            <option value="{{ Post::class }}" {{ ($permission->permission_type == Post::class) ? 'selected' : '' }}>Post</option>
                            <option value="{{ Forum::class }}" {{ ($permission->permission_type == Forum::class) ? 'selected' : '' }}>Forum</option>
                            <option value="{{ Elearning::class }}" {{ ($permission->permission_type == Elearning::class) ? 'selected' : '' }}>E-learning</option>
                            <option value="{{ User::class }}" {{ ($permission->permission_type == User::class) ? 'selected' : '' }}>User</option>
                            <option value="{{ 'autre' }}" {{ ($permission->permission_type == 'autre') ? 'selected' : '' }}>Autre</option>
                          </select>
                          {!! $errors->first('permission_type','<div class="valid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="text-center">
                Footer
              </div>
            </div>
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
    <script src="{{ asset('admins/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admins/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
      $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
          'paging'      : true,
          'lengthChange': false,
          'searching'   : false,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false
        })
      })
    </script>
@endsection