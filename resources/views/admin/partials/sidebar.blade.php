
<div class="accordion" id="accordionExample">
    <div class="accordion-item">

        <div class="list-group list-group-flush">
            <ul class="list-group list-group-flush">
                <li class="list-group-item list-group-item-action {{ areActiveRoutes(['admin.dashboard']) }}">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="list-group-item list-group-item-action {{ areActiveRoutes(['admin.tickets']) }}">
                    <a class="nav-link" href="{{ route('admin.tickets') }}">Ticket List <span style="background-color: blue" class="badge badge-success">{{ $unreadTicketOpenNotifications }}</span> </a>
                </li>
                <li class="list-group-item list-group-item-action {{ areActiveRoutes(['admin.departments']) }}">
                    <a class="nav-link" href="{{ route('admin.departments') }}">Department</a>
                </li>
                <li class="list-group-item list-group-item-action {{ areActiveRoutes(['admin.settings']) }}">
                    <a class="nav-link" href="{{ route('admin.settings') }}">Settings</a>
                </li>
                <li class="list-group-item list-group-item-action {{ areActiveRoutes(['admin.list','admin.create']) }}">
                    <a class="nav-link" href="{{ route('admin.list') }}">Admin User</a>
                </li>
            </ul>
        </div>
    </div>
</div>
