@extends('layouts.master')
@section('title', 'главная')
@section('content')

<div class="container">
  <p>m a i n</p>
  <br>
  @foreach($news as $item)
    <div class="items__links">
      <strong class="text-success">
        <a href="{{ route('news.show', [$item['id'], $type = 'Новость']) }}">
          {{ $item['title'] }}
        </a>
      </strong>

      <i class="text-info">
        <a href="{{ route('news.show', [$item['id'], $type = 'Описание']) }}">
          {{ $item['description'] }}
        </a>
      </i>
    </div>
  @endforeach
</div>

@endsection
