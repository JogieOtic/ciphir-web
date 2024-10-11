<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - CIPHIR</title>
    <link href="/css/loginpage.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <img src="/img/Web System logo.png" alt="CIPHIR Logo">
                <p class="header-text">Empowering Communities<br>Through Connection and Collaboration</p>
            </div>
            <ul class="nav-links">
                <li><a href="/">Main Page</a></li>
            </ul>
        </nav>
    </header>

    <div class="login-container">
        <div class="login-box">
            <h2>ADMIN LOGIN</h2>
            <h3>Please enter CIPHIR admin credentials</h3>
            <form action="{{ route('login.submit') }}" method="POST">
                    @csrf <!-- CSRF protection -->
                    <!-- Username Field -->
                    <div class="input-wrapper">
                        <input type="text" name="username" placeholder=" Admin Username" required>
                    </div>
                    <!-- Password Field with Eye Icon -->
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        <span class="toggle-password" id="togglePassword">
                            <!-- Default to Eye Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="20" height="20">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-.12.379-.26.744-.42 1.094M4.21 15.014A9.959 9.959 0 012.458 12M15.905 18.636A9.967 9.967 0 0112 19c-4.478 0-8.268-2.943-9.542-7 .275-.72.635-1.39 1.054-2.01m16.81 3.99A9.955 9.955 0 0121.542 12" />
                            </svg>
                        </span>
                    </div>


                    <button type="submit" class="log-in-btn">Login</button>

                    <!-- Error message display section -->
                    @if ($errors->any())
                        <div class="error-messages">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
            </form>

        </div>

        <div class="login-info">
            <div class="logo-eye">
                <img src="/img/eye1.png" alt="Eye Logo" class="eye-logo">
            </div>
            <h1>CIPHIR</h1>
            <h2>Centralized Information Platform for Community Hazards and Infrastructure Reports</h2>
            <h4>________________________________________________________________________</h4>
            <p>Welcome to CIPHIR, the dedicated admin panel for managing community hazards and infrastructure reports. Use this platform to efficiently track, address, and resolve issues reported by residents, ensuring a safer and well-maintained community. Log in to access your dashboard and start making a difference today.</p>
        </div>
    </div>

        <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            // Toggle the type attribute
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Toggle the eye icon
            this.src = type === 'password' ? '/img/eye-icon.png' : '/img/eye-slash-icon.png'; 
        });
    </script>

</body>
</html>
