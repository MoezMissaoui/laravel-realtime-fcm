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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">





</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('fire-notification') }}">{{ __('Fire notification') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('show-notifications') }}">{{ __('Show notifications') }}</a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Import Axios Package -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <!-- Import jQuery Package -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Import the functions you need from the SDKs you need -->
    <script src="https://www.gstatic.com/firebasejs/7.9.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.9.1/firebase-messaging.js"></script>
    <script>
        // Your web app's Firebase configuration
        const firebaseConfig = {
          apiKey: "AIzaSyCxVN2gj-K4XFYrcP65V4O74HW9UcRzFSE",
          authDomain: "laravel-realtime-fcm.firebaseapp.com",
          projectId: "laravel-realtime-fcm",
          storageBucket: "laravel-realtime-fcm.appspot.com",
          messagingSenderId: "265349239131",
          appId: "1:265349239131:web:d993260ac566a31bef8a7e"
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);

            // Initialize Firebase Cloud Messaging and get a reference to the service
            const messaging = firebase.messaging();
            messaging.usePublicVapidKey('BNQPQsfA6L1PTdtRrn1djQAQXM90ivedxBXjHv-uJNKKllJasSJWL3UK_9W6mtLFF2cHGBbByxKH31cqNrP8Fs0');
            function store_fcmtoken(token) {
                return axios.post("{{  route('store-fcmtoken') }}", {
                    token
                }).then(res => {
                    return res.data.data.notif;
                })
            }
            function retreiveToken() {
                // Get registration token. Initially this makes a network call, once retrieved
                // subsequent calls to getToken will return from cache.
                messaging.getToken().then((currentToken) => {
                    if (currentToken) {
                        // Send the token to your server and update the UI if necessary
                        store_fcmtoken(currentToken)
                    } else {
                        alert('You should allow notifications!');
                    }
                }).catch((err) => {
                    console.log('An error occurred while retrieving token. ', err);
                    // ...
                });
            }
            messaging.onTokenRefresh(() => {
                retreiveToken();
            });
            retreiveToken();

    </script>
    @yield('script')
</body>
</html>
