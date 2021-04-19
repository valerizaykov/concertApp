<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Event;
use App\userBand;
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const  page_number = 5;
    public function index(Request $request)
    {
        $events = Event::paginate(EventController::page_number) ;
        if($request->submit == "ok")
        {
            $events = $this->search($request);
        }
        return view('eventsDisplay', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userBands = userBand::all();
        return view('eventCreate',['userBands' => $userBands]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'eventDate' => 'required|date_format:Y-m-d',
            'location' => 'required',
            'event_description' => 'required',
        ]);
        $event = new Event;
        $event->location = $request->location;
        $event->event_description = $request->event_description;
        $event->user_band_id = $request->userBand;
        $event->eventDate = $request->eventDate;
        $event->save();
        return redirect('/events');
    }

    public function search(Request $request)
    {
        if($request->criteria =='searchByDate'){
            $events = Event::where('eventDate',$request->searchValue)->paginate(EventController::page_number);
        }
        else if ($request->criteria =='searchByBand')
        {
            $events = Event::whereHas('UserBand', function ($query) use($request) {
                $str = $request->searchValue;
                return $query->where('band_name','like','%'.$str.'%');
            })->paginate(EventController::page_number);
        }
        else if ($request->criteria =='sortBand')
        {
            $events = Event::whereHas('UserBand', function ($query) {
                return $query->orderBy('band_name');
            })->paginate(EventController::page_number);
        }
        else if ($request->criteria =='sortDate')
        {
            $events = Event::orderBy('eventDate')->paginate(EventController::page_number);
        }
        return $events;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        return view('eventEdit',['event'=>$event]);
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
        $request->validate([
            'eventDate' => 'required|date_format:Y-m-d',
            'location' => 'required',
            'event_description' => 'required',
        ]);
        $event = Event::find($id);
        $event->location = $request->location;
        $event->event_description = $request->event_description;
        $event->eventDate = $request->eventDate;
        $event->save();
        return redirect('/events');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id)->delete();
        return redirect('/events');
    }
}
