<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <link href="assets/img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:400,500" rel="stylesheet" />
        <link href="{{ asset('lib/css/styles.css') }}" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet" />
        <link href="https://naver.github.io/billboard.js/release/latest/dist/billboard.min.css" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-messaging.js"></script>
    </head>
    <body class="nav-fixed bg-light">
        <nav class="top-app-bar navbar navbar-expand navbar-dark bg-dark">
            <div class="container-fluid px-4">
                <button class="btn btn-lg btn-icon order-1 order-lg-0" id="drawerToggle" href="javascript:void(0);"><i class="material-icons">menu</i></button>
                <a class="navbar-brand me-auto" href="index.html"><div class="text-uppercase font-monospace">{{ config('app.name') }}</div></a>
            </div>
            <div class="d-flex align-items-center mx-3 me-lg-0 mr-2">
                <form class="m-5" action="{{ route('account.search') }}">
                    <input class="form-control" name="q" placeholder="닉네임">
                </form>
            </div>
        </nav>
        <div id="layoutDrawer">
            <div id="layoutDrawer_nav">
                <nav class="drawer accordion drawer-light bg-white" id="drawerAccordion">
                    <div class="drawer-menu">
                        <div class="nav">
                            <a class="nav-link collapsed" href="/">
                                <div class="nav-link-icon"><i class="material-icons">dashboard</i></div>
                                HOME
                            </a>
                            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
                                <div class="nav-link-icon"><i class="material-icons">person</i></div>
                                숙제
                                <div class="drawer-collapse-arrow"><i class="material-icons">expand_more</i></div>
                            </a>
                            <div class="active collapse show" id="collapseDashboards" aria-labelledby="headingOne" data-bs-parent="#drawerAccordion">
                                <nav class="drawer-menu-nested nav">
                                    @foreach (App\Models\Account::where('user_id', Auth::id())->get() as $account)
                                        <a class="nav-link" href="{{ route('account', $account) }}">{{ $account->nick_name }}</a>
                                    @endforeach
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="{{ route('library.home') }}">
                                <div class="nav-link-icon"><i class="material-icons">library_books</i></div>
                                도서관
                            </a>
                            @if (Auth::user()->guild_id)
                                <a class="nav-link collapsed" href="{{ route('party.home') }}">
                                    <div class="nav-link-icon"><i class="material-icons">group</i></div>
                                    길드팟
                                </a>
                            @endif
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
        <script type="text/javascript">
            let sslUse = @json(config('app.ssl'));
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/select-picker.js') }}"></script>
        <script type="module" src="{{ asset('lib/js/material.js') }}"></script>
        <script src="{{ asset('lib/js/scripts.js') }}"></script>
        <script src="{{ asset('js/firebase-init.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://d3js.org/d3.v6.min.js"></script>
        <script src="https://naver.github.io/billboard.js/release/latest/dist/billboard.min.js" charset="utf-8"></script>
        <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
        <script type="text/javascript">
            $(document).ajaxError(function myErrorHandler(event, xhr, ajaxOptions, thrownError) {
                toastr.error('뭔가잘못됨', '새로고침하세요')
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        @yield('scripts')
    </body>
</html>
