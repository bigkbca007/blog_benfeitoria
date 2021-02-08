@extends('layouts.app')

@section('content')
    <h2>Postagens</h2>

    <div id="app">
        <posts-index></posts-index>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
@endsection