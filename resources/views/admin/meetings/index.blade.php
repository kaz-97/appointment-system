@extends('layouts.app')

@section('content')
    <h3 class="page-title">Lecturer Meeting Availability</h3>

    <p>
        <a href="{{ route('admin.meetings.create') }}" class="btn btn-success">Add New</a> 
    </p>
    

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

    <div id='calendar'></div>

@stop

@section('javascript')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <script>
        $(document).ready(function() {
            // page is now ready, initialize the calendar...
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                defaultView: 'agendaWeek',
                events : [
                    @foreach($meetings as $meeting)
                    {
                        title : '{{ $meeting->instructor_name }}',
                        start : '{{ $meeting->date . ' ' . $meeting->start_time }}',
                        end : '{{ $meeting->date . ' ' . $meeting->finish_time }}',
                        url : '{{ route('admin.meetings.edit', $meeting->id) }}'
                    },
                    @endforeach 
                ]
            })
        });
    </script>
@endsection