<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Activity</title>

  <!-- AdminLTE & Bootstrap Styles -->
  <link rel="stylesheet" href="<?php echo base_url('assets/template/plugins/fontawesome-free/css/all.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/template/dist/css/adminlte.min.css'); ?>">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">

  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper pt-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">

          <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-edit"></i> Edit Activity</h3>
            </div>

            <form method="post" action="<?php echo site_url('activity/update/'.$activity->activityID); ?>">
              <div class="card-body">

                <!-- Hidden phaseID field -->
                <input type="hidden" name="phaseID" value="<?php echo $phaseID; ?>">

                <div class="form-group">
                  <label for="activityType">Activity Type</label>
                  <select name="activityType" id="activityType" class="form-control" required>
                    <option value="Spending" <?php echo ($activity->activityType == 'Spending') ? 'selected' : ''; ?>>Spending</option>
                    <option value="Income Generation" <?php echo ($activity->activityType == 'Income Generation') ? 'selected' : ''; ?>>Income Generation</option>
                    <option value="Assets" <?php echo ($activity->activityType == 'Assets') ? 'selected' : ''; ?>>Assets</option>
                    <option value="Water Quality" <?php echo ($activity->activityType == 'Water Quality') ? 'selected' : ''; ?>>Water Quality</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="activityName">Activity Name</label>
                  <input type="text" name="activityName" id="activityName" value="<?php echo $activity->activityName; ?>" class="form-control" required>
                </div>

              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">Update</button>
              </div>
            </form>

            <!-- Cancel button using POST to return to phase view -->
            <form method="post" action="<?php echo site_url('phase/view'); ?>" style="display:inline;" class="m-3">
              <input type="hidden" name="phaseID" value="<?php echo $phaseID; ?>">
              <button type="submit" class="btn btn-secondary">Cancel</button>
            </form>

          </div> <!-- card -->
        </div>
      </div>
    </div>
  </div>
</div>

<!-- JS Scripts -->
<script src="<?php echo base_url('assets/template/plugins/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/template/dist/js/adminlte.min.js'); ?>"></script>

</body>
</html>
