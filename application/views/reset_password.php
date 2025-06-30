<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .password-toggle {
            cursor: pointer;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h5>Reset Your Password</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="" onsubmit="return showSuccessMessage()">
                        <div class="mb-3">
                            <label for="userPassword" class="form-label">New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="userPassword" id="userPassword" required />
                                <span class="input-group-text password-toggle" id="togglePassword">
                                    <i class="fa-solid fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Update Password</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="<?php echo base_url('auth/login'); ?>">Back to login</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function showSuccessMessage() {
    alert("Password updated successfully!");
    return true;
}

const togglePassword = document.querySelector('#togglePassword');
const passwordField = document.querySelector('#userPassword');
const toggleIcon = togglePassword.querySelector('i');

togglePassword.addEventListener('click', function () {
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);

    // Toggle icon
    toggleIcon.classList.toggle('fa-eye');
    toggleIcon.classList.toggle('fa-eye-slash');
});
</script>

</body>
</html>
