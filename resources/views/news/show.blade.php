@extends('layouts.main')
@section('title', 'новости')
@section('content')

<div class="container">
  <p>{{ $type ?? 'Какой то параметр' }} с id: {{ $id ?? '' }}</p>
</div>

@endsection
