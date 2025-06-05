<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - GVN Fin Trade</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/home_v2.css') }}">
  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.6/css/flag-icon.min.css">
  <style>
    .bg-light-green {
      background: linear-gradient(to top right, #eafaf1, #e2f4e9);
    }
  </style>
</head>

<body>

  <div class="container-fluid">
    <div class="row min-vh-100">

      <!-- LEFT FORM -->
      <div class="col-lg-6 d-flex align-items-center justify-content-center p-4">
        <div class="w-100" style="max-width: 400px;">
          <h2 class="fw-bold text-dark mb-2">Login</h2>
          <p class="text-muted mb-4">Welcome back! Please enter your details.</p>

          <form action="{{route('login')}}" method="post">
            @csrf
            <div class="mb-3">
              <label class="form-label fw-semibold">Username/Email <span class="text-danger">*</span></label>
              <div class="input-group">
                <input name="email" type="text" class="form-control py-2 @error('email') is-invalid @enderror"
                  placeholder="{{__('panel.login_username')}}" value="{{ old('email') }}" required
                  autocomplete="email" autofocus>
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
              <div class="input-group">
                <input name="password" type="password" id="password"
                  class="form-control @error('password') is-invalid @enderror"
                  placeholder="{{__('panel.password')}}" required autocomplete="current-password">
                <span class="input-group-text" onclick="togglePassword()"><i class="bi bi-eye"></i></span>
                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="rememberMe">
                <label class="form-check-label" for="rememberMe">Remember me</label>
              </div>
              <a href="{{ route('password.request') }}" class="text-success text-decoration-none">Forgot Your Password?</a>
            </div>

            <button type="submit" class="btn btn-success w-100">Login</button>

            <p class="text-center mt-4">Don’t have an account? <a href="{{ route('register') }}" class="text-success fw-semibold">Sign up</a></p>
          </form>
        </div>
      </div>

      <!-- Right: Image/Brand -->
      <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center bg-light-green">

        <div class="container background-banner text-center px-4 d-flex flex-column align-items-center justify-content-center text-center w-100 px-4">
          <a href="/">
            <img src="{{ asset('images/logo_v2.png') }}" alt="GVN Fin Trade Logo" class="img-fluid mb-4" style="max-height: 80px;">
            <div id="lottie-container" style="height:400px;" class="img-fluid w-100 d-block" alt="">
          </a>

        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap Icons (optional) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.10.2/lottie.min.js"></script>
  <script src="https://unpkg.com/feather-icons"></script>
</body>

</html>

<script>
  function togglePassword() {
    const input = document.getElementById("password");
    input.type = input.type === "password" ? "text" : "password";
  }
  const logoBaseUrl = "{{ asset('images/animation') }}";
  var animation = lottie.loadAnimation({
    container: document.getElementById('lottie-container'), // id của div
    renderer: 'canvas', // có thể là 'svg', 'canvas', hoặc 'html'
    loop: true, // lặp vô tận
    autoplay: true, // tự động chạy
    path: logoBaseUrl + '/data.json', // đường dẫn tới file JSON
    rendererSettings: {
      preserveAspectRatio: 'none' // <<-- cực kỳ quan trọng
    }
  });
  animation.addEventListener('enterFrame', function(e) {
    if (e.currentTime < 120) {
      animation.setSpeed(3); // trước frame 60 chạy nhanh
    } else {
      animation.setSpeed(1.5); // sau frame 60 chạy bình thường
    }
  });
</script>