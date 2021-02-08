@extends('layouts.app')

@section('content')
    <h2>Categoria {{ $id }}</h2>

    <div id="app">
        <categories-show></categories-show>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
@endsection