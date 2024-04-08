<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Oauth2 P2</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

    <script src="{{ asset('js/checkAccessToken.js') }}"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body>
    <p id="loading" class="flex justify-center items-center h-screen bg-blue-500 text-white transition-all">loading...</p>
    <div id="body" class="hidden">
        @yield('content')
    </div>
    <script>
        let body = document.getElementById('body');
        let loading = document.getElementById('loading');
        setTimeout(() => {
            body.classList.remove('hidden');
            loading.classList.add('hidden');

        }, 2000);
    </script>
</body>

</html>
