<!DOCTYPE html>
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
      <form method="post" action="<?= site_url('activity/add') ?>">

        <!-- Select Phase -->
        <div class="form-group mb-3">
          <label>Select Phase</label>
          <select name="phaseID" class="form-control" required>
            <option value="">-- Select Phase --</option>
            <?php foreach ($phases as $phase): ?>
              <option value="<?= $phase->phaseID ?>"><?= $phase->phaseName ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Activity Type -->
        <div class="form-group mb-3">
          <label>
            Activity Type
            <span
              class="badge bg-info rounded-circle"
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

        <!-- Activity Name (initially hidden) -->
        <div class="form-group mb-3" id="activityNameGroup" style="display: none;">
          <label>Activity Name</label>
          <input type="text" name="activityName" class="form-control">
        </div>

        <!-- Comment -->
        <div class="form-group mb-3">
          <label>Comment (Optional)</label>
          <textarea name="comment" class="form-control" rows="3"></textarea>
        </div>

        <!-- Record Date -->
        <div class="form-group mb-3">
          <label>Date</label>
          <input type="datetime-local" name="recordDate" class="form-control" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">
          <i class="fas fa-plus"></i> Submit Activity
        </button>

        <!-- Cancel Button -->
        <a href="<?= site_url('phase/index') ?>" class="btn btn-secondary">
          <i class="fas fa-arrow-left"></i> Cancel
        </a>
      </form>
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
</html>
