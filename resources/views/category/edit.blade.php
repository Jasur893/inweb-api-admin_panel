@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="mb-2">Page id {{ $category->id }} -- edit</h1>

    <div class="container">
        <form action="{{ route('categories.update', ['category' => $category->id]) }}"
              method="POST"
              enctype="multipart/form-data"
        >
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input
                    name="name"
                    value="{{ $category->name}}"
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
                >{{ $category->short_description}}</textarea>
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
                >{{ $category->full_description}}</textarea>
                @error('full_description')
                <p class="help-block text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Example file input</label>
                <input name="photo" type="file" class="form-control-file" id="image">
                <img src="{{ asset(asset('storage/' . $category->photo)) }}"
                     width="40px" height="40px"  alt="Rasm"
                >
                @error('photo')
                <p class="help-block text-danger">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
        <div>
            <a class="btn btn-sm btn-outline-dark mt-2"
               href="{{ route('categories.show', ['category' => $category->id]) }}">Back</a>
        </div>
    </div>

@stop
