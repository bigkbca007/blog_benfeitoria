@extends('layouts.app')

@section('content')
    <h2>Categoria</h2>

    <div id="app">
        <categories-create></categories-create>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
@endsection