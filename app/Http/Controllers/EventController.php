<?php

namespace App\Http\Controllers;

use App\Event as Event;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($class_id)
    {
      return ($class_id > 0)? EventResource::collection(Event::where('class_id', $class_id)->get()):response()->json(['Invalid Class id: '. $class_id, 404]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $events = Event::bySchool(\Auth::user()->school_id)->get();
      return view('events.create',['events' => $events]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   $event = new Event;
      $validateData = $request->validate([
        'title' => 'required',
        'starts_from' => 'required|date',
        
      ]);
        // dd($request);
      $event->school_id = \Auth::user()->school_id;
      $event->user_id = \Auth::user()->id;
      $event->title = $request->title;
      $event->starts_from = $request->starts_from;
      $event->ends_at = ($request->ends_at == NULL)? $request->starts_from : $request->ends_at;
      // $event->description = $request->description;
      $event->event_type = $request->type;
      $event->save();
      return back()->with('status', __('Event Created'));

      // $tb = new Event;
      // $tb->file_path = $request->file_path;
      // $tb->title = $request->title;
      // $tb->active = 1;
      // $tb->school_id = \Auth::user()->school_id;
      // $tb->user_id = \Auth::user()->id;
      // $tb->save();
   
      // dd($event);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new EventResource(Event::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
      $tb = Event::destroy($id);
      return back()->with('status','Event removed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      return (Event::destroy($id))?response()->json([
        'status' => 'success'
      ]):response()->json([
        'status' => 'error'
      ]);
    }
}
