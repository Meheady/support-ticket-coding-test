@extends('admin.layout')

@section('content')
    <div>

        <div class="card bg-success">
            <div class="card-body text-white">
                <h5>Ticket: # {{ $ticket->ticket_no }}</h5>
                <p><strong>Subject:</strong> {{ $ticket->subject }}</p>
                <p><strong>Status:</strong>  {{ ucfirst($ticket->status) }}</p>
                <p><strong>Description:</strong> {{ $ticket->description }}</p>
            </div>
        </div>


        <h4>Replies:</h4>
        @foreach($ticket->replies as $reply)
            <div class="card mb-3">
                <div class="card-body">
                    <p><strong>{{ $reply->user->name }}:</strong></p>
                    <p>{{ $reply->response }}</p>
                </div>
            </div>
        @endforeach

        <form action="{{ route('admin.tickets.reply', $ticket->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="py-2" >Your Reply</label>
                <textarea class="form-control" name="response" rows="3" required></textarea>
                @if ($errors->has('response'))
                    <span class="text-danger">{{ $errors->first('response') }}</span>
                @endif
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="description">Attachment</label>
                        <input type="file" class="form-control" name="attachment">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="priority">Status</label>
                        <select class="form-control"  name="status" required>
                            @foreach(\App\Models\Ticket::getStatusOptions() as $value => $label)
                                <option {{ $value == 'reply'? 'selected':'' }} value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success mt-3">Submit Response</button>
        </form>
    </div>
@endsection