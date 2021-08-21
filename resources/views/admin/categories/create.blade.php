@extends('layouts.admin')
@section('content')

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Добавить категорию</h1>
    <a href="{{ route('admin.categories.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-list fa-sm text-white-50"></i> К списку категорий</a>
  </div>

  <!-- Content Row -->
  <div class="row">
    @include('inc.message')

    <form action="{{ route('admin.categories.store') }}" method="post">
      <div class="form-group">
        <label for="title">Заголовки</label>

        <input type="text" class="form-control" name="title" id="title">
      </div>

      <div class="form-group">
        <label for="description">Описание</label>

        <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
      </div>

      @csrf
      <button class="btn btn-primary">Сохранить</button>
    </form>

  </div>

@endsection