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
        Gestipn des articles !
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
              <h3 class="box-title">Article</h3>
              @can('posts.create', Auth::user())
              <a href="{{ route('admin.blog.create') }}" class="col-lg-offset-5">
               <button type="button" class="btn btn-success">Ajouter un article</button>
              </a>
              @endcan
            </div>
            <!-- /.box-header -->
            <div class="box-body">
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
                          <th>Titre</th>
                          <th>Sous titre</th>
                          <th>Slug</th>
                          <th>Créer le</th>
                          <th>En ligne ?</th>
                          @can('posts.update', Auth::user())
                            <th>Modifier</th>
                          @endcan
                          @can('posts.delete', Auth::user())
                            <th>Supprimer</th>
                          @endcan
                        </tr>
                        </thead>
                        <tbody>
                          @foreach ($posts as $post)
                              <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{!! $post->introduce !!}</td>
                                <td>{{ $post->slug }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td>{{ $post->online }}</td>                          
                                @can('posts.update', Auth::user())
                                <td>
                                  <a href="{{ route('admin.blog.edit',$post) }}"><span class="glyphicon glyphicon-edit"></span></a>
                                </td>
                                @endcan
                                @can('posts.delete', Auth::user())                                  
                                <td>
                                  <form id="delete-form-{{ $post->id }}" method="post" action="{{ route('admin.blog.destroy',$post) }}" style="display: none">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                  </form>
                                  <a href="#" onclick="
                                  if(confirm('Etes-vous sûr ?'))
                                  { 
                                    event.preventDefault();
                                    document.getElementById('delete-form-{{ $post->id }}').submit(); 
                                  }else{
                                    event.preventDefault();
                                  }"><span class="glyphicon glyphicon-trash"></span></a>
                                </td>
                                @endcan
                              </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                          <th>S.N°</th>
                          <th>Titre</th>
                          <th>Sous titre</th>
                          <th>Slug</th>
                          <th>Créer le</th>
                          <th>En lign</th>
                          @can('posts.update', Auth::user())
                            <th>Modifier</th>
                          @endcan
                          @can('posts.delete', Auth::user())
                            <th>Supprimer</th>
                          @endcan
                        </tr>
                        </tfoot>
                      </table>
                      {{ $posts->links() }}
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
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