const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');
    const eyeOpen = document.getElementById('eyeOpen');
    const eyeClosed = document.getElementById('eyeClosed');

    // Toggle password visibility
    togglePassword.addEventListener('click', function () {
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';

        // Switch icons based on password visibility
        if (isPassword) {
            eyeOpen.style.display = 'block';
            eyeClosed.style.display = 'none';
        } else {
            eyeOpen.style.display = 'none';
            eyeClosed.style.display = 'block';
        }
    });

    // Ensure that when the page loads, the eye is closed and the password is hidden
    window.addEventListener('load', function () {
        passwordInput.type = 'password'; // Make sure the password is hidden on page load
        eyeOpen.style.display = 'none';  // Hide open eye
        eyeClosed.style.display = 'block'; // Show closed eye
    });
