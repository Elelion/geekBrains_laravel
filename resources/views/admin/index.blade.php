@extends('layouts.admin')
@section('content')

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Админ панель</h1>
    <a href="{{ route('admin.news.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-plus fa-sm text-white-50"></i> Добавить новую</a>

  </div>
  <div class="row">
    <p>Всего новостей: {{ $countNews }}</p>
    <p>Всего категорий: {{ $countCategories }}</p>
  </div>

@endsection