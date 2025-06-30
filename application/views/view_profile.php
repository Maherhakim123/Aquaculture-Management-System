<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/template/dist/css/adminlte.min.css'); ?>">
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
                    <?php if ($users) { ?>
                        <h3 class="card-title"><?php echo $users->userName; ?></h3>
                        <p class="card-text">
                            <strong>Email:</strong> <?php echo $users->userEmail; ?><br>
                            <strong>IC:</strong> <?php echo $users->userIC; ?><br>
                            <strong>Phone Number:</strong> <?php echo $users->userPhoneNo; ?><br>
                            <strong>Role:</strong> <?php echo $users->userRole; ?>

                           

                        </p>

                       
                    <?php } else { ?>
                        <p class="text-danger">Error: User details not available.</p>
                    <?php } ?>
                    <form action="<?php echo base_url('dashboard/edit_profile'); ?>" method="post" style="display:inline;">
                        <input type="hidden" name="user_id" value="<?php echo $users->userID; ?>">
                        <button type="submit" class="btn btn-warning">Edit Profile</button>
                    </form>
                    <form action="<?php echo base_url('dashboard/delete_profile'); ?>" method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete your profile? This action cannot be undone.');">
                        <input type="hidden" name="user_id" value="<?php echo $users->userID; ?>">
                        <button type="submit" class="btn btn-danger">Delete Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
