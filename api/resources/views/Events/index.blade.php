@extends('dashboard.admin.dashboard')

@section('title', 'Events')


@section('content')
<div class="container">
    <!-- Top section: Title and Add button -->
    <div class="top-section">
        <h2 class="title">Events</h2>
        <a href="{{ route('Events.create') }}" class="btn btn-primary">Add Event</a>
    </div>

    <!-- Events Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Prix</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Location</th>
                <th>Organizer</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>{{ $event->title }}</td>
                <td>{{ $event->prix }}</td>
                <td>{{ $event->description }}</td>
                <td>{{ $event->date_start }}</td>
                <td>{{ $event->date_end }}</td>
                <td>{{ $event->location }}</td>
                <td>{{ $event->organizer->name }}</td>
                <td>{{ $event->category->name }}</td>
                <td>
                    <a href="{{ route('checkout', $event->id) }}" class="btn btn-primary">
                        Payer et s'inscrire
                    </a>
                    <a href="{{ route('Events.edit', $event->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('Events.destroy', $event->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
