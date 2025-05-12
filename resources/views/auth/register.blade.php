<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register - GVN Fin Trade</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
  <style>
    body {
      min-height: 100vh;
    }
    .bg-light-green {
      background: linear-gradient(to bottom right, #e6f5e9, #d1f1dc);
    }
    .form-control:focus {
      box-shadow: none;
      border-color: #198754;
    }
  </style>
</head>
<body>
<div class="container-fluid">
  <div class="row min-vh-100">

    <!-- LEFT FORM -->
    <div class="col-lg-6 d-flex align-items-center justify-content-center p-4">
      <div class="w-100" style="max-width: 400px;">
        <h2 class="fw-bold">Register Account</h2>
        <p class="text-muted">Register today to personalize your experience!</p>
        <form method="POST" action="{{ route('register') }}">
        @csrf
        <!-- Username -->
        <div class="mb-3">
          <label class="form-label">Username <span class="text-danger">*</span></label>
          <div class="input-group has-validation">
            <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
            <span class="input-group-text"><i class="bi bi-person"></i></span>
            @error('name')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
          </div>
        </div>

        <!-- Email -->
        <div class="mb-3">
          <label class="form-label">Email Address <span class="text-danger">*</span></label>
          <div class="input-group has-validation">
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

          </div>
        </div>

        <!-- Password -->
        <div class="mb-3">
          <label class="form-label">Password <span class="text-danger">*</span></label>
          <div class="input-group">
            <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"
                                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters"" placeholder="Password" >
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
          </div>
          @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <small class="form-text text-muted">
            Must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters.
        </small>
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
          <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
          <div class="input-group">
            <input type="password" class="form-control">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>

          </div>
        </div>

        <!-- Register Button -->
        <div class="d-grid mb-2">
          <button class="btn btn-success">Register</button>
        </div>

        <p class="text-muted text-center">Already have an account? <a href="{{ route('login') }}" class="text-success">Log in</a></p>
        </form>
      </div>
    </div>

    <!-- RIGHT VISUAL -->
    <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center bg-light-green">

<div class="container background-banner text-center px-4 d-flex flex-column align-items-center justify-content-center text-center w-100 px-4">
<a href="/"><img src="{{ asset('images/logo_v2.png') }}" alt="GVN Fin Trade Logo" class="img-fluid mb-4" style="max-height: 80px;">
<div id="lottie-container" style="height:400px;" class="img-fluid w-100 d-block" alt=""></a>

</div>
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
                 const logoBaseUrl = "{{ asset('images/animation') }}";
        var animation = lottie.loadAnimation({
                container: document.getElementById('lottie-container'), // id của div
                renderer: 'canvas', // có thể là 'svg', 'canvas', hoặc 'html'
                loop: true, // lặp vô tận
                autoplay: true, // tự động chạy
                path: logoBaseUrl+'/data.json', // đường dẫn tới file JSON
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

