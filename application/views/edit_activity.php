<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Activity</title>
  <link rel="stylesheet" href="<?= base_url('assets/template/dist/css/adminlte.min.css') ?>">
</head>
<body>
<div class="container mt-5">
  <div class="card">
    <div class="card-header bg-warning text-white">
      <h4>Edit Activity</h4>
    </div>
    <div class="card-body">
      <form method="post" action="<?= site_url('activity/update/' . $activity->activityID) ?>">
        <div class="form-group">
          <label>Activity Type</label>
          <select name="activityType" class="form-control" required>
            <option value="Spending" <?= ($activity->activityType == 'Spending') ? 'selected' : '' ?>>Spending</option>
            <option value="Income Generation" <?= ($activity->activityType == 'Income Generation') ? 'selected' : '' ?>>Income Generation</option>
            <option value="Assets" <?= ($activity->activityType == 'Assets') ? 'selected' : '' ?>>Assets</option>
            <option value="Water Quality" <?= ($activity->activityType == 'Water Quality') ? 'selected' : '' ?>>Water Quality</option>
          </select>
        </div>
        <div class="form-group">
          <label>Activity Name</label>
          <input type="text" name="activityName" value="<?= $activity->activityName ?>" class="form-control" required>
        </div>
        <!-- <div class="form-group">
          <label>Comment</label>
          <textarea name="comment" class="form-control"><?= $activity->comment ?></textarea>
        </div> -->
        <!-- <div class="form-group">
          <label>Date</label>
          <input type="datetime-local" name="recordDate" value="<?= date('Y-m-d\TH:i', strtotime($activity->recordDate)) ?>" class="form-control" required>
        </div> -->
        <button type="submit" class="btn btn-success">Update</button>
        <a href="<?= site_url('phase/view/' . $activity->phaseID) ?>" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
</div>
</body>
</html>
