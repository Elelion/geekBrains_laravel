<?php

use App\Models\User;

/**
 * @var User[] $userList
 * @var User $user
 */

?>

@extends('layouts.admin')
@section('content')

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Редактировать пользователя</h1>
    <a href="{{ route('admin.users.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-list fa-sm text-white-50"></i> К списку пользователей</a>
  </div>

  <!-- Content Row -->
  <div class="row">

    @if ($errors->any())
      @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
      @endforeach
    @endif

    <form action="{{ route('admin.users.update', ['user' => $user]) }}" method="post">
      <div class="form-group">
        <label for="author">Имя</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">

        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="email">email</label>
        <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}">
        @error('email')
        <div style="color: red; font-weight: bold;">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="is_admin">Права доступа</label>
        <select class="form-control" id="is_admin" name="is_admin">
          <option value="0" @if ($user->is_admin == false) selected @endif>пользователь</option>
          <option value="1" @if ($user->is_admin == true) selected @endif>админ</option>
        </select>
      </div>


      @method('put')
      @csrf
      <button class="btn btn-primary">Сохранить</button>
    </form>

  </div>

@endsection
