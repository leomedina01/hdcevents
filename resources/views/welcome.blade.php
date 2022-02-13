@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')

    <div id="search-container" class="col-md-12">
        <h1>Find an event</h1>
        <form action="{{ route('events') }}" method="GET">
            <input type="text" id="search" name="search" class="form-control" placeholder="Search..." value="{{ $search }}">
        </form>
    </div>
    <div id="events-container" class="col-md-12">
        @if ($search)
            <h2>{{ __('Searching for') . ': ' . $search }} </h2>
        @else
            <h2>{{ __('Next Events') }}</h2>
            <p class="subtitle">{{ __('Check upcoming events') }}</p>    
        @endif
                
        <div id="cards-container" class="row">
            @if (count($events) == 0) 
                @if ($search)
                    <p>{{ __('No events were found that match the search criteria') }}</p>
                @else
                    <p>{{ __('There are no available events') }}</p>    
                @endif
            @else
                @foreach ($events as $event)
                    <div class="card col-md-3">
                        <img src="{{ url('/') }}/img/events/{{ $event->image }}" alt="{{ $event->title }}">
                        <div class="card-body">
                            <p class="card-date">{{ date('d/m/Y', strtotime($event->date)) }}</p>
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <h6 class="card-owner">{{ $event->user->name }}</h6>
                            <p class="card-participants">{{ $event->participants_count }} {{ __('participants') }}</p>
                            <a href="{{ route('events.show', ['id' => $event->id]) }}" class="btn btn-primary">Find out More</a>
                        </div>
                    </div>
                @endforeach    
            @endif
            
        </div>
    </div>    
@endsection