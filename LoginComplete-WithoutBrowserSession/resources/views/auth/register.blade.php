<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}">
</head>
<body>
    <form class="w-50 m-auto" action="/registro" method="post">
        @csrf
        <div class="form-group mb-3 ">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Nombre">
        </div>
        <div class="form-group mb-3 ">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" placeholder="Username">
        </div>
        <div class="form-group mb-3 ">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Email">
        </div>
        <div class="form-group mb-3 ">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Contraseña">
        </div>
        <div class="form-group mb-3 ">
            <label for="password_confirmation">Password Confirm</label>
            <input type="password" class="form-control" name="password_confirmation" placeholder="Enter again password">
        </div>
        <div class="form-group mb-2">
            <label for="remember">Remember me</label>
            <input type="checkbox" name="remember">
        </div>
        <input type="submit" value="Register">
    </form>
</body>
</html>