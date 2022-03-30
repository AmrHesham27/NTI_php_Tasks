<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="login">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="register">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="home">Home</a>
            </li>
          </ul>
      </div>
    </div>
  </nav>
<body>
    <h1>Register</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action={{ url('/registerAction') }} method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value={{ csrf_token() }} >
        <label>Email</label>
        <input placeholder="enter your email" name="adminEmail" value={{ old('title') }}>
        <label>Password</label>
        <input placeholder="enter password" type="password" name="password" >
        <label>Confirm Password</label>
        <input placeholder="confrim password" type="password" name="password_confirmation" >
        <button>submit</button>
    </form>
</body>
</html>
