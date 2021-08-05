@extends('layouts.master')
@section('title', 'новости')
@section('content')

<div class="container">
  <p>s h o w</p>
  <p>{{ $type ?? 'Какой то параметр' }} с id: {{ $id ?? '' }}</p>
</div>

@endsection
