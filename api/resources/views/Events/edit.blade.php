@extends('dashboard.admin.dashboard')

@section('title', 'Events')
@section('content')
<div class="container">
    <h2 class="mb-4">Edit Event</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('Events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="form-group">
            <label for="title">Event Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $event->title) }}" required>
        </div>

        <div class="form-group">
            <label for="title">Event Prix</label>
            <input type="number" name="prix" id="prix" class="form-control" value="{{ old('prix', $event->prix) }}" required>
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $event->description) }}</textarea>
        </div>

        <!-- Start Date -->
        <div class="form-group">
            <label for="date_start">Start Date</label>
            <input type="date" name="date_start" id="date_start" class="form-control" value="{{ old('date_start', $event->date_start) }}" required>
        </div>

        <!-- End Date -->
        <div class="form-group">
            <label for="date_end">End Date</label>
            <input type="date" name="date_end" id="date_end" class="form-control" value="{{ old('date_end', $event->date_end) }}" required>
        </div>

        <!-- Location -->
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $event->location) }}" required>
        </div>

        <!-- Organizer -->
        <div class="form-group">
            <label for="organisateur_id">Organizer</label>
            <select name="organisateur_id" id="organisateur_id" class="form-control" required>
                <option value="" disabled>Select organizer</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" 
                        {{ old('organisateur_id',
                         $event->organisateur_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Category -->
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="" disabled>Select category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $event->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Event</button>
        <a href="{{ route('Events.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
