<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Phase Details</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/template/plugins/fontawesome-free/css/all.min.css'); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/template/dist/css/adminlte.min.css'); ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>

<div class="content-wrapper mt-3">

                  <!-- Back Button to Phase -->
                <form action="<?php echo site_url('phase/index'); ?>" method="post" style="display:inline;">
                    <input type="hidden" name="projectID" value="<?php echo isset($projectID) ? $projectID : ''; ?>">
                    <button type="submit" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Phase</button>
                </form>

  <div class="container p-3">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card shadow">
          <div class="card-header bg-primary text-white text-center">
            <h3>Phase Activity Details</h3>
          </div>
          <div class="card-body">

            <!-- Phase Info -->
            <table class="table table-bordered mb-4">
              <tbody>
                <tr>
                  <th style="width: 30%;">Phase Name</th>
                  <td><?php echo $phase->phaseName; ?></td>
                </tr>
                <tr>
                  <th>Start Date</th>
                  <td><?php echo date('d M Y', strtotime($phase->startDate)); ?></td>
                  </tr>
                <tr>
                  <th>Deadline</th>
                  <td><?php echo date('d M Y', strtotime($phase->deadline)); ?></td>
                </tr>
              </tbody>
            </table>


            <hr>


<h5 class="mt-4">Activity History</h5>
<table class="table table-striped table-bordered">
  <thead class="thead-dark">
    <tr>
      <th>#</th>
      <th>Type</th>
      <th>Name</th>
      <!-- <th>Comment</th> -->
      <!-- <th>Date</th> -->
      <th>Actions</th> 
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($activities)) { ?>
      <?php foreach ($activities as $index => $activity) { ?>
        <tr>
          <td><?php echo $index + 1; ?></td>
          <td><?php echo $activity->activityType; ?></td>
          <td><?php echo $activity->activityName; ?></td>
          <!-- <td><?php echo $activity->comment; ?></td> -->
          <td class="text-center">
            <form action="<?php echo site_url('activity/edit'); ?>" method="post" style="display:inline;">
              <input type="hidden" name="activityID" value="<?php echo $activity->activityID; ?>">
              <button type="submit" class="btn btn-warning btn-sm">Edit</button>
            </form>
            <form action="<?php echo site_url('activity/delete'); ?>" method="post" style="display:inline;">
              <input type="hidden" name="activityID" value="<?php echo $activity->activityID; ?>">
              <input type="hidden" name="phaseID" value="<?php echo $phase->phaseID; ?>">
              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this activity?')">
              Delete
              </button>
            </form>
            </td>
        </tr>
      <?php } ?>
    <?php } else { ?>
      <tr>
        <td colspan="6" class="text-center">No activities recorded yet.</td>
      </tr>
    <?php } ?>
  </tbody>
</table>

    <hr>

      

<!-- Hidden Form -->

    </div>

</div>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>




<!-- JavaScript to toggle form -->
<script>
    function toggleForm() {
        const formDiv = document.getElementById("activityForm");
        if (formDiv.style.display === "none") {
            formDiv.style.display = "block";
        } else {
            formDiv.style.display = "none";
        }
    }

    function revealActivityName() {
    document.getElementById('activityNameGroup').style.display = 'block';
  }
</script>






<!-- Optional: Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
