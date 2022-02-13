@extends ('layouts.main')

@section ('title', 'Dashboard')

@section ('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>My Events</h1>
</div>

<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if (count($events) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Participants</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td scope="row">{{ $loop->index+1 }}</td>
                        <td><a href="{{ route('events.show', ['id'=>$event->id]) }}">{{ $event->title }}</a></td>
                        <td>{{ $event->participants_count }}</td>
                        <td>
                            <a href="{{ route('events.edit', ['id' => $event->id]) }}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon> Edit</a>
                            <form action="{{ route('events.destroy', ['id' => $event->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-btn "><ion-icon name="trash-outline"></ion-icon> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>You still don't have any event, <a href="{{ route('events.create') }}">Create Event</a></p>
    @endif
</div>

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>My Events as Participant</h1>
</div>


<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if (count($eventsAsParticipant) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Participants</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eventsAsParticipant as $event)
                    <tr>
                        <td scope="row">{{ $loop->index+1 }}</td>
                        <td><a href="{{ route('events.show', ['id'=>$event->id]) }}">{{ $event->title }}</a></td>
                        <td>{{ $event->participants_count }}</td>
                        <td>
                            <form action="{{ route('events.leave', ['id' => $event->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-btn "><ion-icon name="trash-outline"></ion-icon> Leave Event</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>You are still not participating in any event, <a href="{{ route('events') }}">Check all events</a></p>
    @endif
</div>

@endsection
