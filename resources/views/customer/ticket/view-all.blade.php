@extends('customer.layout')
@section('content')
    <div>
        <h6>Your All Opened Ticket </h6>
        <table class="table mt-3 table-striped ">
            <thead>
            <tr>
                <th>ID</th>
                <th>Subject</th>
                <th>Description</th>
                <th>Status</th>
                <th>View</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td># {{ $ticket->ticket_no }}</td>
                    <td>{{ $ticket->subject }}</td>
                    <td>{{ $ticket->description }}</td>
                    <td>{{ $ticket->status }}</td>
                    <td>
                        <a href="{{ route('customer.tickets.view', $ticket->id) }}" class="btn btn-info btn-sm ">View</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
