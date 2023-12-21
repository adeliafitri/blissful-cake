<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.admin.header')
</head>
<body class="hold-transition register-page">
    <div class="register-box">
      <!-- <div class="register-logo">
        <a href="../../index2.html"><b>Admin</b>LTE</a>
      </div> -->

      <div class="card">
        <div class="card-body register-card-body">
            <div class="text-center mb-2">
                <img src="{{ asset('dist/img/logo-login.png') }}" width="100px" alt="logo arsitektur UIN Malang">
            </div>
          <p class="login-box-msg">Register a new membership</p>
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            {{-- @if ($errors->has('registration'))
                <div class="alert alert-danger">
                    {{ $errors->first('registration') }}
                </div>
            @endif --}}
          <form action="{{ route('register') }}" method="post">
            @CSRF
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="name" placeholder="Name">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="email" class="form-control" name="email" placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="username" placeholder="Username">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" name="password" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="form-group">
                {{-- <label for="role">Role</label> --}}
                <select id="role" name="role" class="form-control" disabled>
                    <option>Choose Role</option>
                    <option value="superadmin" selected>Superadmin</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="row">
              <div class="col-12 mb-2">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
      </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    @include('layouts.admin.script')
    </body>
</html>
