<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - CIPHIR</title>
    <link href="/css/loginpage.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

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
                    <div class="input-wrapper" style="position: relative;">
                        <input type="password" id="password" name="password" placeholder="Password" required style="padding-right: 30px;">
                        <span class="toggle-password" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                            <!-- Font Awesome Eye Slash Icon by Default -->
                            <i class="fas fa-eye-slash"></i>
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

    <script src="/js/login.js"></script>

</body>
</html>
