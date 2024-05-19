@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <h1 class="mb-2">Ctegory id {{ $category->id }}</h1>

    <div>
        <a class="btn btn-sm btn-outline-dark mb-2"
           href="{{ route('categories.index') }}">Back</a>
        <a class="btn btn-sm btn-secondary mb-2"
           href="{{ route('categories.edit', ['category' => $category->id]) }}">Edit</a>
    </div>

    <div class="card">
        <div class="text-center mt-3">
            <img class="card-img-top img-fluid w-50"
                 src="{{ asset('storage/' . $category->photo) }}"
                 alt="Card image cap"
            >
        </div>
        <div class="card-body">
            <h4 class="text-black">{{ $category->name }}</h4>
            <p class="card-text">{{ $category->short_description }}</p>
            <p class="card-text">{{ $category->full_description }}</p>
        </div>
    </div>

@stop
