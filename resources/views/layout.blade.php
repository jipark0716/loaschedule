<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title')</title>
        <link href="assets/img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:400,500" rel="stylesheet" />
        <link href="{{ asset('lib/css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
        <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-messaging.js"></script>
    </head>
    <body class="nav-fixed bg-light">
        <nav class="top-app-bar navbar navbar-expand navbar-dark bg-dark">
            <div class="container-fluid px-4">
                <button class="btn btn-lg btn-icon order-1 order-lg-0" id="drawerToggle" href="javascript:void(0);"><i class="material-icons">menu</i></button>
                <a class="navbar-brand me-auto" href="index.html"><div class="text-uppercase font-monospace">{{ config('app.name') }}</div></a>
            </div>
        </nav>
        <div id="layoutDrawer">
            <div id="layoutDrawer_nav">
                <nav class="drawer accordion drawer-light bg-white" id="drawerAccordion">
                    <div class="drawer-menu">
                        <div class="nav">
                            <a class="nav-link collapsed" href="/">
                                <div class="nav-link-icon"><i class="material-icons">dashboard</i></div>
                                DASHBOARD
                            </a>
                            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
                                <div class="nav-link-icon"><i class="material-icons">person</i></div>
                                숙제
                                <div class="drawer-collapse-arrow"><i class="material-icons">expand_more</i></div>
                            </a>
                            <div class="active collapse show" id="collapseDashboards" aria-labelledby="headingOne" data-bs-parent="#drawerAccordion">
                                <nav class="drawer-menu-nested nav">
                                    @foreach (App\Models\Account::all() as $account)
                                        <a class="nav-link" href="{{ route('account', $account) }}">{{ $account->nick_name }}</a>
                                    @endforeach
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="{{ route('master.cosplay') }}">
                                <div class="nav-link-icon"><i class="material-icons">thumb_down_off_alt</i></div>
                                숙코노트
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutDrawer_content">
                <div class="container-xl">
                    @yield('content')
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script type="module" src="{{ asset('lib/js/material.js') }}"></script>
        <script src="{{ asset('lib/js/scripts.js') }}"></script>
        <script src="{{ asset('js/firebase-init.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('scripts')
    </body>
</html>
