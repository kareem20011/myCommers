<nav class="navbar navbar-expand bg-dark navbar-dark sticky-top px-4 py-0">
    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    <div class="navbar-nav align-items-center ms-auto">


        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                @if(count(auth('admin')->user()->getMedia('images')) > 0)
                    <img class="rounded-circle me-lg-2" src="{{ auth('admin')->user()->getFirstMedia('images')->getUrl() }}" alt="" style="width: 40px; height: 40px;">
                    @else
                    <img class="rounded-circle me-lg-2" src="{{ asset('media/temp.jpeg') }}" alt="" style="width: 40px; height: 40px;">
                @endif
                <span class="d-none d-lg-inline-flex">{{ auth('admin')->user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                <a href="{{ route('admin.profile.edit') }}" class="dropdown-item">My Profile</a>
                <a href="#" class="dropdown-item">Settings</a>
                <form action="{{ route('admin.logout') }}" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</nav>
