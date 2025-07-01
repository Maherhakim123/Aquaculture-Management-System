<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aquaculture | Register</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- AdminLTE CSS -->
    <link href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            background-color: #f4f6f9;
        }

        .register-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .card {
            width: 100%;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 1.5rem;
        }

        .form-header {
            background: #007bff;
            color: white;
            padding: 0.5rem;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 5px;
            
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 10px;
        }

        .welcome-content {
            max-width: 500px;
            margin-right: 20px;
        }

        .welcome-content h1 {
            font-size: 2.5rem;
            color: #343a40;
        }

        .welcome-content p {
            font-size: 1.1rem;
            color: #6c757d;
        }

        .text-center {
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .register-container {
                flex-direction: column-reverse;
            }

            .welcome-content {
                margin: 0 0 20px 0;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    
    <!-- alert notification duplicate email  -->
    <?php if (isset($email_exists) && $email_exists) { ?>
    <div class="container position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 1055; max-width: 500px;">
        <div class="alert alert-danger alert-dismissible fade show shadow" role="alert">
            This email is already registered. Please use another one.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>

    <script>
        // Auto-dismiss the alert after 5 seconds
        setTimeout(function () {
            let alertNode = document.querySelector('.alert');
            if (alertNode) {
                let alert = new bootstrap.Alert(alertNode);
                alert.close();
            }
        }, 5000);
    </script>
<?php } ?>

    <div class="register-container">
        <!-- Left Side: Welcome Message -->
        <div class="welcome-content">
            <h1>Welcome !</h1>
            <p>Create your account and start the journey.</p>
        </div>

        <!-- Right Side: Registration Form -->
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="form-header">
                    <h3>Register</h3>
                </div>
                <form action="<?php echo base_url('auth/add'); ?>" method="POST">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="userName" class="form-control" placeholder="Enter your name" value="<?php echo set_value('name'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="userEmail" class="form-control" placeholder="Enter your email" value="<?php echo set_value('email'); ?>" required>
                    </div>
                    <!-- <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="userPassword" class="form-control" placeholder="Enter your password" value="<?php echo set_value('password'); ?>" required>
                    </div> -->
                    <div class="form-group position-relative">
                        <label for="password">Password:</label>
                        <div class="input-group">
                            <input type="password" id="password" name="userPassword" class="form-control" placeholder="Enter your password" value="<?php echo set_value('password'); ?>" required>
                            <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                <i class="fas fa-eye" id="togglePasswordIcon"></i>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="ic">IC:</label>
                        <input type="text" id="ic" name="userIC" class="form-control" placeholder="Enter your IC number" value="<?php echo set_value('ic'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phoneNo">Phone Number:</label>
                        <input type="text" id="phoneNo" name="userPhoneNo" class="form-control" placeholder="Enter your phone number" value="<?php echo set_value('phoneNo'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role:</label>
                        <select id="role" name="userRole" class="form-control" required>
                            <option value="" disabled selected>Choose your role</option>
                            <option value="Project Leader">Project Leader</option>
                            <option value="Beneficiary">Beneficiary</option>
                        </select>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
                <div class="text-center mt-2">
                    <small>Already have an account? <a href="<?php echo base_url('auth/login'); ?>">Login here</a></small>
                </div>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

<script>
    document.getElementById("togglePassword").addEventListener("click", function () {
        const passwordInput = document.getElementById("password");
        const icon = document.getElementById("togglePasswordIcon");

        const isPasswordVisible = passwordInput.type === "text";
        passwordInput.type = isPasswordVisible ? "password" : "text";

        // Toggle icon class
        icon.classList.toggle("fa-eye");
        icon.classList.toggle("fa-eye-slash");
    });
</script>


</html>
