@extends('layouts.app')

@section('titulo')
    Publicaciones de tu red
@endsection
@section('contenido')

    <x-listar-post :posts="$posts"/>


@endsection