@extends('layouts.app')
@section('title', '| Test Page')

@section('content')
        <div class="jumbotron">
            <h1>{{ Date('Y-m-d H:i:s') }}</h1>
            <h2 @if($randomName == 'Epstein' or $randomName == 'Jeff') style="color: lightseagreen; font-weight: bold;" @endif>{{ $randomName }}</h2>
            <p class="lead">Első demi route</p>
            <a href="https://szbi-pg.hu" class="btn btn-lg btn-primary">Iskola</a>
        </div>
@endsection