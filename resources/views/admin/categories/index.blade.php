@extends('layouts.admin')
@section('content')

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Категории</h1>
    <a href="{{ route('admin.categories.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-plus fa-sm text-white-50"></i> Добавить новую</a>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 100px;">
              #ID
              &nbsp;
              <a href="?sort=desc" style="text-decoration: none;">↓</a>
              &nbsp;
              <a href="?sort=asc" style="text-decoration: none;">↑</a>
            </th>
            <th>Заголовок</th>
            <th>Текст</th>
            <th>Управление</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($categories as $category)
            <tr>
              <td>{{ $category->id }}</td>
              <td>{{ $category->title }}</td>
              <td>{{ $category->description }}</td>
              <td>
                <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}" style="font-size: 12px;">ред.</a> |
                <a href="javascript:;" rel="{{ $category->id }}" class="delete" style="font-size: 12px; color: red;">уд.</a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4">Записей нет</td>
            </tr>
          @endforelse
        </tbody>
      </table>

      {{-- вызываем нашу пагинацию, задаем ее в контроллере ../Admin/CategoryController --}}
      {{ $categories->links() }}
    </div>
  </div>

@endsection

{{--
пушим наш скрипт (ajax)
все что находится в теле push
будет размещено в секции 'js'
что мы указали в файле
../layouts/admin.blade
--}}
@push('js')
  <script type="text/javascript">
    $(function() {
      $(".delete").on('click', function () {
        var id = $(this).attr('rel');

        if (confirm('Подтверждение удаление записи с ID#' + id + " ?")) {
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "DELETE",
            url: "/admin/categories/" + id,
            dataType: 'json',
            success: function (response) {
              alert('Запись удалена')
              location.reload();
            }
          })
        }
      });
    });
  </script>
@endpush
