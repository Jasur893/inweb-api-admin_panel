@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="mb-2">Page id {{ $page->id }} -- edit</h1>

    <div class="container">
        <form action="{{ route('pages.update', ['page' => $page->id]) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input
                    name="name"
                    value="{{ $page->name}}"
                    type="text"
                    class="form-control"
                    id="name"
                    placeholder="Enter name"
                >
                @error('name')
                <p class="help-block text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="short">Short Description</label>
                <textarea
                    name="short_description"
                    class="form-control"
                    id="short"
                    rows="3"
                >{{ $page->short_description}}</textarea>
                @error('short_description')
                <p class="help-block text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="full">Full Description</label>
                <textarea
                    name="full_description"
                    class="form-control"
                    id="full"
                    rows="5"
                >{{ $page->full_description}}</textarea>
                @error('full_description')
                <p class="help-block text-danger">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
        <div>
            <a class="btn btn-sm btn-outline-dark mt-2"
               href="{{ route('pages.show', ['page' => $page->id]) }}">Back</a>
        </div>
    </div>

@stop
