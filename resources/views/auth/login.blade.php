<!DOCTYPE html>
<html lang="en">
<head>
  <title>Educating Excellent Management System</title>
  @include('admin.includes.styles')
  <style>
    body {
        background-color: #182E43 !important;
        /* font-family: Montserrat; */
        color: white;
    }
    .card-body {
        background-color: #182E43 !important;
    }
    .label-color {
        color: #C0CD42;
    }
   </style>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="{{ route('login') }}"> <img src="{{ asset('assets/admin/img/logo.png') }}" style="width: 70px" alt="logo"> </a>
        <h3>{{ env('APP_NAME') }}</h3>
        <p style="font-size: 15px">Education Consultancy Service</p>
      </div>
      <!-- /.login-logo -->
      <div class="">
        <div class="card-body login-card-body">
          <p class="login-box-msg label-color" style="font-size: 22px">EEMS Login</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

          <form method="post" action="{{ route('login') }}">
            @csrf
            <div class="input-group mb-3">
              <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" name="password" class="form-control" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember">
                  <label for="remember" class="label-color">
                    Remember Me
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <!-- /.social-auth-links -->

          <p class="mb-1">
            <a href="{{ route('password.request') }}" style="color: white">I forgot my password</a>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>

    @include('admin.includes.scripts')
</body>
</html>
