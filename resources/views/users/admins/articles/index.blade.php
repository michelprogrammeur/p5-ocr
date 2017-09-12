@extends('layouts.master')

@section('content')
    <section>
        <header>
            <h2>Liste des articles</h2>
            <p><a href="{{ url('articles/create') }}">AJouter un article</a></p>
        </header>

        <ul>
            @foreach($articles as $article)
                <li>
                    <h3>{{ $article->title }}</h3>
                    <p>{{ $article->abstract }}</p>
                    <a href="{{ url('/articles/' . $article->id . '/edit') }}" class="btn-modifier">Modifier</a>
                    <form method="post" action="{{ url('/articles', $article->id) }}" class="">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}

                        <input name="_method" type="hidden" value="delete" />
                        <input class="btn-picture-delete"  type="submit" value="Delete" onclick="return confirm(\'Are you sure?\')"/>
                    </form>
                </li>
            @endforeach
        </ul>
    </section>
@endsection