<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class EventController extends Controller
{
    /**
     * Check if user is the owner of an event
     */
    /*private function _checkEventOwner ($eventUserId) {
        $user = auth()->user();
        if ($eventUserId != $user->id) {
            redirect (route('dashboard'));
            exit;
        }
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request('search');
        if ($search) {
            $events = Event::where([
                ['title', 'like', '%' . $search . '%']
            ])
            ->withCount('participants')
            ->with('user')
            ->get();
        } else {
            //$events = Event::withCount('participants')->get();
            $events = Event::withCount('participants')
                    ->with('user')
                    ->get();
        }

        //print_r($events->user); die;

        return view('welcome', [
            'events' => $events,
            'search' => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = new Event();
        $event->title = $request->title;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;

        //Image upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;
            $ext = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . '.' . $ext;
            $requestImage->move(public_path('img/events'), $imageName);
            $event->image = $imageName;
        }

        $event->items = $request->items;
        $event->date = $request->date;

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect (route('events'))->with('msg', 'Event was created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::withCount([
            'participants', 
            'participants as curuser_participant' => function (Builder $query) {
                $user = auth()->user();
                $query->where('user_id', $user->id);
            }
        ])->with('user')
        ->findOrFail($id);

        //$eventOwner = User::where('id', $event->user_id)->first();
        return view ('events.show', ['event' => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);

        // Check if user is the owner of this event
        $user = auth()->user();
        if ($event->user_id != $user->id) {
            return redirect (route('events'));
        }

        return view('events.edit', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $event = Event::findOrFail($request->id);
        
        // Check if user is the owner of this event
        $user = auth()->user();
        if ($event->user_id != $user->id) {
            return redirect (route('events'));
        }

        $event->update($data);

        //Image upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;
            $ext = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . '.' . $ext;
            $requestImage->move(public_path('img/events'), $imageName);
            $data['image'] = $imageName;
        }

        return redirect (route('dashboard'))->with('msg', 'Event updated sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        // Check if user is the owner of this event
        $user = auth()->user();
        if ($event->user_id != $user->id) {
            return redirect (route('events'));
        }

        $event->delete();

        return redirect (route('dashboard'))->with('msg', 'Event deleted sucessfully');
    }

    public function dashboard() {
        $user = auth()->user();

        $events = $user->events()
        ->withCount('participants')
        ->get();

        $eventsAsParticipant = $user->eventsAsParticipant()
        ->withCount('participants')
        ->get();
        
        //var_dump($events); die;
        return view ('events.dashboard', ['events' => $events, 'eventsAsParticipant' => $eventsAsParticipant]);
    }

    public function join($id) {
        $user = auth()->user();
        $user->eventsAsParticipant()->attach($id);
        $event = Event::findOrFail($id);
        return redirect (route('events.show', ['id' => $id]))->with('msg', 'Your attendence is confirmed on event ' . $event->title);
    }

    public function leave($id) {
        $user = auth()->user();
        $user->eventsAsParticipant()->detach($id);
        $event = Event::findOrFail($id);
        return redirect (route('dashboard'))->with('msg', 'You left event ' . $event->title . ' successfully ');
    }
}
 