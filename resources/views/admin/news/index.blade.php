@extends('layouts.admin')
@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Новости</h1>
  <a href="{{ route('admin.news.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
      class="fas fa-plus fa-sm text-white-50"></i> Добавить новую</a>
</div>

<!-- Content Row -->
<div class="row">

  @include('inc.message')

  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Заголовок</th>
          <th>Категории</th>
          <th>Статус</th>
          <th>Автор</th>
          <th>Дата добавления</th>
          <th>Управление</th>
        </tr>
      </thead>

      {{--
      optional - не выдаст ошибки если связи между таблицами нету
      без него - впадет в ошибку
      --}}
      <tbody>
      @forelse ($newsList as $news)
        <tr>
          <td>{{ $news->title }}</td>
          <td>{{ optional($news->category)->title }}</td>
          <td>{{ $news->status }}</td>
          <td>{{ $news->author }}</td>
          <td>
            @if ($news->updated_at)
              {{ $news->updated_at->format('d-m-y H:i') }}
            @else
              {{ now()->format('d-m-y H:i') }}
            @endif
          </td>
          <td style="display: flex;">
            <a href="{{ route('admin.news.edit', ['news' => $news->id]) }}"
               style="font-size: 12px;
                  background: lightgreen;
                  border-radius: 4px;
                  transform: none;
                  padding: 6px 4px 0 4px;
                  text-decoration: none;"
            >ред.</a> |

            <form action="{{ route('admin.news.destroy', $news) }}" method="POST">
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
          <td colspan="4">Новостей не найдено</td>
        </tr>
      @endforelse
      </tbody>
    </table>

    {{ $newsList->links() }}
  </div>

</div>

@endsection
