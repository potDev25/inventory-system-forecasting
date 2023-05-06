<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    .content-center{
        width: 80%;
        margin: auto;
    }
    </style>
</head>
<body class="p-5">
    <div class="content-center p-10 border-double border-4 border-sky-500 ...">
    <center><h1 class="text-xl font-bold">Tudlo.Awesome</h1></center>

    Dear <strong>{{$name}},</strong>
    <p class="mt-5">{!! $body !!}</p>

    <a href="http://127.0.0.1:8000/teacher/login" class="text-blue-500 underline">Login to your account to confirm the request!</a>
    </div>
</body>
</html>
