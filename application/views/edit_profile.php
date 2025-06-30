<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/template/dist/css/adminlte.min.css'); ?>">
</head>
<body>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Profile</h1>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <form method="post" action="<?php echo base_url('dashboard/update_profile'); ?>">
                        <div class="form-group">
                            <label for="userName">Name</label>
                            <input type="text" name="userName" id="userName" class="form-control" value="<?php echo $user->userName; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Email</label>
                            <input type="email" name="userEmail" id="userEmail" class="form-control" value="<?php echo $user->userEmail; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="userIC">IC</label>
                            <input type="text" name="userIC" id="userIC" class="form-control" value="<?php echo $user->userIC; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="userPhoneNo">Phone Number</label>
                            <input type="text" name="userPhoneNo" id="userPhoneNo" class="form-control" value="<?php echo $user->userPhoneNo; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
