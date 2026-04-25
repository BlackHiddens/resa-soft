<!-- Sidebar START -->
<nav class="navbar sidebar navbar-expand-xl navbar-light">
	<!-- Navbar brand for xl START -->
	<div class="d-flex align-items-center">
		<a class="navbar-brand" href="{{ route('root' ) }}">
			<img class="light-mode-item navbar-brand-item" src="/images/logo.svg" alt="logo">
			<img class="dark-mode-item navbar-brand-item" src="/images/logo-light.svg" alt="logo">
		</a>
	</div>
	<!-- Navbar brand for xl END -->

	<div class="offcanvas offcanvas-start flex-row custom-scrollbar h-100" data-bs-backdrop="true" tabindex="-1" id="offcanvasSidebar">
		<div class="offcanvas-body sidebar-content d-flex flex-column pt-4">

			<!-- Sidebar menu START -->
			<ul class="navbar-nav flex-column" id="navbar-sidebar">
				<!-- Menu item -->
				<li class="nav-item"><a href="{{ route('second', ['admin' , 'dashboard']) }}" class="nav-link active">Dashboard</a></li>

				<!-- Title -->
				<li class="nav-item ms-2 my-2">Pages</li>

				<!-- Menu item -->
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="collapse" href="#collapsebooking" role="button" aria-expanded="false" aria-controls="collapsebooking">
						Bookings
					</a>
					<!-- Submenu -->
					<ul class="nav collapse flex-column" id="collapsebooking" data-bs-parent="#navbar-sidebar">
						<li class="nav-item"> <a class="nav-link" href="{{ route('second', ['admin' , 'booking-list']) }}">Booking List</a></li>
						<li class="nav-item"> <a class="nav-link" href="{{ route('second', ['admin' , 'booking-detail']) }}">Booking Detail</a></li>
					</ul>
				</li>

				<!-- Menu item -->
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="collapse" href="#collapseguest" role="button" aria-expanded="false" aria-controls="collapseguest">
						Guests
					</a>
					<!-- Submenu -->
					<ul class="nav collapse flex-column" id="collapseguest" data-bs-parent="#navbar-sidebar">
						<li class="nav-item"> <a class="nav-link" href="{{ route('second', ['admin' , 'guest-list']) }}">Guest List</a></li>
						<li class="nav-item"> <a class="nav-link" href="{{ route('second', ['admin' , 'guest-detail']) }}">Guest Detail</a></li>
					</ul>
				</li>

				<!-- Menu item -->
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="collapse" href="#collapseagent" role="button" aria-expanded="false" aria-controls="collapseagent">
						Agents
					</a>
					<!-- Submenu -->
					<ul class="nav collapse flex-column" id="collapseagent" data-bs-parent="#navbar-sidebar">
						<li class="nav-item"> <a class="nav-link" href="{{ route('second', ['admin' , 'agent-list']) }}">Agent List</a></li>
						<li class="nav-item"> <a class="nav-link" href="{{ route('second', ['admin' , 'agent-detail']) }}">Agent Detail</a></li>
					</ul>
				</li>

				<!-- Menu item -->
				<li class="nav-item"> <a class="nav-link" href="{{ route('second', ['admin' , 'reviews']) }}">Reviews</a></li>

				<!-- Menu item -->
				<li class="nav-item"> <a class="nav-link" href="{{ route('second', ['admin' , 'earnings']) }}">Earnings</a></li>

				<!-- Menu item -->
				<li class="nav-item"> <a class="nav-link" href="{{ route('second', ['admin' , 'settings']) }}">Admin Settings</a></li>

				<!-- Menu item -->
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="collapse" href="#collapseauthentication" role="button" aria-expanded="false" aria-controls="collapseauthentication">
						Authentication
					</a>
					<!-- Submenu -->
					<ul class="nav collapse flex-column" id="collapseauthentication" data-bs-parent="#navbar-sidebar">
						<li class="nav-item"> <a class="nav-link" href="{{ route('second', ['auth' , 'sign-up']) }}">Sign Up</a></li>
						<li class="nav-item"> <a class="nav-link" href="{{ route('second', ['auth' , 'sign-in']) }}">Sign In</a></li>
						<li class="nav-item"> <a class="nav-link" href="{{ route('second', ['auth' , 'forgot-password']) }}">Forgot Password</a></li>
						<li class="nav-item"> <a class="nav-link" href="{{ route('second', ['pages' , 'error']) }}">Error 404</a></li>
					</ul>
				</li>



			</ul>
			<!-- Sidebar menu end -->

			<!-- Sidebar footer START -->
			<div class="d-flex align-items-center justify-content-between text-primary-hover mt-auto p-3">
				<a class="h6 fw-light mb-0 text-body" href="{{ route('second', ['auth' , 'sign-in']) }}" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Sign out">
					<i class="fa-solid fa-arrow-right-from-bracket"></i> Log out
				</a>
				<a class="h6 mb-0 text-body" href="{{ route('second', ['admin' , 'settings']) }}" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Settings">
					<i class="bi bi-gear-fill"></i>
				</a>
			</div>
			<!-- Sidebar footer END -->

		</div>
	</div>
</nav>
<!-- Sidebar END -->