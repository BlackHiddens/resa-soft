@extends('layouts.base')

@section('header')
<!-- Header START -->
<header class="navbar-light header-sticky">
    <!-- Logo Nav START -->
    <nav class="navbar navbar-expand-xl">
        <div class="container">
            <!-- Logo START -->
            <a class="navbar-brand" href="{{ route('root') }}">
                <img class="light-mode-item navbar-brand-item" src="/images/logo.svg" alt="logo">
                <img class="dark-mode-item navbar-brand-item" src="/images/logo-light.svg" alt="logo">
            </a>
            <!-- Logo END -->

            <!-- Responsive navbar toggler -->
            <button class="navbar-toggler ms-auto mx-3 me-md-0 p-0 p-sm-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-animation">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </button>

            <!-- Main navbar START -->
            <div class="navbar-collapse collapse" id="navbarCollapse">
                <ul class="navbar-nav navbar-nav-scroll">

                    <!-- Nav item Listing -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="listingMenu" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Listings</a>
                        <ul class="dropdown-menu" aria-labelledby="listingMenu">
                            <!-- Dropdown submenu -->
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item dropdown-toggle" href="#">Hotel</a>
                                <ul class="dropdown-menu" data-bs-popper="none">
                                    <li> <a class="dropdown-item" href="{{ route('root') }}">Hotel Home</a></li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['hotel', 'index-chain']) }}">Hotel Chain</a></li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['hotel', 'index-resort']) }}">Hotel Resort</a>
                                    </li>
                                    <li> <a class="dropdown-item" href="{{ route('second', ['hotel', 'grid']) }}">Hotel
                                            Grid</a></li>
                                    <li> <a class="dropdown-item" href="{{ route('second', ['hotel', 'list']) }}">Hotel
                                            List</a></li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['hotel', 'detail']) }}">Hotel Detail</a></li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['hotel', 'room-detail']) }}">Room Detail</a></li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['hotel', 'booking']) }}">Hotel Booking</a></li>
                                </ul>
                            </li>

                            <!-- Dropdown submenu -->
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item dropdown-toggle" href="#">Flight</a>
                                <ul class="dropdown-menu" data-bs-popper="none">
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['flight', 'index-flight']) }}">Flight Home</a>
                                    </li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['flight', 'list']) }}">Flight List</a></li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['flight', 'detail']) }}">Flight Detail</a></li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['flight', 'booking']) }}">Flight Booking</a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Dropdown submenu -->
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item dropdown-toggle" href="#">Tour</a>
                                <ul class="dropdown-menu" data-bs-popper="none">
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['tour', 'index-tour']) }}">Tour Home</a></li>
                                    <li> <a class="dropdown-item" href="{{ route('second', ['tour', 'grid']) }}">Tour
                                            Grid</a></li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['tour', 'detail']) }}">Tour Detail</a></li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['tour', 'booking']) }}">Tour Booking</a></li>
                                </ul>
                            </li>

                            <!-- Dropdown submenu -->
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item dropdown-toggle" href="#">Cab</a>
                                <ul class="dropdown-menu" data-bs-popper="none">
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['cab', 'index-cab']) }}">Cab Home</a></li>
                                    <li> <a class="dropdown-item" href="{{ route('second', ['cab', 'list']) }}">Cab
                                            List</a></li>
                                    <li> <a class="dropdown-item" href="{{ route('second', ['cab', 'detail']) }}">Cab
                                            Detail</a></li>
                                    <li> <a class="dropdown-item" href="{{ route('second', ['cab', 'booking']) }}">Cab
                                            Booking</a></li>
                                </ul>
                            </li>

                            <!-- Dropdown submenu -->
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item dropdown-toggle" href="#">Directory</a>
                                <ul class="dropdown-menu" data-bs-popper="none">
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['directory', 'index-directory']) }}">Directory
                                            Home</a></li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['directory', 'detail']) }}">Directory Detail</a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Dropdown submenu -->
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item dropdown-toggle" href="#">Add Listing</a>
                                <ul class="dropdown-menu" data-bs-popper="none">
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['listing', 'join-us']) }}">Join us</a></li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['listing', 'add-listing']) }}">Add Listing</a>
                                    </li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['listing', 'add-listing-minimal']) }}">Add
                                            Listing Minimal</a></li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['listing', 'listing-added']) }}">Listing
                                            Added</a></li>
                                </ul>
                            </li>

                            <!-- Dropdown submenu -->
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item dropdown-toggle" href="#">Hero</a>
                                <ul class="dropdown-menu" data-bs-popper="none">
                                    <li> <a class="dropdown-item" href="{{ route('second', ['hero', 'inline-form']) }}">Hero Inline Form</a>
                                    </li>
                                    <li> <a class="dropdown-item" href="{{ route('second', ['hero', 'multiple-search']) }}">Hero Multiple
                                            Search</a></li>
                                    <li> <a class="dropdown-item" href="{{ route('second', ['hero' , 'image-gallery']) }}">Hero Image
                                            Gallery</a></li>
                                    <li> <a class="dropdown-item" href="{{ route('second', ['hero', 'split']) }}">Hero Split</a></li>
                                </ul>
                            </li>

                            <li> <a class="dropdown-item"
                                    href="{{ route('second', ['listing', 'booking-confirm']) }}">Booking
                                    Confirmed</a></li>
                            <li> <a class="dropdown-item"
                                    href="{{ route('second', ['listing', 'compare-listing']) }}">Compare Listing</a>
                            </li>
                            <li> <a class="dropdown-item"
                                    href="{{ route('second', ['listing', 'offer-detail']) }}">Offer Detail</a></li>
                        </ul>
                    </li>

                    <!-- Nav item Pages -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="pagesMenu" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Pages</a>
                        <ul class="dropdown-menu" aria-labelledby="pagesMenu">

                            <li> <a class="dropdown-item" href="{{ route('second', ['pages', 'about']) }}">About</a>
                            </li>
                            <li> <a class="dropdown-item"
                                    href="{{ route('second', ['pages', 'contact']) }}">Contact</a></li>
                            <li> <a class="dropdown-item"
                                    href="{{ route('second', ['pages', 'contact-2']) }}">Contact 2</a></li>
                            <li> <a class="dropdown-item" href="{{ route('second', ['pages', 'team']) }}">Our
                                    Team</a></li>

                            <!-- Dropdown submenu -->
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item dropdown-toggle" href="#">Authentication</a>
                                <ul class="dropdown-menu" data-bs-popper="none">
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['auth', 'sign-in']) }}">Sign In</a></li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['auth', 'sign-up']) }}">Sign Up</a></li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['auth', 'forgot-password']) }}">Forgot
                                            Password</a></li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['auth', 'two-factor-auth']) }}">Two factor
                                            authentication</a></li>
                                </ul>
                            </li>

                            <!-- Dropdown submenu -->
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item dropdown-toggle" href="#">Blog</a>
                                <ul class="dropdown-menu" data-bs-popper="none">
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['blog', 'blog']) }}">Blog</a></li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['blog', 'detail']) }}">Blog Detail</a></li>
                                </ul>
                            </li>

                            <!-- Dropdown submenu -->
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item dropdown-toggle" href="#">Help</a>
                                <ul class="dropdown-menu" data-bs-popper="none">
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['help', 'center']) }}">Help Center</a></li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['help', 'detail']) }}">Help Detail</a></li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['help', 'privacy-policy']) }}">Privacy
                                            Policy</a></li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['help', 'terms-of-service']) }}">Terms of
                                            Service</a></li>
                                </ul>
                            </li>

                            <li> <a class="dropdown-item"
                                    href="{{ route('second', ['pages', 'pricing']) }}">Pricing</a></li>
                            <li> <a class="dropdown-item" href="{{ route('second', ['pages', 'faq']) }}">FAQs</a>
                            </li>
                            <li> <a class="dropdown-item" href="{{ route('second', ['pages', 'error']) }}">Error
                                    404</a></li>
                            <li> <a class="dropdown-item"
                                    href="{{ route('second', ['pages', 'coming-soon']) }}">Coming Soon</a></li>
                        </ul>
                    </li>

                    <!-- Nav item Account -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="accounntMenu"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Accounts</a>
                        <ul class="dropdown-menu" aria-labelledby="accounntMenu">
                            <!-- Dropdown submenu -->
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item dropdown-toggle" href="#">User Profile</a>
                                <ul class="dropdown-menu" data-bs-popper="none">
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['account', 'profile']) }}">My Profile</a> </li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['account', 'bookings']) }}">My Bookings</a>
                                    </li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['account', 'travelers']) }}">Travelers</a>
                                    </li>
                                    <li> <a class="dropdown-item" href="account-payment-details.html">Payment
                                            Details</a> </li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['account', 'wishlist']) }}">Wishlist</a> </li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['account', 'settings']) }}">Settings</a> </li>
                                    <li> <a class="dropdown-item" href="account-delete.html">Delete Profile</a> </li>
                                </ul>
                            </li>

                            <!-- Dropdown submenu -->
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item dropdown-toggle" href="#">Agent Dashboard</a>
                                <ul class="dropdown-menu" data-bs-popper="none">
                                    <li> <a class="dropdown-item" href="{{ route('second', ['agent' , 'dashboard']) }}">Dashboard</a> </li>
                                    <li> <a class="dropdown-item" href="{{ route('second', ['agent' , 'listings']) }}">Listings</a> </li>
                                    <li> <a class="dropdown-item" href="{{ route('second', ['agent' , 'bookings']) }}">Bookings</a> </li>
                                    <li> <a class="dropdown-item"
                                            href="{{ route('second', ['agent', 'activities']) }}">Activities</a>
                                    </li>
                                    <li> <a class="dropdown-item" href="{{ route('second', ['agent' , 'earnings']) }}">Earnings</a> </li>
                                    <li> <a class="dropdown-item" href="{{ route('second', ['agent' , 'reviews']) }}">Reviews</a> </li>
                                    <li> <a class="dropdown-item" href="{{ route('second', ['agent' , 'settings']) }}">Settings</a> </li>
                                </ul>
                            </li>

                            <li> <a class="dropdown-item"
                                    href="{{ route('second', ['admin', 'dashboard']) }}">Master Admin</a> </li>
                        </ul>
                    </li>

                    <!-- Nav item Contact -->
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('second', ['pages', 'contact']) }}">Contact Us</a> </li>
                </ul>
            </div>
            <!-- Main navbar END -->

            <!-- Profile and Notification START -->
            <ul class="nav flex-row align-items-center list-unstyled ms-xl-auto">

                <!-- Notification dropdown START -->
                <li class="nav-item ms-0 ms-md-3 dropdown">
                    <!-- Notification button -->
                    <a class="nav-link p-0" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false" data-bs-auto-close="outside">
                        <i class="bi bi-bell fa-fw fs-5"></i>
                    </a>
                    <!-- Notification dote -->
                    <span class="notif-badge animation-blink"></span>

                    <!-- Notification dropdown menu START -->
                    <div
                        class="dropdown-menu dropdown-animation dropdown-menu-end dropdown-menu-size-md p-0 shadow-lg">
                        <div class="card bg-transparent">
                            <!-- Card header -->
                            <div
                                class="card-header bg-transparent d-flex justify-content-between align-items-center border-bottom">
                                <h6 class="m-0">Notifications <span
                                        class="badge bg-danger bg-opacity-10 text-danger ms-2">4 new</span></h6>
                                <a class="small" href="#">Clear all</a>
                            </div>

                            <!-- Card body START -->
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush list-unstyled p-2">
                                    <!-- Notification item -->
                                    <li>
                                        <a href="#"
                                            class="list-group-item list-group-item-action rounded notif-unread border-0 mb-1 p-3">
                                            <h6 class="mb-2">New! Booking flights from New York ✈️</h6>
                                            <p class="mb-0 small">Find the flexible ticket on flights around the world.
                                                Start searching today</p>
                                            <span>Wednesday</span>
                                        </a>
                                    </li>
                                    <!-- Notification item -->
                                    <li>
                                        <a href="#"
                                            class="list-group-item list-group-item-action rounded border-0 mb-1 p-3">
                                            <h6 class="mb-2">Sunshine saving are here 🌞 save 30% or more on a stay
                                            </h6>
                                            <span>15 Nov 2022</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Card body END -->

                            <!-- Card footer -->
                            <div class="card-footer bg-transparent text-center border-top">
                                <a href="#" class="btn btn-sm btn-link mb-0 p-0">See all incoming activity</a>
                            </div>
                        </div>
                    </div>
                    <!-- Notification dropdown menu END -->
                </li>
                <!-- Notification dropdown END -->

                <!-- Profile dropdown START -->
                <li class="nav-item ms-3 dropdown">
                    <!-- Avatar -->
                    <a class="avatar avatar-xs p-0" href="#" id="profileDropdown" role="button"
                        data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img class="avatar-img rounded-circle" src="/images/avatar/01.jpg" alt="avatar">
                    </a>

                    <!-- Profile dropdown START -->
                    <ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3"
                        aria-labelledby="profileDropdown">
                        <!-- Profile info -->
                        <li class="px-3 mb-3">
                            <div class="d-flex align-items-center">
                                <!-- Avatar -->
                                <div class="avatar me-3">
                                    <img class="avatar-img rounded-circle shadow" src="/images/avatar/01.jpg"
                                        alt="avatar">
                                </div>
                                <div>
                                    <a class="h6 mt-2 mt-sm-0" href="#">Lori Ferguson</a>
                                    <p class="small m-0">example@gmail.com</p>
                                </div>
                            </div>
                        </li>

                        <!-- Links -->
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-bookmark-check fa-fw me-2"></i>My
                                Bookings</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-heart fa-fw me-2"></i>My
                                Wishlist</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear fa-fw me-2"></i>Settings</a>
                        </li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-info-circle fa-fw me-2"></i>Help
                                Center</a></li>
                        <li><a class="dropdown-item bg-danger-soft-hover" href="#"><i
                                    class="bi bi-power fa-fw me-2"></i>Sign Out</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <!-- Dark mode options START -->
                        <li>
                            <div
                                class="nav-pills-primary-soft theme-icon-active d-flex justify-content-between align-items-center p-2 pb-0">
                                <span>Mode:</span>
                                <button type="button" class="btn btn-link nav-link text-primary-hover mb-0 p-0"
                                    data-bs-theme-value="light" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="Light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-sun fa-fw mode-switch" viewBox="0 0 16 16">
                                        <path
                                            d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
                                        <use href="#"></use>
                                    </svg>
                                </button>
                                <button type="button" class="btn btn-link nav-link text-primary-hover mb-0 p-0"
                                    data-bs-theme-value="dark" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="Dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-moon-stars fa-fw mode-switch"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278zM4.858 1.311A7.269 7.269 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.316 7.316 0 0 0 5.205-2.162c-.337.042-.68.063-1.029.063-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286z" />
                                        <path
                                            d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
                                        <use href="#"></use>
                                    </svg>
                                </button>
                                <button type="button"
                                    class="btn btn-link nav-link text-primary-hover mb-0 p-0 active"
                                    data-bs-theme-value="auto" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="Auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-circle-half fa-fw mode-switch"
                                        viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
                                        <use href="#"></use>
                                    </svg>
                                </button>
                            </div>
                        </li>
                        <!-- Dark mode options END-->
                    </ul>
                    <!-- Profile dropdown END -->
                </li>
                <!-- Profile dropdown END -->

                <!-- Button -->
                <li class="nav-item ms-3 d-none d-sm-block">
                    <a class="btn btn-sm btn-primary-soft mb-0" href="#"><i class="bi bi-lightning-charge"></i>
                        Upgrade now</a>
                </li>
            </ul>
            <!-- Profile and Notification START -->

        </div>
    </nav>
    <!-- Logo Nav END -->
</header>
<!-- Header END -->
@endsection

@section('content')
<!-- **************** MAIN CONTENT START **************** -->
<main>

    <!-- =======================
    Menu item START -->
    <section class="pt-4">
        <div class="container">
            <div class="card rounded-3 border p-3 pb-2">
                <!-- Avatar and info START -->
                <div class="d-sm-flex align-items-center">
                    <div class="avatar avatar-xl mb-2 mb-sm-0">
                        <img class="avatar-img rounded-circle" src="/images/avatar/01.jpg" alt="">
                    </div>
                    <h4 class="mb-2 mb-sm-0 ms-sm-3"><span class="fw-light">Hi</span> Jacqueline Miller</h4>
                    <a href="{{ route('second', ['listing', 'add-listing']) }}"
                        class="btn btn-sm btn-primary-soft mb-0 ms-auto flex-shrink-0"><i
                            class="bi bi-plus-lg fa-fw me-2"></i>Add New Listing</a>
                </div>
                <!-- Avatar and info START -->

                <!-- Responsive navbar toggler -->
                <button class="btn btn-primary w-100 d-block d-xl-none mt-2" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#dashboardMenu" aria-controls="dashboardMenu">
                    <i class="bi bi-list"></i> Dashboard Menu
                </button>

                <!-- Nav links START -->
                <div class="offcanvas-xl offcanvas-end mt-xl-3" tabindex="-1" id="dashboardMenu">
                    <div class="offcanvas-header border-bottom p-3">
                        <h5 class="offcanvas-title">Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            data-bs-target="#dashboardMenu" aria-label="Close"></button>
                    </div>
                    <!-- Offcanvas body -->
                    <div class="offcanvas-body p-3 p-xl-0">
                        <!-- Nav item -->
                        @include('layouts.partials.agent-nav')

                    </div>
                </div>
                <!-- Nav links END -->
            </div>
        </div>
    </section>
    <!-- =======================
    Menu item END -->

    <!-- =======================
    Content START -->
    <section class="pt-0">
        <div class="container vstack gap-4">
            <!-- Title START -->
            <div class="row">
                <div class="col-12">
                    <h1 class="fs-4 mb-0"><i class="bi bi-bookmark-heart fa-fw me-1"></i>Bookings</h1>
                </div>
            </div>
            <!-- Title END -->

            <!-- Booking table START -->
            <div class="row">
                <div class="col-12">
                    <div class="card border">
                        <!-- Card header START -->
                        <div class="card-header border-bottom">
                            <h5 class="card-header-title">Bookings<span
                                    class="badge bg-primary bg-opacity-10 text-primary ms-2">20 Rooms</span></h5>
                        </div>
                        <!-- Card header END -->

                        <!-- Card body START -->
                        <div class="card-body">
                            <!-- Search and select START -->
                            <div class="row g-3 align-items-center justify-content-between mb-3">
                                <!-- Search -->
                                <div class="col-md-8">
                                    <form class="rounded position-relative">
                                        <input class="form-control pe-5" type="search" placeholder="Search"
                                            aria-label="Search">
                                        <button
                                            class="btn border-0 px-3 py-0 position-absolute top-50 end-0 translate-middle-y"
                                            type="submit"><i class="fas fa-search fs-6"></i></button>
                                    </form>
                                </div>

                                <!-- Select option -->
                                <div class="col-md-3">
                                    <!-- Short by filter -->
                                    <form>
                                        <select class="form-select js-choice" aria-label=".form-select-sm">
                                            <option value="" selected>Sort by</option>
                                            <option>Free</option>
                                            <option>Newest</option>
                                            <option>Oldest</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                            <!-- Search and select END -->

                            <!-- Hotel room list START -->
                            <div class="table-responsive border-0">
                                <table class="table align-middle p-4 mb-0 table-hover table-shrink">
                                    <!-- Table head -->
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="border-0 rounded-start">#</th>
                                            <th scope="col" class="border-0">Name</th>
                                            <th scope="col" class="border-0">Type</th>
                                            <th scope="col" class="border-0">Date</th>
                                            <th scope="col" class="border-0">Status</th>
                                            <th scope="col" class="border-0">Payment</th>
                                            <th scope="col" class="border-0 rounded-end">Action</th>
                                        </tr>
                                    </thead>

                                    <!-- Table body START -->
                                    <tbody class="border-top-0">
                                        <!-- Table item -->
                                        <tr>
                                            <td>
                                                <h6 class="mb-0">01</h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0"><a href="#">Deluxe Pool View</a></h6>
                                            </td>
                                            <td> With Breakfast </td>
                                            <td>
                                                <h6 class="mb-0 fw-light">Nov 22 - 25</h6>
                                            </td>
                                            <td>
                                                <div class="badge text-bg-success">Booked</div>
                                            </td>
                                            <td>
                                                <div class="badge bg-success bg-opacity-10 text-success">Full payment
                                                </div>
                                            </td>
                                            <td> <a href="#" class="btn btn-sm btn-light mb-0">View</a> </td>
                                        </tr>

                                        <!-- Table item -->
                                        <tr>
                                            <td>
                                                <h6 class="mb-0">02</h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0"><a href="#">Deluxe Pool View with
                                                        Breakfast</a></h6>
                                            </td>
                                            <td> Free Cancellation | Breakfast only </td>
                                            <td>
                                                <h6 class="mb-0 fw-light">Nov 24 - 28</h6>
                                            </td>
                                            <td>
                                                <div class="badge text-bg-success">Booked</div>
                                            </td>
                                            <td>
                                                <div class="badge bg-orange bg-opacity-10 text-orange">On Property
                                                </div>
                                            </td>
                                            <td> <a href="#" class="btn btn-sm btn-light mb-0">View</a> </td>
                                        </tr>

                                        <!-- Table item -->
                                        <tr>
                                            <td>
                                                <h6 class="mb-0">03</h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0"><a href="#">Luxury Room with Balcony</a></h6>
                                            </td>
                                            <td> Free Cancellation | Breakfast + Lunch/Dinner </td>
                                            <td>
                                                <h6 class="mb-0 fw-light">Nov 24 - 28</h6>
                                            </td>
                                            <td>
                                                <div class="badge text-bg-info">Reserved</div>
                                            </td>
                                            <td>
                                                <div class="badge bg-info bg-opacity-10 text-info">Half Payment</div>
                                            </td>
                                            <td> <a href="#" class="btn btn-sm btn-light mb-0">View</a> </td>
                                        </tr>

                                        <!-- Table item -->
                                        <tr>
                                            <td>
                                                <h6 class="mb-0">04</h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0"><a href="#">Deluxe Room Twin Bed With
                                                        Balcony</a></h6>
                                            </td>
                                            <td> Free Cancellation </td>
                                            <td>
                                                <h6 class="mb-0 fw-light">Nov 28 - 30</h6>
                                            </td>
                                            <td>
                                                <div class="badge text-bg-success">Booked</div>
                                            </td>
                                            <td>
                                                <div class="badge bg-success bg-opacity-10 text-success">Full Payment
                                                </div>
                                            </td>
                                            <td> <a href="#" class="btn btn-sm btn-light mb-0">View</a> </td>
                                        </tr>

                                        <!-- Table item -->
                                        <tr>
                                            <td>
                                                <h6 class="mb-0">05</h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0"><a href="#">Deluxe Room Twin Bed With
                                                        Balcony</a></h6>
                                            </td>
                                            <td> Free Cancellation | Breakfast only </td>
                                            <td> - </td>
                                            <td>
                                                <div class="badge text-bg-warning">Available</div>
                                            </td>
                                            <td> - </td>
                                            <td> <a href="#" class="btn btn-sm btn-light mb-0">View</a> </td>
                                        </tr>

                                        <!-- Table item -->
                                        <tr>
                                            <td>
                                                <h6 class="mb-0">06</h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0"><a href="#">Premium Room With Balcony</a>
                                                </h6>
                                            </td>
                                            <td> Free Cancellation | Breakfast only </td>
                                            <td>
                                                <h6 class="mb-0 fw-light">Nov 14 - 18</h6>
                                            </td>
                                            <td>
                                                <div class="badge text-bg-danger">Cancel</div>
                                            </td>
                                            <td> - </td>
                                            <td> <a href="#" class="btn btn-sm btn-light mb-0">View</a> </td>
                                        </tr>

                                        <!-- Table item -->
                                        <tr>
                                            <td>
                                                <h6 class="mb-0">07</h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0"><a href="#">Deluxe Room King Bed with
                                                        Balcony</a></h6>
                                            </td>
                                            <td> Free Cancellation </td>
                                            <td>
                                                <h6 class="mb-0 fw-light">Nov 28 - 30</h6>
                                            </td>
                                            <td>
                                                <div class="badge text-bg-info">Reserved</div>
                                            </td>
                                            <td>
                                                <div class="badge bg-success bg-opacity-10 text-success">Full Payment
                                                </div>
                                            </td>
                                            <td> <a href="#" class="btn btn-sm btn-light mb-0">View</a> </td>
                                        </tr>

                                        <!-- Table item -->
                                        <tr>
                                            <td>
                                                <h6 class="mb-0">08</h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0"><a href="#">Superior Room</a></h6>
                                            </td>
                                            <td> With Breakfast </td>
                                            <td>
                                                <h6 class="mb-0 fw-light">Nov 22 - 25</h6>
                                            </td>
                                            <td>
                                                <div class="badge text-bg-success">Booked</div>
                                            </td>
                                            <td>
                                                <div class="badge bg-success bg-opacity-10 text-success">Full payment
                                                </div>
                                            </td>
                                            <td> <a href="#" class="btn btn-sm btn-light mb-0">View</a> </td>
                                        </tr>

                                        <!-- Table item -->
                                        <tr>
                                            <td>
                                                <h6 class="mb-0">09</h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0"><a href="#">Studio Suite King</a></h6>
                                            </td>
                                            <td> Free Cancellation | Breakfast only </td>
                                            <td>
                                                <h6 class="mb-0 fw-light">Nov 21 - 24</h6>
                                            </td>
                                            <td>
                                                <div class="badge text-bg-info">Reserved</div>
                                            </td>
                                            <td>
                                                <div class="badge bg-info bg-opacity-10 text-info">Half payment</div>
                                            </td>
                                            <td> <a href="#" class="btn btn-sm btn-light mb-0">View</a> </td>
                                        </tr>

                                        <!-- Table item -->
                                        <tr>
                                            <td>
                                                <h6 class="mb-0">10</h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0"><a href="#">Rock Family Suite</a></h6>
                                            </td>
                                            <td> Free Cancellation | Breakfast + Lunch/Dinner </td>
                                            <td>
                                                <h6 class="mb-0 fw-light">Dec 02 - 06</h6>
                                            </td>
                                            <td>
                                                <div class="badge text-bg-success">Booked</div>
                                            </td>
                                            <td>
                                                <div class="badge bg-success bg-opacity-10 text-success">Full payment
                                                </div>
                                            </td>
                                            <td> <a href="#" class="btn btn-sm btn-light mb-0">View</a> </td>
                                        </tr>
                                    </tbody>
                                    <!-- Table body END -->
                                </table>
                            </div>
                            <!-- Hotel room list END -->
                        </div>
                        <!-- Card body END -->

                        <!-- Card footer START -->
                        <div class="card-footer pt-0">
                            <!-- Pagination and content -->
                            <div class="d-sm-flex justify-content-sm-between align-items-sm-center">
                                <!-- Content -->
                                <p class="mb-sm-0 text-center text-sm-start">Showing 1 to 8 of 20 entries</p>
                                <!-- Pagination -->
                                <nav class="mb-sm-0 d-flex justify-content-center" aria-label="navigation">
                                    <ul class="pagination pagination-sm pagination-primary-soft mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1">Prev</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item disabled"><a class="page-link" href="#">..</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">15</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!-- Card footer END -->
                    </div>
                </div>
            </div>
            <!-- Booking table END -->
        </div>
    </section>
    <!-- =======================
    Content END -->

</main>
<!-- **************** MAIN CONTENT END **************** -->

@include('layouts.partials/footer')

<!-- Back to top -->
<div class="back-top"></div>
@endsection