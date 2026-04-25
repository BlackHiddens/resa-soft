<div class="navbar navbar-expand-xl">
    <ul class="navbar-nav navbar-offcanvas-menu" id="navbar-sidebar">

        <li class="nav-item"> <a class="nav-link" href="{{ route('second', ['agent' , 'dashboard']) }}"><i class="bi bi-house-door fa-fw me-1"></i>Dashboard</a> </li>

        <li class="nav-item"> <a class="nav-link" href="{{ route('second', ['agent' , 'listings']) }}"><i class="bi bi-journals fa-fw me-1"></i>Listings</a> </li>

        <li class="nav-item"> <a class="nav-link" href="{{ route('second', ['agent' , 'bookings']) }}"><i class="bi bi-bookmark-heart fa-fw me-1"></i>Bookings</a> </li>

        <li class="nav-item"> <a class="nav-link active" href="{{ route('second', ['agent' , 'activities']) }}"><i class="bi bi-bell fa-fw me-1"></i>Activities</a> </li>

        <li class="nav-item"> <a class="nav-link" href="{{ route('second', ['agent' , 'earnings']) }}"><i class="bi bi-graph-up-arrow fa-fw me-1"></i>Earnings</a> </li>

        <li class="nav-item"> <a class="nav-link" href="{{ route('second', ['agent' , 'reviews']) }}"><i class="bi bi-star fa-fw me-1"></i>Reviews</a></li>

        <li class="nav-item"> <a class="nav-link" href="{{ route('second', ['agent' , 'settings']) }}"><i class="bi bi-gear fa-fw me-1"></i>Settings</a></li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdoanMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-list-ul fa-fw me-1"></i>Dropdown
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdoanMenu">
                <!-- Dropdown menu -->
                <li> <a class="dropdown-item" href="#">Item 1</a></li>
                <li> <a class="dropdown-item" href="#">Item 2</a></li>
            </ul>
        </li>
    </ul>
</div>