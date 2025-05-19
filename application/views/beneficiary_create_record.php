<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Activity</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/template/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Add Activity</h4>
    </div>
    <div class="card-body">

    <form method="POST" action="<?= base_url('activity/add') ?>">
    <div class="form-group">
        <label for="projectID">Project:</label>
        <select name="projectID" id="projectID" class="form-control" required>
            <option value="">-- Select Project --</option>
            <?php foreach ($projects as $project): ?>
                <option value="<?= $project->projectID ?>"><?= $project->projectName ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="phaseID">Phase:</label>
        <select name="phaseID" id="phaseID" class="form-control" required>
            <option value="">-- Select Phase --</option>
        </select>
    </div>

    <!-- Activity Type -->
    <div class="form-group">
        <label>
            Activity Type
            <span
              class="badge badge-info rounded-circle"
              role="button"
              onclick="revealActivityName()"
              style="cursor: pointer; margin-left: 5px;"
              title="Click to enter activity name"
            > 
              i
            </span>
        </label>
        <select name="activityType" class="form-control" required>
            <option value="">-- Select Activity Type --</option>
            <option value="Spending">Spending</option>
            <option value="Income Generation">Income Generation</option>
            <option value="Assets">Assets</option>
            <option value="Water Quality">Water Quality</option>
        </select>
    </div>

    <!-- Activity Name -->
    <div class="form-group">
        <label>Activity Name</label>
        <input type="text" name="activityName" class="form-control">
    </div>

    <!-- Comment -->
    <div class="form-group">
        <label>Comment (Optional)</label>
        <textarea name="comment" class="form-control" rows="3"></textarea>
    </div>

    <!-- Date -->
    <div class="form-group">
        <label>Date</label>
        <input type="date" name="recordDate" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-plus"></i> Submit Activity
    </button>
</form>

<!-- Reveal Activity Name Script -->
<script>
    function revealActivityName() {
        document.getElementById('activityNameGroup').style.display = 'block';
    }

    // AJAX to populate phases by project
    document.getElementById('projectID').addEventListener('change', function () {
        const projectID = this.value;
        fetch("<?= base_url('activity/getPhasesByProject/') ?>" + projectID)
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


<script>
    document.getElementById('projectID').addEventListener('change', function () {
        const projectID = this.value;

        fetch("<?= base_url('activity/getPhasesByProject/') ?>" + projectID)
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

      




    </div>
  </div>
</div>

<!-- JS to reveal Activity Name input -->
<script>
  function revealActivityName() {
    document.getElementById('activityNameGroup').style.display = 'block';
  }
</script>

</body>
</html> -->


<form method="POST" action="<?= base_url('activity/beneficiary_add_comment_form') ?>">
    <div class="form-group">
        <label for="projectID">Project:</label>
        <select name="projectID" id="projectID" class="form-control" required>
            <option value="">-- Select Project --</option>
            <?php foreach ($projects as $project): ?>
                <option value="<?= $project->projectID ?>"><?= $project->projectName ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="phaseID">Phase:</label>
        <select name="phaseID" id="phaseID" class="form-control" required>
            <option value="">-- Select Phase --</option>
        </select>
    </div>

    <div class="form-group">
        <label for="activityID">Activity:</label>
        <select name="activityID" id="activityID" class="form-control" required>
            <option value="">-- Select Activity --</option>
        </select>
    </div>

    <div class="form-group">
        <label>Comment</label>
        <textarea name="comment" class="form-control" rows="3" required></textarea>
    </div>

    <button type="submit" class="btn btn-success">Submit Comment</button>
</form>

<script>
    document.getElementById('projectID').addEventListener('change', function () {
        const projectID = this.value;
        fetch("<?= base_url('activity/getPhasesByProject/') ?>" + projectID)
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

    document.getElementById('phaseID').addEventListener('change', function () {
        const phaseID = this.value;
        fetch("<?= base_url('activity/getActivitiesByPhase/') ?>" + phaseID)
            .then(response => response.json())
            .then(data => {
                const activityDropdown = document.getElementById('activityID');
                activityDropdown.innerHTML = '<option value="">-- Select Activity --</option>';
                data.forEach(activity => {
                    const option = document.createElement('option');
                    option.value = activity.activityID;
                    option.textContent = activity.activityType + " - " + activity.activityName;
                    activityDropdown.appendChild(option);
                });
            });
    });
</script>
