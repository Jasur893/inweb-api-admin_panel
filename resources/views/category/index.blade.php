@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between align-content-center mb-3">
        <h1>Category List</h1>
        <a class="btn btn-success btn-sm" href="{{ route('categories.create') }}">Create</a>
    </div>

    @if(session('status') === 'success')`
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Created successfully!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <table class="table table-striped">

        @if(sizeof($categories))
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Short Description</th>
                <th scope="col">Full description</th>
                <th scope="col">Image</th>
                <th scope="col">Handle</th>
            </tr>
            </thead>
        @endif

        <tbody>
        @forelse($categories as $category)
            <tr>
                <th scope="row">{{ $category->id }}</th>
                <td>{{ $category->name }}</td>
                <td>{{ $category->short_description }}</td>
                <td>{{ $category->full_description }}</td>
                <td class="p-1">
                    <img height="70" width="70"
                         class="img-fluid" src="{{ asset('storage/' . $category->photo) }}"
                         alt="image">
                </td>
                <td class="d-flex align-content-center">
                    <a class="btn btn-primary btn-sm mr-1"
                       href="{{ route('categories.show', ['category' => $category->id]) }}">Show</a>
                    <form
                        action="{{ route('categories.destroy', ['category' => $category->id]) }}"
                        method="POST"
                    >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" >Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <h1 class="text-center mt-2">Categories empty!</h1>
        @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $categories->links() }}
    </div>
@stop
