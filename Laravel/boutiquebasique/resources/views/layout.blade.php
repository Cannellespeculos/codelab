<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <title>BoutiqueBasique</title>

    <style>


        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @yield('css')

        header {
            padding: 5rem;
            background-color: #0f6674;
            display: flex;
            align-items: center;
            justify-content: space-around;

        }

        main {
            width: 100%;
        }

        section {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10rem;
            padding: 5rem;
        }

        header a {
            color: white;
            text-decoration: none;
            font-size: 1.5em;
            }

        article {
            width: 27rem;
            height: 19rem;
            padding: 6rem 5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 1px solid #4b5563;
        }

        .show {
            display: flex;
            width: 100%;
            align-items: center;
            justify-content: center;
        }

        .card {
            text-align: center;
            border: 1px solid #6b7280;
            padding: 10rem;
        }

        img {
            width: 8rem;
            margin: 1rem;
        }

        .show img {
            width: 10rem;
        }

        a {
            text-decoration: none;
            color: black;
        }

        .author > a {
            width: 100%;
            height: 100%;
        }

        article:hover {
            background-color: rgba(158, 162, 177, 0.49);
        }

        footer {
            display: flex;
            justify-content: center;
        }

        ul {
            display: flex;
            align-items: center;
            gap: 10rem;
        }

        li {
            list-style: none;
            font-size: 2em;
        }
    </style>
</head>
<body class="antialiased">
    <header>
        <h1>BoutiqueBASIQUE</h1>

        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                @auth
                    <a href="{{ url('/') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                    <a href="{{ route('basket.show', $user->id) }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Basket</a>

                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif

    </header>

    @yield("main")

    @yield("js")
</body>
</html>
