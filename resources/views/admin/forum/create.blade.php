@extends('layouts.admin.app')

@section('container')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Text Editors
        <small>Advanced form element</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forum</a></li>
        <li class="active">new</li>
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
            <form role="form" action="{{ route('admin.forum.store') }}" method="post" class="was-validated" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="box-body">
                <div class="col-lg-6">
                    <div class="form-group">
                      <label for="category_forum_id">Catégorie</label>
                      <select name="category_forum_id" id="category_forum_id" class="form-control">
                        <option value="0" default>Selectionner....</option>
                        @foreach ($categories as $category)
                            <option class="form-control" value="{{ $category->id }}" {{ ($topic->category_forum_id == $category->id) ? 'selected' : '' }} >{{ $category->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="title">Titre</label>
                      <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" name="title" placeholder="Le titre du sujet"  value="{{ old('title') ?? $topic->title }}" required>
                      {!! $errors->first('title','<div class="valid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                      <label for="topic">Sujet</label>
                      <textarea class="textarea  {{ $errors->has('topic') ? ':is-invalid ' : '' }}" id="topic" name="topic" placeholder="Le sous titre de l'article"
                                style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('topic') ?? $topic->topic }}</textarea>
                      {{-- <input type="text" class="form-control {{ $errors->has('topic') ? 'is-invalid' : '' }}" id="topic" name="topic" placeholder="Le sous titre de l'article" value="{{ old('topic') ?? $topic->topic }}" required> --}}
                      {!! $errors->first('topic','<span class="help-block danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-lg-6">
                    <p>
                        Ceci est juste un texte.
                    </p>
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
          CKEDITOR.replace( 'topic' );
    </script>
@endsection