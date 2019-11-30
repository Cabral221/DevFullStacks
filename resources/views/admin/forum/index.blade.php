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
        Gestion du forum !
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">all</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">

         
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Voir tout les sujets</h3>
              <a href="{{ route('admin.forum.create') }}" class="col-lg-offset-5">
               <button type="button" class="btn btn-success">Ajouter un sujet</button>
              </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- /.box -->
                <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Liste des sujets</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>S.N°</th>
                          <th>Titre</th>
                          <th>Catégorie</th>
                          <th>sujet</th>
                          <th>Slug</th>
                          <th>Réponses</th>
                          <th>Créer le</th>
                          <th>Résolution</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach ($topics as $topic)
                              <tr class="text-center">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $topic->title }}</td>
                                <td>{{ $topic->category->name }}</td>
                                <td>{!! $topic->topic !!}</td>
                                <td>{{ $topic->slug }}</td>
                                <td>{{ $topic->comments->count() }}</td>
                                <td>{{ $topic->created_at }}</td>
                                <td><i class="fa{{ $topic->setStat() ? ' fa-check-circle' : ' fa-times' }}" aria-hidden="true" style="font-size:28px;{{ $topic->setStat() ? 'color:green' : 'color:red' }};"></i></td>
                                <td>
                                  <a href="{{ route('admin.forum.edit', $topic) }}"><span class="glyphicon glyphicon-edit"></span></a>
                                </td>                                  
                                <td>
                                  <form id="delete-form-{{ $topic->id }}" method="post" action="{{ route('admin.forum.destroy',$topic) }}" style="display: none">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                  </form>
                                  <a href="#" onclick="
                                  if(confirm('Etes-vous sûr ?'))
                                  { 
                                    event.preventDefault();
                                    document.getElementById('delete-form-{{ $topic->id }}').submit(); 
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
                            <th>Titre</th>
                            <th>Catégorie</th>
                            <th>sujet</th>
                            <th>Slug</th>
                            <th>Réponses</th>
                            <th>Créer le</th>
                            <th>Résolution</th>
                              <th>Modifier</th>
                              <th>Supprimer</th>
                        </tr>
                        </tfoot>
                      </table>
                      {{ $topics->links() }}
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