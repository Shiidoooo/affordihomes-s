<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])

    <title>Admin</title>
</head>
<body class="bg-green-200 ">
    @include('common.header')
    @csrf

    <h1> ADMIN DASHBOARD </h1>



    @include('common.footer')
</body>
</html>