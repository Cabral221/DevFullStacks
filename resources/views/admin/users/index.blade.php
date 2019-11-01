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
        Gerer les administrateurs ici !
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
              <h3 class="box-title">Administration</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-lg-offset col-lg-8">
                <!-- /.box -->
                <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Liste des admins </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>S.N°</th>
                          <th>Nom </th>
                          <th>Email </th>
                          <th>Rôles </th>
                          <th>Statut </th>
                          <th>Modifier</th>
                          <th>Supprimer</th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach ($admins as $admin)
                              {{-- {{ dd($admin) }} --}}
                              <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>
                                  @foreach ($admin->roles as $role)
                                    {{ $role->name }},
                                  @endforeach
                                </td>
                                <td>{{ $admin->status ? 'Active' : 'non active' }}</td>
                                <td>
                                  <a href="{{ route('admin.user.edit',$admin) }}"><span class="glyphicon glyphicon-edit"></span></a>
                                </td>
                                <td>
                                  <form id="delete-form-{{ $admin->id }}" method="post" action="{{ route('admin.user.destroy',$admin) }}" style="display: none">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                  </form>
                                  <a href="#" onclick="
                                  if(confirm('Etes-vous sûr ?'))
                                  { 
                                    event.preventDefault();
                                    document.getElementById('delete-form-{{ $admin->id }}').submit(); 
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
                          <th>Nom </th>
                          <th>Email </th>
                          <th>Rôles </th>
                          <th>Statut </th>
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
                      <h3 class="box-title">Ajouter un administrateur</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <!-- form start -->
                    <form role="form" action="{{ route('admin.user.store') }}" method="post" class="was-validated" enctype="multipart/form-data">
                      {{-- <div class="box-body"> --}}
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="name">Nom</label>
                          <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="Nom de l'admin'" value="{{ old('name') ?? '' }}" required autofocus>
                          {!! $errors->first('name','<div class="valid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                          <label for="email">Adresse Email</label>
                          <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" placeholder="Adresse Email" value="{{ old('email') ?? '' }}" required>
                          {!! $errors->first('email','<div class="valid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                          <label for="phone">N° Téléphone (+ind)</label>
                          <input type="number" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" id="phone" name="phone" placeholder="numéro de téléphone plus indecatif pays" value="{{ old('phone') ?? '' }}" required>
                          {!! $errors->first('phone','<div class="valid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" name="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required>
                            {!! $errors->first('password','<div class="valid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                          <label for="password-confirm" class="col-form-label">Confirmer le mot de passe</label>
                          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <div class="form-group">
                          <label class="col-form-label">Status Super Admin</label>
                          <div class="checkbox">
                            <label for="status"><input type="checkbox" name="status" id="status" value="{{ old('status') ?? 1 }}">  status</label>
                          </div>
                        </div>
                        <div class="form-form">
                          <label class="col-form-label">Assigner un ou plusieurs rôles</label>
                          <div class="row">
                            @foreach ($roles as $role)
                            <div class="col-lg-3">
                              <div class="checkbox">
                                <label for="{{ $role->slug }}"><input type="checkbox" name="role[]" id="{{ $role->slug }}" value="{{ old('role') ?? $role->id }}">  {{ $role->name }}</label>
                              </div>
                            </div>                              
                            @endforeach
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Avatar</label>
                            <input type="file" name="image" id="image">
                            <p class="help-block">Ceci n'est pas obligatoire.</p>
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