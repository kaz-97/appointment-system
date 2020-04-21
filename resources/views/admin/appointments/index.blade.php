@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
            <div class="col-md-12">
            <p>
                <a href="{{ route('admin.appointments.create') }}"><button type="button" class="btn btn-success">Schedule an Appointment</button></a>
         
            </p>

            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

            <div id='calendar'></div>

            <br />

                <div class="card">
                    <div class="card-header">
                        <h5>Appointments</h5>
                    </div>
                    <div class="card-body">

                    
                        
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Appointment">
                            <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Start Time
                                    </th>
                                    <th>
                                        Finish Time
                                    </th>
                                    <th>
                                        Instructor
                                    </th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($appointments as $appointment)
                                    <tr data-entry-id="{{ $appointment->id }}">
                                        <td>
                                            {{ $appointment->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $appointment->start_time ?? '' }}
                                        </td>
                                        <td>
                                            {{ $appointment->finish_time ?? '' }}
                                        </td>
                                        <td>
                                            {{ $appointment->instructor->name ?? '' }}
                                        </td>
                                        @can('appointment_show')
                                        <td>
                                            <a class="btn btn-xs btn-primary" href="{{ route('admin.appointments.show', $appointment->id) }}">
                                                View
                                            </a>
                                        @endcan

                                            @can('appointment_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.appointments.edit', $appointment->id) }}">
                                                    Edit
                                                </a>
                                            @endcan

                                            @can('appointment_delete')
                                                <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>

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
                    @foreach($appointments as $appointment)
                    {
                        title : '{{ $appointment->instructor_name }}',
                        start : '{{ $appointment->date . ' ' . $appointment->start_time }}',
                        end : '{{ $appointment->date . ' ' . $appointment->finish_time }}',
                        url : '{{ route('admin.appointments.edit', $appointment->id) }}'
                    },
                    @endforeach 
                ]
            })
        });
    </script>
@endsection