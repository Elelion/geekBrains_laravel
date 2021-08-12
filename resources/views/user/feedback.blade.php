@extends('layouts.admin')
@section('content')

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Данные пользователя</h1>
  </div>

  <!-- Content Row -->
  <div class="row">

    <form action="{{ route('user.check') }}" method="post">
      <div class="form-group">
        <label for="name">Имя</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
      </div>

      <div class="form-group">
        <label for="email">eMail</label>
        <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
      </div>

      <div class="form-group">
        <label for="prone">Телефон</label>
        <input type="text" class="form-control" name="prone" id="prone" value="{{ old('prone') }}">
      </div>

      @csrf
      <button class="btn btn-primary">Отправить</button>
    </form>

  </div>

@endsection
