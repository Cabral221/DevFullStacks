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
        Gestion des permissions de l'administrateur !
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
              <h3 class="box-title">Permissions</h3>
              {{-- <a href="{{ route('admin.user.permission.create') }}" class="col-lg-offset-5">
               <button type="button" class="btn btn-success">Ajouter une permission</button>
              </a> --}}
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-lg-offset col-lg-8">            
                  <!-- /.box -->
                  <div class="box">
                      <div class="box-header">
                        <h3 class="box-title">Liste des articles</h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                            <th>S.N°</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                          </tr>
                          </thead>
                          <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                  <td>{{ $loop->index + 1 }}</td>
                                  <td>{{ $permission->name }}</td>
                                  <td>{{ $permission->permission_type }}</td>
                                  <td>
                                    <a href="{{ route('admin.user.permission.edit',$permission) }}"><span class="glyphicon glyphicon-edit"></span></a>
                                  </td>
                                  <td>
                                    <form id="delete-form-{{ $permission->id }}" method="post" action="{{ route('admin.user.permission.destroy',$permission) }}" style="display: none">
                                      {{ csrf_field() }}
                                      {{ method_field('DELETE') }}
                                    </form>
                                    <a href="#" onclick="
                                    if(confirm('Etes-vous sûr ?'))
                                    { 
                                      event.preventDefault();
                                      document.getElementById('delete-form-{{ $permission->id }}').submit(); 
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
                            <th>Description</th>
                            <th>Type</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                          </tr>
                          </tfoot>
                        </table>
                      </div>
                        {{-- {{ $permissions->links() }} --}}
                      <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
                <div class="col-lg-offset col-lg-4">    
                  <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Créer une permission</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <!-- form start -->
                      <form role="form" action="{{ route('admin.user.permission.store') }}" method="post" class="was-validated" enctype="multipart/form-data">
                        {{-- <div class="box-body"> --}}
                          {{ csrf_field() }}
                          <div class="form-group">
                            <label for="name">Nom de la permission</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="Le nom de la permission" value="{{ old('name') ?? '' }}" required>
                            {!! $errors->first('name','<div class="valid-feedback">:message</div>') !!}
                          </div>
                          <div class="form-group">
                            <label for="type">Type de permission</label>
                            <select name="permission_type" id="type" class="form-control">
                              <option selected disable>Selectionner un type de permission</option>
                              <option value="{{ Post::class }}">Post</option>
                              <option value="{{ Forum::class }}">Forum</option>
                              <option value="{{ Elearning::class }}">E-learning</option>
                              <option value="{{ User::class }}">User</option>
                              <option value="{{ 'autre' }}">Autre</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                      </form>
                    </div>
                  </div>
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