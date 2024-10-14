const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");
    const icon = togglePassword.querySelector("i");

    togglePassword.addEventListener("click", function () {
        // Toggle password visibility
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);

        // Toggle the eye icon between fa-eye and fa-eye-slash
        icon.classList.toggle("fa-eye");
        icon.classList.toggle("fa-eye-slash");
    });
