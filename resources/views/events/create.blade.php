@extends ('layouts.main')

@section ('title', 'Create Event')

@section ('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Create your Event</h1>
    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Event Photo:</label>
            <input type="file" form-control-file" id="image" name="image" placeholder="Event Name">
        </div>
        <div class="form-group">
            <label for="title">Event Title:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Event Name" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="date">Event Date:</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}">
        </div>
        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Event Location" value="{{ old('city') }}">
        </div>
        <div class="form-group">
            <label for="private">Private Event?</label>
            <select name="private" id="private" class="form-control">
                <option value="0">No</option>
                <option value="1"{{ old('private') == 1 ? " selected='selected'" : "" }}>Yes</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control" placeholder="What's going on this event?">{{ old('description') }}</textarea>
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
        <input type="submit" class="btn btn-primary" value="Create Event">
    </form>
</div>

@endsection
