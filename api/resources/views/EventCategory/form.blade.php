@extends('dashboard.admin.dashboard')

@section('title', 'Events')

@section('content')
<div class="container">
    <h2 class="mb-4">{{ isset($category) ? 'Edit Category' : 'Add New Category' }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($category) ? route('EventCategory.update', $category->id) : route('EventCategory.store') }}" method="POST">
        @csrf
        @if (isset($category))
            @method('PUT')
        @endif

        <!-- Name -->
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name ?? '') }}" required>
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $category->description ?? '') }}</textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">{{ isset($category) ? 'Update Category' : 'Add Category' }}</button>
        <a href="{{ route('EventCategory.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
