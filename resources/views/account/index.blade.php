@extends('layouts.app')
@section('content')
  <h2>Привет, {{ Auth::user()->name }}</h2>
  <br>
  <p>Это кабинет пользователя</p>
  <p><a href="{{ route('admin.index') }}">Перейти в админку</a></p>
@endsection