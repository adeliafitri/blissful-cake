<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.admin.header')
</head>
<body class="hold-transition login-page">
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card">
        <!-- <div class="card-header text-center">
          <a href="../index2.html" class="h1"><b>Admin</b>LTE</a>
        </div> -->
        <div class="card-body">
            <div class="text-center mb-1">
                <img src="{{ asset('dist/img/logo-login.png') }}" width="100px" alt="logo Prodi Arsitektur UIN Malang">
            </div>
            <h3 class="text-center">Blissful Admin</h3>
            <p class="login-box-msg">Enter your details to get sign in to your account</p>

            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
          <form action="{{ route('login') }}" method="post">
            @CSRF
            <div class="input-group mb-3">
              <input type="email" value="{{ old('email') }}" name="email" class="form-control" placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group">
              <input type="password" name="password" class="form-control" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <p class="text-end">
                <a href="forgot-password.html" class="text-dark">Forgot Password?</a>
            </p>
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </form>

          <p class="mb-0 mt-3 text-center">
            Don't have an account? <a href="{{ route('register') }}" class="text-dark fw-bold"><b>Sign up</b></a>
          </p>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.login-box -->

    @include('layouts.admin.script')
    </body>
</html>
