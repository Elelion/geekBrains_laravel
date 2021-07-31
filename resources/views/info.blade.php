@extends('layouts.master')
@section('title', 'Главная')
@section('content')

    <div class="title m-b-md">
        Laravel
    </div>

    <div class="links">
        <a href="{{ route('index') }}">Главная</a>
        <a href="{{ route('info') }}">О проекте</a>
        <a href="{{ route('news') }}">Новости</a>
    </div>

    <p>i n f o</p>

@endsection
