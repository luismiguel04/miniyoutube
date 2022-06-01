
@extends('layouts.app')
@section('content')


    <div class="container">
        <div class="row">
            <h2>Lista de videos guardar</h2>
        </div>
    </div>
    <div class="row">
        @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif
    </div>
@endsection
