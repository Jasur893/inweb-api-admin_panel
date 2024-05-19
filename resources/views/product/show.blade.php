@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <h1 class="mb-2">Product id {{ $product->id }}</h1>

    <div>
        <a class="btn btn-sm btn-outline-dark mb-2"
           href="{{ route('products.index') }}">Back</a>
        <a class="btn btn-sm btn-secondary mb-2"
           href="{{ route('products.edit', ['product' => $product->id]) }}">Edit</a>
    </div>

    <div class="card">
        <div class="text-center mt-3">
            <img class="card-img-top img-fluid w-50"
                 src="{{ asset('storage/' . $product->photo) }}"
                 alt="Card image cap"
            >
        </div>
        <div class="card-body">
            <div class="p-3 mb-2 bg-secondary text-white">{{ $product->category->name }}</div>
            <h4 class="text-black">{{ $product->name }}</h4>
            <p class="card-text">{{ $product->short_description }}</p>
            <p class="card-text">{{ $product->full_description }}</p>
        </div>
    </div>

@stop
