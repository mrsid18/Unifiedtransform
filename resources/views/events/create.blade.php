@extends('layouts.app')

@section('title', __('Add Event'))
@section('after_scripts')
<link rel="stylesheet" href="{{ url('css/calendar.css') }}">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/evo-calendar@1.1.2/evo-calendar/js/evo-calendar.min.js"></script> --}}
<script src="{{ url('js/calendar.js')}}" defer></script>

@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
                <div class="page-panel-title">@lang('Add Event')
              </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="/academic/event">
                        @csrf
                        <div class="form-group">
                          <label for="title">Title</label>
                          <input name="title" class="form-control" id="title" placeholder="Annual Exam" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description (Optional)</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Add A Brief Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="type">Event Type</label>
                            <select name="type" class="form-control" id="type">
                                <option value="birthday" selected>Exam</option>
                                <option value="event">Event</option>
                                <option value="holiday">Holiday</option>
                            </select>
                        </div>
                          <div class="row form-group">
                              <div class="col-md-6">
                               <label for="from">Starts From</label>
                                <input name="starts_from" class="form-control" type="date" id="from" required>
                              </div>
                              <div class="col-md-6">
                                <label for="to">To (Optional)</label>
                                <input name="ends_at" class="form-control" type="date" id="to">
                              </div>
                          </div>
                         
                          <div class="form-group">
                              <button type="submit" class="btn-info btn">Create Event</button>
                          </div>
                    </form>
                      <div>
                        <div class="page-panel-title">@lang('Active Events')</div>
                          <div id="calendar" style="width: 80%;margin-top:3rem"></div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
      let events = <?= json_encode($events); ?>
     
    // // let eve = events.map(item => ({id: events.id, title: events.title}));
    // function getFdate(inpDate){
    //     let date = new Date(inpDate);
    //     return date.getMonth()+1 + "/" + date.getDate() + "/" + date.getFullYear();
    // }

    // let eve = events.map(event => ({id: event.id, name: event.title, date: [getFdate(event.starts_from),getFdate(event.ends_at)], type: event.event_type, description: event.description})); 
    // document.addEventListener('DOMContentLoaded', function() {
    //             $("#calendar").evoCalendar({
    //                 calendarEvents: eve,
    //                 todayHighlight: true,
    //                 sidebarDisplayDefault: false
    //             });
    //   });

</script>

@endsection
