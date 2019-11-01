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
        Gerer les rôles des administrateurs !
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
              <h3 class="box-title">Rôles</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-lg-offset col-lg-8">
                <!-- /.box -->
                <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Liste des rôles</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>S.N°</th>
                          <th>Libelé</th>
                          <th>Modifier</th>
                          <th>Supprimer</th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach ($roles as $role)
                              {{-- {{ dd($role) }} --}}
                              <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                  <a href="{{ route('admin.user.role.edit',$role) }}"><span class="glyphicon glyphicon-edit"></span></a>
                                </td>
                                <td>
                                  <form id="delete-form-{{ $role->id }}" method="post" action="{{ route('admin.user.role.destroy',$role) }}" style="display: none">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                  </form>
                                  <a href="#" onclick="
                                  if(confirm('Etes-vous sûr ?'))
                                  { 
                                    event.preventDefault();
                                    document.getElementById('delete-form-{{ $role->id }}').submit(); 
                                  }else{
                                    event.preventDefault();
                                  }"><span class="glyphicon glyphicon-trash"></span></a>
                                </td>
                              </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                          <th>S.N°</th>
                          <th>Libelé</th>
                          <th>Modifier</th>
                          <th>Supprimer</th>
                        </tr>
                        </tfoot>
                      </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <div class="col-lg-offset col-lg-4">
                <div class="box">
                  <div class="box-header">
                      <h3 class="box-title">Ajouter un rôle</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <!-- form start -->
                    <form role="form" action="{{ route('admin.user.role.store') }}" method="post" class="was-validated" enctype="multipart/form-data">
                      {{-- <div class="box-body"> --}}
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="name">Libelé du rôle</label>
                          <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="Libelé" value="{{ old('name') ?? '' }}" required>
                          {!! $errors->first('name','<div class="valid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-lg-6">
                              <label for="post-permission">Blog permission</label>
                              @foreach ($permissions as $permission)
                                @if ($permission->permission_type == Post::class)
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="permission[]" value="{{ $permission->id }}">{{ $permission->name }}</label>
                                  </div>
                                @endif                            
                              @endforeach
                            </div>
                            <div class="col-lg-6">
                              <label for="post-permission">Forum permission</label>
                              @foreach ($permissions as $permission)
                                @if ($permission->permission_type == Forum::class)
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="permission[]" value="{{ $permission->id }}">{{ $permission->name }}</label>
                                  </div>
                                @endif                            
                              @endforeach
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-6">
                              <label for="post-permission">E-learning permission</label>
                              @foreach ($permissions as $permission)
                                @if ($permission->permission_type == Elearning::class)
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="permission[]" value="{{ $permission->id }}">{{ $permission->name }}</label>
                                  </div>
                                @endif                            
                              @endforeach
                            </div>
                            <div class="col-lg-6">
                              <label for="post-permission">User permission</label>
                              @foreach ($permissions as $permission)
                                @if ($permission->permission_type == User::class)
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="permission[]" value="{{ $permission->id }}">{{ $permission->name }}</label>
                                  </div>
                                @endif                            
                              @endforeach
                            </div>
                          </div>
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