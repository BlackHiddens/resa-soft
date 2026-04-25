<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.partials/title-meta')

    @include('layouts.partials/head-css')

</head>

<body>
    <main>

        @include('layouts.partials.admin-sidebar')


        <!-- Page content START -->
        <div class="page-content">

            @include('layouts.partials.admin-topbar')

            <div class="page-content-wrapper p-xxl-4">
                @yield('content')
            </div>

        </div>

    </main>

    @include('layouts.partials/footer-scripts')

</body>

</html>