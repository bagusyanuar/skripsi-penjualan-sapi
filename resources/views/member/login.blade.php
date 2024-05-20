<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"
          rel="stylesheet"/>
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet"/>
    <title>Form Login Admin | Heli Farm</title>
    <title>Document</title>
</head>
<body>
<div class="login-container">
    <div class="card-login-form">
        <div class="image-login-container">
            <img src="{{ asset('/assets/image/login-image.jpg') }}" alt="login-image" />
        </div>
        <div class="form-login-container">
            <img src="{{ asset('/assets/image/logo.png') }}" alt="brand-image">
            <p class="form-title">Masukan Email dan Password</p>
            <label for="email" class="form-label d-none"></label>
            <div class="text-group-container mb-2">
                <i class='bx bx-envelope'></i>
                <input type="text" placeholder="email" class="text-group-input" id="email"
                       name="email" aria-describedby="emailHelp">
            </div>
            <label for="password" class="form-label d-none"></label>
            <div class="text-group-container mb-3">
                <i class='bx bx-lock-alt'></i>
                <input type="password" placeholder="password" class="text-group-input"
                       id="password" name="password" aria-describedby="emailHelp">
            </div>
            <div class="d-flex justify-content-between align-items-center w-100">
                <a href="#" class="register-link">Belum punya akun?</a>
                <button type="submit" class="btn-login">Login</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
</body>
</html>
