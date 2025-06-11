<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ninja Network</title>
    
    @vite(['resources/css/design.css', 'resources/js/app.js'])

</head>

<body>
    <nav class="navbar navbar-expand-lg glass-navbar shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">ResumeHub</a>
            <div class="d-flex align-items-center">
               

                @if (Auth::guard('admin')->check())
                    <a class="btn btn-outline-warning me-3" href="{{ route('show.admindashboard') }}">Admin Dashboard</a>
                    <span class="user-greeting me-3">Hi, {{ Auth::guard('admin')->user()->name }}</span>
                    <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-danger">Logout</button>
                    </form>

                @elseif (Auth::check())
                    <a class="btn btn-outline-success me-3" href="{{ route('user.dashboard') }}">Dashboard</a>
                    <span class="user-greeting me-3">Hi, {{ Auth::user()->name }}</span>
                    <form action="{{ route('user.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-danger">Logout</button>
                    </form>

                @else
                    <a class="btn btn-outline-primary me-2" href="{{ route('show.login') }}">Login</a>
                    <a class="btn btn-primary" href="{{ route('register') }}">Register</a>
                @endif


    

            {{ $slot }}


    @if(session('success'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055;">
        <div id="liveToast" class="toast show align-items-center text-bg-success border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="4000">
            <div class="d-flex align-items-center p-3">
                <span class="fs-3 me-3"></span>
                <div class="toast-body fw-semibold fs-6">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white ms-3 me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055;">
        <div id="errorToast" class="toast show align-items-center border-0 shadow-lg" style="background: linear-gradient(135deg, var(--error), #dc2626); color: white;" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="4000">
            <div class="d-flex align-items-center p-3">
                <span class="fs-3 me-3">❌</span>
                <div class="toast-body fw-semibold fs-6">
                    {{ session('error') }}
                </div>
                <button type="button" class="btn-close btn-close-white ms-3 me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>