@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <h1 class="mb-2">Page id {{ $page->id }}</h1>
    <div>
        <a class="btn btn-sm btn-outline-dark mb-2"
           href="{{ route('pages.index') }}">Back</a>
        <a class="btn btn-sm btn-secondary mb-2"
           href="{{ route('pages.edit', ['page' => $page->id]) }}">Edit</a>
    </div>

    <div class="card">
        <div class="card-header">{{ $page->name }}</div>
        <div class="card-body">
            <p>{{ $page->short_description }}</p>
            <p>{{ $page->full_description }}</p>
        </div>
    </div>
@stop
