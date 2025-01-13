<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="<?= base_url('assets/template/dist/css/adminlte.min.css') ?>">
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
                    <form method="post" action="<?= base_url('dashboard/update_profile'); ?>">
                        <div class="form-group">
                            <label for="userName">Name</label>
                            <input type="text" name="userName" id="userName" class="form-control" value="<?= $user->userName; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Email</label>
                            <input type="email" name="userEmail" id="userEmail" class="form-control" value="<?= $user->userEmail; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="userIC">IC</label>
                            <input type="text" name="userIC" id="userIC" class="form-control" value="<?= $user->userIC; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="userPhoneNo">Phone Number</label>
                            <input type="text" name="userPhoneNo" id="userPhoneNo" class="form-control" value="<?= $user->userPhoneNo; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="userRole">Role</label>
                            <input type="text" name="userRole" id="userRole" class="form-control" value="<?= $user->userRole; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="<?= base_url('dashboard/profile'); ?>" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
