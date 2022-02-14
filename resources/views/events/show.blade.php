@extends ('layouts.main')

@section ('title', 'Event ' . $event->title)

@section ('content')

<div class="col-md-10 offset-md-1">
    <div class="row">
        <div id="image-container" class="col-md-6">
            <img src="{{ url('/') }}/{{ env('APP_EVENT_IMG_PATH') }}/{{ $event->image }}" class="img-fluid" alt="{{ $event->title }}">
        </div>
        <div id="info-container" class="col-md-6">
            <h1>{{ $event->title }}</h1>
            <p class="event-city"><ion-icon name="location-outline"></ion-icon>{{ $event->city }}</p>
            <p class="event-participants"><ion-icon name="people-outline"></ion-icon>{{ $event->participants_count }} {{ __('participants') }}</p>
            <p class="event-owner"><ion-icon name="star-outline"></ion-icon>{{ $event->user->name }}</p>
            @if ($event->curuser_participant == 0)
                <form action="{{ route('events.join', ['id' => $event->id]) }}" method="POST">
                    @csrf
                    <a href="" 
                        class="btn btn-primary" 
                        id="event-submit"
                        onclick="event.preventDefault();
                        this.closest('form').submit();">
                        {{ __('Confirm Attendence') }}
                    </a>
                </form>
            @else
                <p class="already-joined-msg">You're already participating in this event</p>
            @endif
            
            


            <h3>{{ __('Event has') }}:</h3>
            <ul id="items-list">
                @foreach ($event->items as $item)
                    <li><ion-icon name="play-outline"></ion-icon> <span>{{ $item }}</span></li>    
                @endforeach
            </ul>
        </div>
        <div class="col-md-12" id="description-container">
            <h3>{{ __('About the Event') }}:</h3>
            <p class="event-description">{{ $event->description }}</p>
        </div>
    </div>
</div>

@endsection
