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
    <h1 class="h3 mb-0 text-gray-800">Пользователи</h1>
    <a href="{{ route('admin.users.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-plus fa-sm text-white-50"></i> Добавить нового</a>
  </div>

  <!-- Content Row -->
  <div class="row">

    @include('inc.message')

    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
        <tr>
          <th>Имя</th>
          <th>Почта</th>
          <th>Дата добавления</th>
          <th>Админ</th>
          <th>Управление</th>
        </tr>
        </thead>

        {{--
        optional - не выдаст ошибки если связи между таблицами нету
        без него - впадет в ошибку
        --}}
        <tbody>
        @forelse ($usersList as $user)
          <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
              @if ($user->updated_at)
                {{ $user->updated_at }}
              @else
                {{ now()->format('d-m-y H:i') }}
              @endif
            </td>
            <td>
              @if ($user->is_admin == 1)
                <p>да</p>
              @else
                <p>нет</p>
              @endif
            </td>

            <td style="display: flex;">
              <a href="{{ route('admin.users.edit', $user) }}"
                 style="font-size: 12px;
                  background: lightgreen;
                  border-radius: 4px;
                  transform: none;
                  padding: 6px 4px 0 4px;
                  text-decoration: none;"
              >ред.</a> |

              <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button class="btn btn btn-danger"
                        style="font-size: 12px;
                          float: left;"
                        type="submit">уд.</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4">Пользователей не найдено</td>
          </tr>
        @endforelse
        </tbody>
      </table>

      {{ $usersList->links() }}
    </div>

  </div>

@endsection
