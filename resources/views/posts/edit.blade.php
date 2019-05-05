@extends('layouts.base',['title'=>'Blog'])

@section('container')
<p><h2>Interface Blog</h2></p>
<h2>Modification d'evenement</h2>
<div class="row justify-content-center">
    <div class="col-md-8 col-md-offset-2 col-sm-10-col-sm-offset-1">
         @include('posts.form')
    </div>
</div>

@stop
@section('javascript')
<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script>
    var el = document.getElementById('WSbody')
    // alert(el.dataset.id)
  tinymce.init({
    selector: '#WSbody',
    plugins: 'image,paste',
    paste_data_images: true,
    automatic_uploads: true,
    images_upload_handler: function (blobinfo, success, failure) {
        var data = new FormData()
        data.append('attachable_id', el.dataset.id)
        data.append('attachable_type', el.dataset.type)
        data.append('image',blobinfo.blob(), blobinfo.filename())
        axios.post(el.dataset.url, data)
          .then(function(res){
            success(res.data.url)
        }).catch(function(err){
            alert(err.response.statusText)
            success('http://placehold.it/350x150')
            // failure(err.response.statusText)
        })
    }
  });
</script>
@endsection