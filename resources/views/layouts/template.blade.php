<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    {{-- <!--SCRIPTS DE CHART-->
    <script src="{{ asset('_gs_public/js/loader.js') }}" defer></script> --}}
    <script src="{{ asset('_gs_public/js/bootstrap.min.js') }}" defer></script>
    <!-- <script src="{{ asset('js/jquery.min.js') }}" defer></script>-->
    <!-- <script src="{{ asset('js/dropdown.js') }}"></script>-->

    <!-- Fonts -->
    {{-- <link href="{{asset('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css"> --}}
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!--Ultimo link adicionada-->
    <!--
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" />
-->
    <!--LINK DE BOOTRAPS 4 -->
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
    {{-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

</head>

<body>
    @notify_css
    <div id="app">
        <nav class="navbar navbar-expand-lg bg-light text-white shadow-sm">
            <div class="container d-flex justify-content-between">
                <div class="col-4">
                    <a class="navbar-brand" href="{{ route('admin-accueil') }}">
                        <img src="{{ asset('_gs_public/img/logo.gif') }} " height="50px" width="" />
                        <!-- {{ config('app.name', 'Laravel') }} -->
                    </a>
                </div>
                @auth
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link  @if(\Route::current()->getName() == 'admin-accueil') active  @endif" href="{{ route('admin-accueil') }} "><i
                                        class="fas fa-house-user"></i>Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  @if(\Route::current()->getName() == 'user-index') active  @endif" href="{{ route('user-index') }} "><i
                                        class="fas fa-users"></i> Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(\Route::current()->getName() == 'etudiant-index') active  @endif" href="{{ route('etudiant-index') }} "><i
                                        class="fas fa-users"></i> Etudiants</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(\Route::current()->getName() == 'classe-index') active  @endif" href="{{ route('classe-index') }} "><i class="fas fa-house-user"></i>
                                    Parcours </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link @if(\Route::current()->getName() == 'stage-index') active  @endif" href=" {{ route('stage-index') }} "><i class="fas fa-home"></i>
                                    Stages</a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link @if(\Route::current()->getName() == 'page-stage') active  @endif" href=" {{ route('page-stage') }} "><i class="fas fa-house-user"></i>
                                    Stages</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(\Route::current()->getName() == 'prof-index') active  @endif" href="{{ route('prof-index') }}"><i class="fas fa-house-user"></i>
                                    Enseignants</a>
                            </li>



                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                        <!--<i class="fas fa-user-slash"></i> {{ __('Quitter') }}-->
                                        <i class="fas fa-sign-out-alt"></i> {{ 'Deconnexion' }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>


                                </div>
                            </li>
                    </ul>
                </div>
                @endauth
                <style>
                    ul li {
                        margin-right: 25px;
                    }

                    .active {
                        background: #007396;
                        color: white;
                        border-radius: 10px;
                    }

                </style>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <hr class="container">
        <footer class="container">
            <div class="d-flex row  justify-content-between">
                <div class="col-lg-4">
                    <h2>Contacts</h2>
                    <ul type="none">
                        <li><i class="fas fa-map-marker-alt"></i> Lorem, ipsum dolor, Lorem, ipsum. </li>
                        <li><i class="fas fa-phone"></i> +33 434 2343 42332 </li>
                        <li><i class="fas fa-globe"></i> www.iaelyon.fr </li>
                        <li>
                            <span>Suivez-Nous : </span>
                            <a href="#" class="h4 mr-4"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="h4 mr-4"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="h4 mr-4"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="h4 mr-4"><i class="fab fa-youtube"></i></a>
                            <a href="#" class="h4 mr-4"><i class="fab fa-instagram"></i></a>

                        </li>
                        <li><a href="#">Nous Contacter</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis ad beatae ex! Illo doloribus
                    voluptate reprehenderit similique velit sed voluptas laboriosam iusto, dicta provident illum atque
                    possimus nemo, quidem voluptatibus?
                    <a href="#">Voir plus</a>
                </div>
            </div>
            <h6 class="text-center bg-primary text-white p-1 ">&copy; Iae-Lyon <?php echo date('Y'); ?> </h6>
        </footer>
    </div>
    @notify_js
    <!--Permet de definir les notification -->
    @notify_render
    <!--Permet de definir les notification -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
</body>

</html>
