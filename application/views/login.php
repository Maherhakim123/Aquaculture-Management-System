<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- AdminLTE CSS -->
    <link href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            background-color: #f4f6f9;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .card {
            width: 100%;
            max-width: 450px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 2rem;
        }

        .form-header {
            background: #007bff;
            color: white;
            padding: 1rem;
            border-radius: 10px;
            text-align: center;
        }

        .password-toggle {
            cursor: pointer;
        }

        .welcome-content {
            max-width: 500px;
            margin-left: 20px;
        }

        .welcome-content h1 {
            font-size: 2.5rem;
            color: #343a40;
        }

        .welcome-content p {
            font-size: 1.1rem;
            color: #6c757d;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 10px;
        }

        .text-center {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="form-header">
                    <h3>Sign In</h3>
                </div>
                <form action="<?php echo base_url('auth/validate_login'); ?>" method="POST" id="login-form">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" name="userEmail" required placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input type="password" id="password" class="form-control" name="userPassword" required placeholder="Enter your password">
                            <span class="input-group-text password-toggle"><i class="fas fa-eye" id="togglePassword"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select id="role" class="form-control" name="userRole" required>
                            <option value="">Select Role</option>
                            <option value="Project Leader">Project Leader</option>
                            <option value="Community Member">Beneficiary</option>
                        </select>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Log In</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <a href="#">Forgot Password?</a>
                </div>
                <div class="text-center mt-2">
                    <small>Don't have an account? <a href="<?php echo base_url('auth/register'); ?>">Register here</a></small>
                </div>
            </div>
        </div>

        <div class="welcome-content">
            <h1>Welcome Back!</h1>
            <p>Please enter your credentials to access your dashboard.</p>
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
