
<div class="accordion" id="accordionExample">
    <div class="accordion-item">
        <div class="list-group list-group-flush">
            <ul class="list-group list-group-flush">
                <li class="list-group-item list-group-item-action {{ areActiveRoutes(['customer.dashboard']) }}">
                    <a class="nav-link" href="{{ route('customer.dashboard') }}">Dashboard</a>
                </li>
                <li class="list-group-item list-group-item-action {{ areActiveRoutes(['customer.tickets.create']) }}">
                    <a class="nav-link" href="{{ route('customer.tickets.create') }}">Open Ticket</a>
                </li>
                <li class="list-group-item list-group-item-action {{ areActiveRoutes(['customer.tickets','customer.tickets.view']) }}">
                    <a class="nav-link" href="{{ route('customer.tickets') }}">Ticket List  <span style="background-color: blue" class="badge badge-success">{{ $unreadTicketReplyNotifications }}</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
