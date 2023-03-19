<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}">
    <script src="{{url('assets/js/bootstrap.min.js')}}"></script>
    <title>Document</title>
</head>
<body>

<ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>



@auth

    <h1>Registrado</h1>

@endauth

@guest

    <h1>No registrado</h1>

@endguest
</body>
</html>
