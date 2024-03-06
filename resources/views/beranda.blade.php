<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="bg-image d-flex justify-content-center align-items-center"
style=
"background-image: url('https://lh3.googleusercontent.com/fj5ayOwlK9cGJEav7KxQu_mj-cfwGmse3zD-KvUTtFQl6Cm4lW825IDNnROm_Nr9mp8930t03uWHVxjANP7maYu6L31v2YPhCg=w1200-h630-rj-pp');">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-black"><br><br><br></h2>
            <h4 class=" text-center text-xl leading-9 tracking-tight text-black"></h4>
        </div>
<br><br><br>
<form  class="text-center" action="{{ route('index_product') }}" method="get">
    @csrf
    <button type="submit" class="btn btn-outline-light"> View products </button>
    <br>
</form>
<br>
    <form  class="text-center" action="{{ route('login') }}" method="get">
        @csrf
    <button type="submit" class="btn btn-outline-light"> Sign In to shop </button>
    </form>
<br>
    <form  class="text-center" action="{{ route('register') }}" method="get">
        @csrf
    <button type="submit" class="btn btn-outline-light"> Sign Up to shop </button>
    
</form>

</body>

</html>