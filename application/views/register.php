<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Register</title>
</head>
<body>



<div class="container mt-5">
    <h1 class="text-center mb-4">Register</h1>
    <form action="<?php echo base_url('auth/add')?>" method="POST" class="shadow p-4 rounded bg-light">
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" id="name" name="leaderName" class="form-control" value="<?php echo set_value('name'); ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="leaderEmail" class="form-control" value="<?php echo set_value('email'); ?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" id="password" name="leaderPassword" class="form-control" value="<?php echo set_value('password'); ?>">
        </div>
        <div class="mb-3">
            <label for="phoneNo" class="form-label">Phone Number:</label>
            <input type="text" id="phoneNo" name="leaderPhoneNo" class="form-control" value="<?php echo set_value('phoneNo'); ?>">
        </div>
        <div class="mb-3">
            <label for="department" class="form-label">Department:</label>
            <input type="text" id="department" name="department" class="form-control">
        </div>
        <div class="mb-3">
            <label for="majorExpertise" class="form-label">Major Expertise:</label>
            <input type="text" id="majorExpertise" name="majorExpertise" class="form-control">
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </form>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-Ym2G28oVuKMbcbUP46OEuEUmPO0IkUfyRfMkgL37dkwSfVP1GMv4VJkxjNhypGn4" crossorigin="anonymous"></script>
</body>
</html>
