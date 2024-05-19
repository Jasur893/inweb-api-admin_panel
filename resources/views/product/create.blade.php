@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <h1 class="mb-2">Create Product</h1>

    <div class="container">
        <form action="{{ route('products.store') }}"
              method="POST"
              enctype="multipart/form-data"
        >
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input
                    name="name"
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
                <label class="my-1 mr-2" for="category">Category</label>
                <select name="category_id" class="custom-select my-1 mr-sm-2" id="category">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="short">Short Description</label>
                <textarea
                    name="short_description"
                    class="form-control"
                    id="short"
                    rows="3"
                ></textarea>
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
                ></textarea>
                @error('full_description')
                <p class="help-block text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Example file input</label>
                <input name="photo" type="file" class="form-control-file" id="image">
                @error('photo')
                <p class="help-block text-danger">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Create</button>
        </form>
        <div>
            <a class="btn btn-sm btn-outline-dark mt-2"
               href="{{ route('products.index') }}">Back</a>
        </div>
    </div>
@stop
