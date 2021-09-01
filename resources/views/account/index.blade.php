@extends('layouts.app')
@section('content')
  <h2>Привет, {{ \Illuminate\Support\Facades\Auth::user()->name }}</h2>
  <br>
  @if (Auth::user()->avatar)
    <img src="{{ \Illuminate\Support\Facades\Auth::user()->avatar }}" alt="" style="width: 250px;">
  @endif
  <p>Это кабинет пользователя</p>
  <p><a href="{{ route('admin.index') }}">Перейти в админку</a></p>
@endsection