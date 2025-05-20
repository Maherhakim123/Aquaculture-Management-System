<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Phase Details</title>
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
<body>

<div class="content-wrapper">
  <div class="content p-3">
    <div class="container">
      <div class="card">
        <div class="card-header bg-primary text-white">
          <h3 class="card-title">Activities Progress</h3>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped">
            <thead class="thead-dark">
              <tr>
                <th>Phase</th>
                <th>Activity</th>
                <!-- <th>Record Date</th> -->
                <th>Comment</th>
              </tr>
            </thead>
         <tbody>
<?php foreach ($progressData as $entry): ?>
    <?php $activities = $entry['activities']; ?>
    <?php $activityCount = count($activities); ?>
    <?php $rowIndex = 0; ?>
    <?php foreach ($activities as $activity): ?>
        <tr>
            <?php if ($rowIndex === 0): ?>
                <td rowspan="<?= $activityCount ?>"><?= $entry['phase']->phaseName ?></td>
            <?php endif; ?>
            <td><?= $activity->activityType ?> - <?= $activity->activityName ?></td>
            <td>
                <?php if (!empty($activity->comments)): ?>
                    <?php foreach ($activity->comments as $comment): ?>
                        <div>
                            <?= nl2br(htmlspecialchars($comment['comment'])) ?><br>
                            <small class="text-muted"><?= date('d M Y, h:i A', strtotime($comment['created_at'])) ?></small>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <em>No comments</em>
                <?php endif; ?>
            </td>
        </tr>
        <?php $rowIndex++; ?>
    <?php endforeach; ?>
<?php endforeach; ?>
</tbody>

          </table>
        </div>
        <div class="card-footer">
          <a href="<?= site_url('project/community_view/'.$projectID) ?>" class="btn btn-secondary">Back to Project</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Optional: Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
