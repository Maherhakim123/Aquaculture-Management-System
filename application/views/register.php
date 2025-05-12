<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/template/dist/css/adminlte.min.css') ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f8f9fa;
        }
        .form-container {
            max-width: 800px;
            padding: 60px;
            margin: 20px auto 10px;
        }
        .form-header {
            background: #007bff;
            color: #fff;
            padding: 5px;
            border-radius: 5px 5px 0 0;
        }
        .form-body {
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 0 0 5px 5px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>

<div class="container form-container">
    <div class="form-header text-center">
        <h1 class="mb-0">Register</h1>
        <p class="mb-0">Join us today and start your journey!</p>
    </div>
    <form action="<?php echo base_url('auth/add')?>" method="POST" class="form-body shadow">
        <div class="form-group">
            <label for="name" class="form-label">Name:</label>
            <input type="text" id="name" name="userName" class="form-control" placeholder="Enter your name" value="<?php echo set_value('name'); ?>">
        </div>
        <div class="form-group">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="userEmail" class="form-control" placeholder="Enter your email" value="<?php echo set_value('email'); ?>">
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Password:</label>
            <input type="password" id="password" name="userPassword" class="form-control" placeholder="Enter your password" value="<?php echo set_value('password'); ?>">
        </div>
        <div class="form-group">
            <label for="ic" class="form-label">IC:</label>
            <input type="text" id="ic" name="userIC" class="form-control" placeholder="Enter your IC number" value="<?php echo set_value('ic'); ?>">
        </div>
        <div class="form-group">
            <label for="phoneNo" class="form-label">Phone Number:</label>
            <input type="text" id="phoneNo" name="userPhoneNo" class="form-control" placeholder="Enter your phone number" value="<?php echo set_value('phoneNo'); ?>">
        </div>
        <div class="form-group">
            <label for="role" class="form-label">Role:</label>
            <select id="role" name="userRole" class="form-control">
                <option value="" disabled selected>Choose your role</option>
                <option value="Project Leader">Project Leader</option>
                <option value="Beneficiary">Beneficiary</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Register</button>
        <div class="text-center mt-2">
                    <small>You have an account? <a href="<?php echo base_url('auth/login'); ?>">Login here</a></small>
                </div>
    </form>
</div>

<!-- Fuction Notification for email existed -->
 <?php if (isset($email_exists) && $email_exists): ?>
    <script>
        alert('This email is already registered. Please use another one.');
    </script>
<?php endif; ?>


<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>