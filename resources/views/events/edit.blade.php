@extends ('layouts.main')

@section ('title', 'Create Event')

@section ('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Create your Event</h1>
    <form action="{{ route('events.update', ['id' => $event->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Event Photo:</label>
            <input type="file" form-control-file" id="image" name="image" placeholder="Event Name">
            <img src="{{ url('/') }}/{{ env('APP_EVENT_IMG_PATH') }}/{{ $event->image }}" alt="{{ $event->title }}" class="img-preview">
        </div>
        <div class="form-group">
            <label for="title">Event:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Event Name" value="{{ old('title') ?? $event->title }}">
        </div>
        <div class="form-group">
            <label for="date">Event Date:</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ old('date') ?? $event->date->format('Y-m-d') }}">
        </div>
        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Event Location" value="{{ old('city') ?? $event->city }}">
        </div>
        <div class="form-group">
            <label for="private">Private Event?</label>
            <select name="private" id="private" class="form-control">
                <option value="0">No</option>
                <option value="1"{{ (old('private') ?? $event->private) == 1 ? " selected='selected'" : "" }}>Yes</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control" placeholder="What's going on this event?">{{ old('description') ?? $event->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="items">Add Infrastructure Items:</label>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Chairs">Chairs
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Stage">Stage
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Free Beer">Free Beer
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Open Food">Open Food
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Gifts">Gifts
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Edit Event">
    </form>
</div>

@endsection
