<?php if($post->id) : ?>
<form action="{{ route('blog.update',$post) }}" method="POST" class="">
            {{ method_field('PUT') }}
<?php else: ?>
<form action="{{ route('blog.store') }}" method="POST">
<?php endif ?>
    {{ csrf_field() }}
    <div class="form-group">
        <label for="title" class="col-form-label">Titre</label>
        <input type="text" name="title" id="title" class="form-control  {{ $errors->has('title') ? ':is-invalid' : '' }}" value="{{ old('title') ?? $post->title }}" required>
        {!! $errors->first('title','<span class="help-block">:message</span>') !!}
    </div>
    <div class="form-group">
        <label for="category_id">Catégorie</label>
        <select name="category_id" id="category_id" class="form-control">
            <option default>Selectionner....</option>
            @foreach ($categories as $category)
                <option class="form->control" value="{{ $category->id }}" {{ ($post->category_id == $category->id) ? 'selected' : '' }} >{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group {{ $errors->has('introduce') ? ':is-invalid' : '' }}">
        <label for="WSintroduce" class="control-label">Introduction</label>
        <textarea name="introduce" id="WSintroduce" cols="10" rows="3" class="form-control" required>{{ old('introduce') ?? $post->introduce }}</textarea>
        {!! $errors->first('introduce','<span class="help-block">:message</span>') !!}                
    </div>
    <div class="form-group">
        <label for="wsbody" class="col-form-label">Contenu</label>
        <textarea data-id="{{ $post->id }}" data-type="{{ get_class($post) }}" data-url="{{ route('attachments.store') }}" name="body" id="WSbody" cols="10" rows="10" class="form-control {{ $errors->has('body') ? ':is-invalid ' : '' }}" required>{{ old('body') ?? $post->body }}</textarea>
        {!! $errors->first('body','<span class="help-block">:message</span>') !!}                
    </div>
    <div class="form-group">
        <label class="control-label">
            <input type="checkbox"  name="online" id="online" value="1" {{ ($post->online) ? 'checked' : '' }}>
            En ligne ?
        </label>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-block btn-primary">Enregistrer</button>
    </div>
</form>