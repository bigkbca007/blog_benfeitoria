@extends('layouts.app')

@section('content')
    <h2>Postagem </h2>

    <div id="app">
        <posts-show
            id="{{ $post['id'] }}"
            titulo="{{ $post['titulo'] }}"
            img_post="{{ $post['img_post'] }}"
            conteudo="{{ $post['conteudo'] }}"
            categoria="{{ $post['categoria'] }}"
            autor="{{ $post['autor'] }}"
            email="{{ $post['email'] }}"
            created_at="{{ $post['created_at'] }}"
            updated_at="{{ $post['updated_at'] }}"
        >
        </posts-show>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
@endsection