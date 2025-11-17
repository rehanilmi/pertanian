<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>

    <!-- CSS AdminLTE -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

</head>

<body class="hold-transition login-page">

<div class="login-box">
    <div class="card card-outline card-success">
        <div class="card-header text-center">
            <h3><b>LOGIN ADMIN</b></h3>
        </div>

        <div class="card-body">

            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ url('/login') }}" method="POST">
                @csrf

                <div class="input-group mb-3">
                    <input type="text" name="email" class="form-control"
                           placeholder="Email" required value="{{ old('email') }}">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control"
                           placeholder="Password" required>
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>

                <button class="btn btn-success btn-block">Login</button>
            </form>

        </div>
    </div>
</div>

<!-- JS -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

</body>
</html>
