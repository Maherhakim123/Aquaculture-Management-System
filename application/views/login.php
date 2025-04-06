<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title>Login</title>
    <style>
        .password-toggle {
            cursor: pointer;
        }
        .form-header {
            background: #007bff;
            color: #fff;
            padding: 0.5px;
            border-radius: 5px 5px 0 0;
            margin-bottom: 5px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg" style="width: 400px;">
            <div class="card-body">
                <div class="form-header text-center">
                    <h3 class="card-title text-center mb-4">Sign In</h3>
                </div>
                <form action="<?php echo base_url('auth/validate_login'); ?>" method="POST" id="login-form">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <input type="email" id="email" class="form-control" name="userEmail" required placeholder="Enter your email">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" id="password" class="form-control" name="userPassword" required placeholder="Enter your password">
                            <span class="input-group-text password-toggle"><i class="fas fa-eye" id="togglePassword"></i></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select id="role" class="form-control" name="userRole" required>
                            <option value="">Select Role</option>
                            <option value="Project Leader">Project Leader</option>
                            <option value="Community Member">Community Member</option>
                        </select>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">LogIn</button>
                    </div>
                </form>
                <div class="text-center mt-2">
                    <a href="#">Forgot Password?</a>
                </div>
                <div class="text-center mt-2">
                    <small>Don't have an account? <a href="<?php echo base_url('auth/register'); ?>">Register here</a></small>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-Yi3kjnDSp+x1nzBYJXJcwxh2Hltlf9xPDLlM/I2ibVY3hQdcGiWd+g8jQfKfvj9E" crossorigin="anonymous"></script>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#password');
        togglePassword.addEventListener('click', function () {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
