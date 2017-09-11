@extends('layouts.master')

@section('content')
    <h1>Bienvenue {{ Auth::user()->name }} vous êtes connecté en temps que VISITEUR</h1>
@endsection
