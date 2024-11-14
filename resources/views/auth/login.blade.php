<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="logo2.png" type="image/x-icon">
  <title>University Scribe Login</title>
  <link rel="stylesheet" href="login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
  

<section>
  <div class="container">
    <img src="logo.png" alt="University Scribe Logo">
    <form method="POST" action="{{ route('login.post') }}" onsubmit="validateLoginForm(event)">
      @csrf
      @if ($errors->any())
        <div class="message error">
          @foreach ($errors->all() as $error)
            {{ $error }}
          @endforeach
        </div>
      @endif

      @if (session('success'))
        <div class="message success">
          {{ session('success') }}
        </div>
      @endif

      <!-- @if (session('error'))
          <div class="error-message">
              {{ __('Invalid login credentials.') }}
          </div>
      @endif -->

      <div class="input-container" id="login_identifier_container">
        <input type="text" class="form-control @error('login_identifier') is-invalid @enderror" name="login_identifier" id="login_identifier" placeholder="Student ID Number or Email" required>
        <span class="error-icon">⚠️</span>
      </div>
      @error('login_identifier')
            <span class="text-danger" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

      <div class="input-container">
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" required>
        <i class="fas fa-eye eye-icon" id="togglePassword" onclick="togglePasswordVisibility()"></i>
      </div>
      @error('password')
          <span class="text-danger" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
<br>
<!-- <input type="checkbox" name="remember"> Remember Me -->

      <div class="button-group">
        <button type="submit">{{ __('Login') }}</button>
        <a href="{{ route('register') }}" class="button">{{ __('Register') }}</a>
      </div>
<br>
      <a  target="_blank" class="register-link"  href="{{route('forget.password')}}">Forgot password?</a>

    </form>

  </div>
</section>

<script>
  function validateLoginForm(event) {
    var loginIdentifier = document.getElementById('login_identifier').value;
    var loginIdentifierContainer = document.getElementById('login_identifier_container');

    // Clear previous error messages
    loginIdentifierContainer.classList.remove('error');

    // Perform additional validation if needed
  }

  function togglePasswordVisibility() {
    var passwordInput = document.getElementById('password');
    var togglePassword = document.getElementById('togglePassword');
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      togglePassword.classList.remove('fa-eye');
      togglePassword.classList.add('fa-eye-slash');
    } else {
      passwordInput.type = "password";
      togglePassword.classList.remove('fa-eye-slash');
      togglePassword.classList.add('fa-eye');
    }
  }
</script>

</body>
</html>
