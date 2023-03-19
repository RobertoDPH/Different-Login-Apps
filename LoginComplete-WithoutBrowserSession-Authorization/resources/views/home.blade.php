<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ 'assets/css/bootstrap.css' }}">
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

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @can('isAdmin')
        <div class="btn btn-success btn-lg">
            You have Admin Access
        </div>
    @elsecan('isManager')
        <div class="btn btn-primary btn-lg">
            You have Manager Access
        </div>
    @elsecan('isUser')
        <div class="btn btn-info btn-lg">
            You have User Access
        </div>
    @else
        <div class="btn btn-danger btn-lg">
            You don't have Access
        </div>
    @endcan


</body>
</html>
