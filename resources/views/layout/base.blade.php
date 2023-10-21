<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="/26494.png">
    <link href="/dist/css/tabler.css" rel="stylesheet" />
    <link href="/dist/css/demo.min.css" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
    @livewireStyles
    @vite([])
</head>
<body>
    @php
        $ipComputer = request()->ip();
    @endphp
    <div class="page">
        <header class="navbar navbar-expand-md d-print-none">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href="." class=" text-decoration-none text-capitalize title">
                        <img src="/26494.png" width="110" height="32" alt="Tabler" class="navbar-brand-image">
                        RSU raffa majenang
                    </a>
                </h1>
                <div class="navbar-nav flex-row order-md-last">
                    <div class="d-none d-md-flex">
                        <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Aktifkan dark mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                            </svg>
                        </a>
                        <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Aktifkan light mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                            </svg>
                        </a>
                    </div>
                    <div class="d-flex gap-2">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                                <span class="bg-main avatar avatar-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ambulance" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M5 17h-2v-11a1 1 0 0 1 1 -1h9v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5"></path>
                                        <path d="M6 10h4m-2 -2v4"></path>
                                    </svg>
                                </span>
                                <div class="d-none d-xl-block ps-2 fw-semibold">
                                    <div class="mt-1 small text-muted text-uppercase" style="font-family: 'Overpass', sans-serif;">emergency</div>
                                    <div>087803752800</div>
                                </div>
                            </a>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                                <span class="bg-main avatar avatar-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone-calling" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
                                        <path d="M15 7l0 .01"></path>
                                        <path d="M18 7l0 .01"></path>
                                        <path d="M21 7l0 .01"></path>
                                    </svg>
                                </span>
                                <div class="d-none d-xl-block ps-2 fw-semibold">
                                    <div class="mt-1 small text-uppercase" style="font-family: 'Overpass', sans-serif;">informasi</div>
                                    <div>082131411881</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <header class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="navbar navbar-light">
                    <div class="container-xl">
                        <ul class="navbar-nav">
                            <li class="nav-item {{ request()->routeIs('list.doctor') ? 'active' : '' }}">
                                <a class="nav-link text-white" href="{{ route('list.doctor', ['rsuraffa' => 'sub-simgos']) }}">
                                    <span class="nav-link-title text-capitalize"> daftar dokter </span>
                                </a>
                            </li>
                            @if ($ipComputer == '192.168.2.4' || $ipComputer == '192.168.2.44')
                                <li class="nav-item {{ request()->routeIs('list.registration') ? 'active' : '' }}">
                                    <a class="nav-link text-white" href="{{ route('list.registration', ['rsuraffa' => 'sub-simgos']) }}">
                                        <span class="nav-link-title text-capitalize"> pendaftaran pasien </span>
                                    </a>
                                </li>
                                <li class="nav-item {{ request()->routeIs('visit.patient') ? 'active' : '' }}">
                                    <a class="nav-link text-white" href="{{ route('visit.patient', ['rsuraffa' => 'sub-simgos']) }}">
                                        <span class="nav-link-title text-capitalize"> kunjungan pasien </span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <div class="page-wrapper">
            @yield('content')
        </div>
    </div>
    @livewireScripts
    <script src="/dist/js/jquery-3.6.0.min.js"></script>
    <script src="/dist/js/jquery.blockUI.min.js"></script>
    <script src="/dist/js/tabler.min.js" defer></script>
    <script src="/dist/js/demo.min.js" defer></script>
    @stack('scripts')
</body>
</html>