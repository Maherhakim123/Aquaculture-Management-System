<!-- beneficiary_add_comment.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Comment</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/template/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('assets/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/template/dist/css/adminlte.min.css') ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <div class="content-wrapper p-3">
    <div class="container">
      <div class="card card-primary shadow">
        <div class="card-header">
          <h3 class="card-title">Add Comment</h3>
        </div>

        <form method="POST" action="<?= base_url('activity/save_beneficiary_comment') ?>">
          <div class="card-body">

            <!-- Hidden project ID -->
            <input type="hidden" name="projectID" value="<?= $projectID ?>">

            <!-- Phase Selection -->
            <div class="form-group">
              <label for="phaseID">Phase</label>
              <select name="phaseID" id="phaseID" class="form-control" required>
                <option value="">-- Select Phase --</option>
                <?php foreach ($phases as $p): ?>
                  <option value="<?= $p->phaseID ?>"><?= $p->phaseName ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <!-- Activity Selection (populated by AJAX) -->
            <div class="form-group">
              <label for="activityID">Activity</label>
              <select name="activityID" id="activityID" class="form-control" required>
                <option value="">-- Select Activity --</option>
              </select>
            </div>

            <!-- Comment Textarea -->
            <div class="form-group">
              <label for="comment">Comment</label>
              <textarea name="comment" class="form-control" rows="3" required></textarea>
            </div>

            <!-- Optional Spending Input -->
            <div class="form-group">
              <label for="spending">Spending Budget (RM) <small>(optional)</small></label>
              <input type="number" name="spending" step="0.01" class="form-control" placeholder="Enter amount spent">
            </div>

          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit Comment</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="<?= base_url('assets/template/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/template/dist/js/adminlte.min.js') ?>"></script>

<!-- AJAX for dynamic activity list -->
<script>
  document.getElementById('phaseID').addEventListener('change', function () {
    const phaseID = this.value;
    const url = "<?= base_url('activity/getActivitiesByPhase/') ?>" + phaseID;

    fetch(url)
      .then(resp => resp.json())
      .then(data => {
        const actSel = document.getElementById('activityID');
        actSel.innerHTML = '<option value="">-- Select Activity --</option>';
        data.forEach(a => {
          const opt = document.createElement('option');
          opt.value = a.activityID;
          opt.textContent = `${a.activityType} - ${a.activityName}`;
          actSel.appendChild(opt);
        });
      });
  });
</script>

</body>
</html>
