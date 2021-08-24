@extends('layouts.main')
@section('title', 'главная')
@section('content')

  {{--
  NOTE:
  @forelse - аналог foreach который включает в себя ОБЯЗАТЕЛЬНО - условие (@empty)

  аналогичная запись:
  foreach... {
      ...
      if... {
        ...
      }
    }

  --}}
  @forelse ($newsList as $item)

    <!-- Post preview-->
    <div class="post-preview">
      {{--
      NOTE:
      {{  }} - аналогично выводу <?= ?> так же они экранируют переменную
      {{  !! !! }} - НЕ экранируют переменную
      --}}
      <a href="{{ route('news.show', ['news' => $item->id]) }}">
        <h2 class="post-title">{{ $item->title }}</h2>
        <h3 class="post-subtitle">{{ $item->description }}</h3>
      </a>
      <p class="post-meta">
        Опубликовал
        <a href="#">{{ $item->author }}</a>
        oт {{ $item->updated_at }}
      </p>
    </div>

    <!-- Divider-->
    <hr class="my-4" />

  @empty
    <h1>Новостей нет</h1>

  @endforelse

  <!-- Pager-->
  <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>

@endsection
