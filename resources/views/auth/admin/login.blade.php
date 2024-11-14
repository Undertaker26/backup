<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('logo2.png') }}" type="image/x-icon">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <section>
        <div class="container">
        <img src="{{ asset('logo.png') }}" alt="University Scribe Logo">
            
            <h2>Admin Login</h2>
            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf
                <div class="input-container">
                    <input type="text" class="form-control @error('login_identifier') is-invalid @enderror"name="email" id="email" placeholder="Email" required>
                    @error('email')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-container">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" required>
                    <i class="fas fa-eye eye-icon" id="togglePassword" onclick="togglePasswordVisibility()"></i>
                    @error('password')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="button-group">
                    <button type="submit">{{ __('Login') }}</button>
                </div>
            </form>
        </div>
    </section>

    <script>
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
