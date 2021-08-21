@extends('layouts.admin')
@section('content')

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Редактировать категорию</h1>
    <a href="{{ route('admin.categories.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-list fa-sm text-white-50"></i> К списку категорий</a>
  </div>

  <!-- Content Row -->
  <div class="row">
    @include('inc.message')

    <form action="{{ route('admin.categories.update', ['category' => $category]) }}" method="post">
      <div class="form-group">
        <label for="title">Заголовки</label>

        <input type="text" class="form-control" name="title" id="title" value="{{ $category->title }}">
      </div>

      <div class="form-group">
        <label for="description">Описание</label>

        <textarea name="description" id="description" cols="30" rows="10" class="form-control">
          {{ $category->description }}
        </textarea>
      </div>

      {{--
      HTML-формы не поддерживают методы HTTP-запроса PUT или DELETE.
      Для того, чтобы отправить на сервер HTTP-запрос с этими методами,
      вам нужно добавить в форму скрытый input с именем _method.
      Значение этого поля будет восприниматься фреймворком как тип
      HTTP-запроса.

      грубо говоря - put - нужен когда мы что то обновляем в таблице (перезаписываем)
      что бы браузер не ругался и не выдавал ошибку типа
      просто сгенерирует скрытое поле
      со значением... <input type="hidden" name="_method" value="PUT">

      The POST method is not supported for this route. Supported methods:
      GET, HEAD, PUT, PATCH, DELETE.
      --}}
      @method('put')
      @csrf
      <button class="btn btn-primary">Сохранить</button>
    </form>

  </div>

@endsection