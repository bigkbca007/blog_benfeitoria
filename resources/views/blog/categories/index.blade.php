@extends('layouts.app')

@section('content')
    <h2>Categorias</h2>

    <div id="app">
        <categories-index></categories-index>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
@endsection