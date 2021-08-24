@extends('layouts.admin')
@section('content')

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Редактировать новость</h1>
    <a href="{{ route('admin.news.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-list fa-sm text-white-50"></i> К списку новостей</a>
  </div>

  <!-- Content Row -->
  <div class="row">

    @if ($errors->any())
      @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
      @endforeach
    @endif

    <form action="{{ route('admin.news.update', ['news' => $news]) }}" method="post">
      <div class="form-group">
        <label for="category_id">Категория</label>
        <select class="form-control" id="category_id" name="category_id">
          <option value="0">Выбрать категорию</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}" @if ($news->category_id === $category->id) selected @endif>
              {{ $category->title }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="author">Заголовок</label>
        <input type="text" class="form-control" name="title" id="title" value="{{ $news->title }}">

         {{--
         @error / @enderror
         Нужны что бы ошибки выводились под блоком содержащим ошибку
         а не в верху страници
         --}}
        @error('title')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        {{-- old() - хелпер сохраняющий последний запрос и выводящий его обратно --}}
        <label for="author">Автор</label>
        <input type="text" class="form-control" name="author" id="author" value="{{ $news->author }}">
        @error('author')
        <div style="color: red; font-weight: bold;">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="image">Изображение</label>
        <input type="text" class="form-control" name="image" id="image" value="{{ $news->image }}">
      </div>

      <div class="form-group">
        <label for="status">Статус</label>
        <select class="form-control" name="status" id="status">
          <option value="DRAFT" @if ($news->status === 'DRAFT') selected @endif>DRAFT</option>
          <option value="PUBLISHED" @if ($news->status === 'PUBLISHED') selected @endif>PUBLISHED</option>
          <option value="DELETED" @if ($news->status === 'DELETED') selected @endif>DELETED</option>
        </select>
      </div>

      <div class="form-group">
        <label for="description">Описание</label>
        <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $news->description }}</textarea>
      </div>

      @method('put')
      @csrf
      <button class="btn btn-primary">Сохранить</button>
    </form>

  </div>

@endsection
