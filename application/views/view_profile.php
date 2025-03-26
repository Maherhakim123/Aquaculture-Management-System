<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="<?= base_url('assets/template/dist/css/adminlte.min.css') ?>">
</head>
<body>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">User Profile</h1>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <?php if ($users): ?>
                        <h3 class="card-title"><?php echo $users->userName; ?></h3>
                        <p class="card-text">
                            <strong>Email:</strong> <?php echo $users->userEmail; ?><br>
                            <strong>IC:</strong> <?php echo $users->userIC; ?><br>
                            <strong>Phone Number:</strong> <?php echo $users->userPhoneNo; ?><br>
                            <strong>Role:</strong> <?php echo $users->userRole; ?>

                           

                        </p>

                       
                    <?php else: ?>
                        <p class="text-danger">Error: User details not available.</p>
                    <?php endif; ?>
                    <a href="<?= base_url('dashboard/dashboard'); ?>" class="btn btn-primary">Back to Dashboard</a>
                    <a href="<?= base_url('dashboard/edit_profile'); ?>" class="btn btn-warning">Edit Profile</a>
                    <a href="<?= base_url('dashboard/delete_profile'); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your profile? This action cannot be undone.');">Delete Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
