@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <h1 class="mb-2">Product id {{ $product->id }} -- edit </h1>

    <div class="container">
        <form action="{{ route('products.update', ['product' => $product->id]) }}"
              method="POST"
              enctype="multipart/form-data"
        >
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input
                    name="name"
                    value="{{ $product->name }}"
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
                >{{ $product->short_description }}</textarea>
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
                >{{ $product->full_description }}</textarea>
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

            <button type="submit" class="btn btn-success">Update</button>
        </form>
        <div>
            <a class="btn btn-sm btn-outline-dark mt-2"
               href="{{ route('products.index') }}">Back</a>
        </div>
    </div>
@stop
