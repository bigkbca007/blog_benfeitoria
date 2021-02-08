@extends('layouts.app')

@section('content')
    <h2>Postagem</h2>

    <div id="app">
        <posts-create></posts-create>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
@endsection