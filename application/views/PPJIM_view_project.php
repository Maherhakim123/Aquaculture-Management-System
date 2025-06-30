<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Details</title>
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

<div class="content-wrapper">
      <!-- Back to Dashboard Button -->
        <form action="<?php echo site_url('dashboard/PPJIM_Dashboard'); ?>" method="post" style="display: inline;">
            <button type="submit" class="btn btn-secondary mt-3">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </button>
        </form>

<div class="container p-3">
    <div class="row justify-content-center">
    <div class="col-md-12">
    <div class="card shadow">
        <div class="card-header">
            <h3 class="card-title">Project Details</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <dl>
                        <dt><b class="border-bottom border-primary">Project Name</b></dt>
                        <dd><?php echo $project->projectName; ?></dd>
                        <dt><b class="border-bottom border-primary">Location</b></dt>
                        <dd><?php echo $project->projectLocation; ?></dd>
                        <dt><b class="border-bottom border-primary">Start Date</b></dt>
                        <dd><?php echo date('d F Y', strtotime($project->startDate)); ?></dd>
                    </dl>
                </div>
                <div class="col-md-6">
                    <dl>
                        <dt><b class="border-bottom border-primary">End Date</b></dt>
                        <dd><?php echo date('d F Y', strtotime($project->endDate)); ?></dd>
                        <dt><b class="border-bottom border-primary">Budget</b></dt>
                        <dd><?php echo 'RM'.$project->budget; ?></dd>
                        <dt><b class="border-bottom border-primary">Budget Source</b></dt>
                        <dd><?php echo $project->budgetSource; ?></dd>
                    </dl>
                </div>
            </div>

            <!-- <a href="<?php echo site_url('phase/index/'.$project->projectID); ?>" class="btn btn-primary btn-sm">View Phases</a>

            <a href="<?php echo site_url('phase/progress_by_project/'.$project->projectID); ?>" class="btn btn-primary btn-sm">View Progress</a> -->

        <div class="card mt-4">
    <div class="card-header bg-info text-white">
        <h4>Phases in This Project</h4>
    </div>
    <div class="card-body">
        <?php if (!empty($phases)) { ?>
            <table class="table table-bordered table-striped">
                <thead class="table-info text-center">
                    <tr>
                        <th>Phase Name</th>
                        <th>Progress</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($phases as $phase) {
                        $progress = ($phase->totalActivities > 0)
                            ? round(($phase->completedActivities / $phase->totalActivities) * 100)
                            : 0;
                        ?>
                        <tr>
                            <td><?php echo $phase->phaseName; ?></td>
                            <td>
                                
                               <div class="progress">
                                                <div class="progress-bar <?php echo ($phase->progress == 100) ? 'bg-success' : 'bg-info'; ?>"
                                                    role="progressbar"
                                                    style="width: <?php echo $phase->progress; ?>%;"
                                                    aria-valuenow="<?php echo $phase->progress; ?>"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    <?php echo $phase->progress; ?>%
                                                </div>
                                            </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>No phases have been added to this project.</p>
        <?php } ?>
    </div>
</div>

<!-- Modern Pie Chart UI -->
<div class="row justify-content-center mt-5 mb-4">
    <div class="col-md-6 text-center">
        <h5 class="font-weight-bold text-body mb-3"> Budget Usage Overview</h5>
        <div style="background-color: #f8f9fa; border-radius: 10px; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
            <canvas id="budgetChart" style="max-height: 250px;"></canvas>
            <p class="mt-3 mb-0">
                <span class="text-danger font-weight-bold">Spent:</span> RM<?php echo number_format($totalSpent, 2); ?> |
                <span class="text-success font-weight-bold">Remaining:</span> RM<?php echo number_format($project->budget - $totalSpent, 2); ?>
            </p>
        </div>
    </div>
</div>



        </div>
    </div>
</div>
</div>
</div>
</div>

<div class="content-wrapper">
<div class="container p-5">
    <div class="row justify-content-center">
    <div class="col-md-12">
    <div class="card shadow">
        <div class="card-header">
            <h3 class="card-title">Project Members</h3>
        </div>
        <div class="card-body">


<h4 class="mt-5">Invited Members</h4>
<?php if (!empty($members)) { ?>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <!-- <th>Action</th> -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($members as $member) { ?>
                <tr>
                    <td><?php echo $member->userName; ?></td>
                    <td><?php echo $member->userEmail; ?></td>
                    <td>
                        <?php if ($member->status == 'accepted') { ?>
                            <span class="badge badge-success">Accepted</span>
                        <?php } elseif ($member->status == 'rejected') { ?>
                            <span class="badge badge-danger">Rejected</span>
                        <?php } else { ?>
                            <span class="badge badge-warning">Pending</span>
                        <?php } ?>
                    </td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <p>No members have been invited yet.</p>
<?php } ?>
        
        </div>
    </div>
</div>
</div>
</div>
</div>

<!-- JavaScript pie chart usage spending -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('budgetChart').getContext('2d');

  const totalBudget = <?php echo $project->budget; ?>;
  const totalSpent = <?php echo $totalSpent; ?>; // This should be passed from your controller
  const remaining = totalBudget - totalSpent;

  const budgetChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['Spent', 'Remaining'],
      datasets: [{
        label: 'Budget',
        data: [totalSpent, remaining],
        backgroundColor: ['#dc3545', '#28a745']
      }]
    },
    options: {
      responsive: true
    }
  });
</script>


</body>
</html>
