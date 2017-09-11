@extends('layouts.master')

@section('content')
    <form enctype="multipart/form-data" method="post" action="{{ url('articles', $article->id) }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <h2>Mettre une image</h2>
        <input type="file" name="picture[]" multiple value="">

        <div>
            <label>Tire de l'article</label>
            <input type="text" name="title" placeholder="Titre" value="{{ $article->title }}"/>
            @if ($errors->any())
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>

        <div>
            <label>Lien de l'url</label>
            <input type="text" name="slug" placeholder="Ex: article-sur-theme-choisi" value="{{ $article->slug }}"/>
            @if ($errors->any())
                <span class="help-block">
                    <strong>{{ $errors->first('slug') }}</strong>
                </span>
            @endif
        </div>

        <div>
            <label>Extrait de l'article</label>
            <textarea name="abstract" placeholder="Extrait...">{{ $article->abstract }}</textarea>
            @if ($errors->any())
                <span class="help-block">
                    <strong>{{ $errors->first('abstract') }}</strong>
                </span>
            @endif
        </div>

        <div>
            <label>Contenue de l'article</label>
            <textarea name="content" placeholder="Contenu...">{{ $article->content }}</textarea>
            @if ($errors->any())
                <span class="help-block">
                    <strong>{{ $errors->first('content') }}</strong>
                </span>
            @endif
        </div>

        <input type="submit" value="valider"/>
    </form>
@endsection