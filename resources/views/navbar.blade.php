<nav class="navbar navbar-expand-lg bg-info">
    <div class="container">
        <a title="Support Ticket System" class="navbar-brand" href="#">
            <h4 class="text-white">Ticket Support System</h4>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            </ul>
            @if(auth()->check())
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                this.closest('form').submit();" class="btn btn-success"
                       >({{ auth()->user()->name }}) Logout</a>
                </form>

            @else
                <a class="btn btn-success" href="/login">Login</a>
            @endif

        </div>
    </div>
</nav>
