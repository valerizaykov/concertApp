@extends('layouts.app')

@section('content')
    <head>
        <title>view Events</title>
        <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
        <script type="text/javascript">
            function hideshow ()
            {
                document.getElementById("searchValue").style.visibility = "visible";
                if(document.getElementById("criteria").value == 'sortBand' ||
                    document.getElementById("criteria").value == 'sortDate' )
                {
                    document.getElementById("searchValue").style.visibility = "hidden";
                }
            }

        </script>
    </head>
    <body>
    {{ csrf_field() }}
    <div class="container">
        @auth
            <div class="content">
                <div class="linkstyle">
                    <h1>Blog Page</h1>
                    <table>
                        <tr>
                            <td>
                                <a class="btn btn-primary" href="{{ url('events/create') }}">Add new</a>
                            </td>
                            <td>
                                <form  action="{{ url('/events') }}" method="get">
                                    <input type="text" name="searchValue" id="searchValue"
                                        placeholder="Search by date ..." >
                                    <input type="submit" name="submit" value="ok" id="submit" class="btn btn-primary">
                                    <select id="criteria" name="criteria" onclick="hideshow()">
                                        <option value="searchByDate">search by date</option>
                                        <option value="searchByBand">search by band name</option>
                                        <option value="sortBand">sort by band name</option>
                                        <option value="sortDate">sort by date</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>

                <table border='1'>
                    <tr>
                        <th>Date</th>
                        <th>Name of the band</th>
                        <th>Location</th>
                        <th>Description</th>
                        <th>Photo of the band</th>
                        @foreach ($events as $event)
                        <tr>
                            <td>
                                {{$event->eventDate->format('j F Y')}}
                            </td>
                            <td>
                                {{$event->UserBand['band_name']}}
                            </td>
                            <td>
                                {{$event->location}}
                            </td>
                            <td>
                                {{$event->event_description}}
                            </td>
                            <td>
                                <img src="{{asset($event->UserBand['band_thumb_url'])}}">
                            </td>
                            <td>
                                <form method="post" action="{{ URL::to('events/' . $event->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="{{ URL::to('events/' . $event->id).'/edit' }}">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                        </tr>
                </table>
            </div>
            {{ $events->links() }}
        @endauth
    </div>

    </body>
@endsection
