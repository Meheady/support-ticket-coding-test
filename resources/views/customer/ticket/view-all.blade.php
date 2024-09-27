@extends('customer.layout')
@section('content')
    <div>
        <h6>Your All Opened Ticket </h6>

        <form method="GET" action="{{ route('customer.tickets') }}">
            <div class="row">
                <div class="col-md-3">
                    <label for="status">Status</label>
                    <select class="form-control" name="status">
                        <option value="">All</option>
                        <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="reply" {{ request('status') == 'reply' ? 'selected' : '' }}>Reply</option>
                        <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="department_id">Department</label>
                    <select class="form-control" name="department_id">
                        <option value="">All</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{ request('department_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 align-self-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('customer.tickets') }}" class="btn btn-primary">Reset</a>
                </div>
            </div>
        </form>
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
