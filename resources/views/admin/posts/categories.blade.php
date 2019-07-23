@extends('layouts.admin.app')

@section('head')
<link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('container')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gerer les catégories ici !
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
              <h3 class="box-title">Catégories</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-lg-offset col-lg-8">
                <!-- /.box -->
                <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Data Table With Full Features</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>S.N°</th>
                          <th>Nom de la catégorie</th>
                          <th>URL de la catégorie</th>
                          <th>Modifier</th>
                          <th>Supprimer</th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach ($categories as $category)
                              {{-- {{ dd($category) }} --}}
                              <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                  <a href="{{ route('admin.blog.categories.edit',$category) }}"><span class="glyphicon glyphicon-edit"></span></a>
                                </td>
                                <td>
                                  <form id="delete-form-{{ $category->id }}" method="post" action="{{ route('admin.blog.categories.destroy',$category) }}" style="display: none">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                  </form>
                                  <a href="#" onclick="
                                  if(confirm('Etes-vous sûr ?'))
                                  { 
                                    event.preventDefault();
                                    document.getElementById('delete-form-{{ $category->id }}').submit(); 
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
                          <th>Nom de la catégorie</th>
                          <th>URL de la catégorie</th>
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
                      <h3 class="box-title">Créer une catégorie</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <!-- form start -->
                    <form role="form" action="{{ route('admin.blog.categories.store') }}" method="post" class="was-validated" enctype="multipart/form-data">
                      {{-- <div class="box-body"> --}}
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="name">Catégorie</label>
                          <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="Le nom de la catégorie" value="{{ old('name') ?? '' }}" required>
                          {!! $errors->first('name','<div class="valid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                          <label for="slug">Slug de la catégorie</label>
                          <input type="text" class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" id="slug" name="slug" placeholder="L'URL de la catégorie" value="{{ old('slug') ?? '' }}">
                          {!! $errors->first('slug','<div class="valid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            <label for="image">Image d'entête</label>
                            <input type="file" name="image" id="image">

                            <p class="help-block">ça sera l'image par defaut de la catégories.</p>
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
    <script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
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