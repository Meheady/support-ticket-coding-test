
<div class="accordion" id="accordionExample">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Ticket
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="list-group list-group-flush">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item list-group-item-action">
                            <a class="nav-link" href="">Test</a>
                        </li>
                        <li class="list-group-item list-group-item-action">
                            <a class="nav-link" href="">Test 1</a>
                        </li>
                        <li class="list-group-item list-group-item-action">
                            <a class="nav-link" href="">Test 3</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="list-group list-group-flush">
            <ul class="list-group list-group-flush">
                <li class="list-group-item list-group-item-action {{ areActiveRoutes(['admin.departments']) }}">
                    <a class="nav-link" href="{{ route('admin.departments') }}">Department</a>
                </li>
                <li class="list-group-item list-group-item-action {{ areActiveRoutes(['admin.settings']) }}">
                    <a class="nav-link" href="{{ route('admin.settings') }}">Settings</a>
                </li>
            </ul>
        </div>
    </div>
</div>
