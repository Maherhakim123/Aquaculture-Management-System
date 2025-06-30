<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Activity</title>
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
<body class="hold-transition sidebar-mini">

<div class="wrapper">
  <div class="content-wrapper p-3">
    <div class="container">
      <div class="card card-primary shadow">
        <div class="card-header">
          <h3 class="card-title">Create New Activity</h3>
        </div>

        <form method="POST" action="<?php echo site_url('activity/add'); ?>">
          <input type="hidden" name="activityID" value="<?php echo isset($id) ? htmlspecialchars($id) : ''; ?>">
          <div class="card-body">

            <div class="form-group">
              <label for="projectID">Project</label>
              <select name="projectID" id="projectID" class="form-control" required>
          <option value="">-- Select Project --</option>
          <?php foreach ($projects as $project) { ?>
            <option value="<?php echo $project->projectID; ?>"><?php echo $project->projectName; ?></option>
          <?php } ?>
              </select>
            </div>

            <div class="form-group">
              <label for="phaseID">Phase</label>
              <select name="phaseID" id="phaseID" class="form-control" required>
          <option value="">-- Select Phase --</option>
              </select>
            </div>

            <div class="form-group">
              <label for="activityType">Activity Type</label>
              <select name="activityType" class="form-control" required>
          <option value="">-- Select Activity Type --</option>
          <option value="Spending">Spending</option>
          <option value="Income Generation">Income Generation</option>
          <option value="Assets">Assets</option>
          <option value="Water Quality">Water Quality</option>
          <option value="Others">Others</option>
              </select>
            </div>

            <div class="form-group">
              <label for="activityName">Activity Name</label>
              <input type="text" name="activityName" class="form-control">
            </div>

          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit Activity</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="<?php echo base_url('assets/template/plugins/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/template/dist/js/adminlte.min.js'); ?>"></script>

<!-- Populate Phases AJAX -->
<script>
  document.getElementById('projectID').addEventListener('change', function () {
    const projectID = this.value;
    fetch("<?php echo base_url('activity/getPhasesByProject/'); ?>" + projectID)
      .then(response => response.json())
      .then(data => {
        const phaseDropdown = document.getElementById('phaseID');
        phaseDropdown.innerHTML = '<option value="">-- Select Phase --</option>';
        data.forEach(phase => {
          const option = document.createElement('option');
          option.value = phase.phaseID;
          option.textContent = phase.phaseName;
          phaseDropdown.appendChild(option);
        });
      });
  });
</script>

</body>
</html>
