@extends('layouts.admin.app')

@section('container')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edition de l'article
        <small>Advanced form element</small>
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
              <h3 class="box-title">Entêtes</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('admin.blog.update',$post) }}" method="POST" class="was-validated" enctype="multipart/form-data">
              {{ method_field('PUT') }}
              {{ csrf_field() }}
              <div class="box-body">
                <div class="col-lg-6">
                    <div class="form-group">
                      <label>Catégorie</label>
                      <select name="category_id" id="category_id" class="form-control">
                        <option disable>Selectionner....</option>
                        @foreach ($categories as $category)
                            <option class="form-control" value="{{ $category->id }}" {{ ($post->category_id == $category->id) ? 'selected' : '' }} >{{ $category->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="title">Titre</label>
                      <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" name="title" placeholder="Le titre de l'article"  value="{{ old('title') ?? $post->title }}" required>
                      {!! $errors->first('title','<div class="valid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                      <label for="introduce">Sous titre</label>
                      <textarea class="textarea  {{ $errors->has('introduce') ? ':is-invalid ' : '' }}" id="introduce" name="introduce" placeholder="Le sous titre de l'article"
                                style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('introduce') ?? $post->introduce }}</textarea>
                      {!! $errors->first('introduce','<span class="help-block danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                      <label for="image">Image d'entête</label>
                      <input type="file" name="image" id="image">
                      <p class="help-block">Dimensions recommandées 900 X 600.</p>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="online" id="online" value="1" {{ ($post->online) ? 'checked' : '' }}> En ligne ?
                      </label>
                    </div>
                </div>
              </div>
                <div class="box">
                    <div class="box-header">
                    <h3 class="box-title">Rédiger le contenu de l'article
                        <small>Simple et rapide</small>
                    </h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    </div>
                    <!-- /. tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body pad">
                    {{-- <form> --}}
                        <textarea class="textarea  {{ $errors->has('body') ? ':is-invalid ' : '' }}" name="body" placeholder="Place some text here"
                                style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('body') ?? $post->body }}</textarea>
                    {{-- </form> --}}
                    </div>
                </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
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