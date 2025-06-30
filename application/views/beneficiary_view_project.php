
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
        <form action="<?php echo site_url('dashboard/beneficiary_dashboard'); ?>" method="post" style="display: inline;">
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
                                    <dd>RM<?php echo $project->budget; ?></dd>
                                    <dt><b class="border-bottom border-primary">Budget Source</b></dt>
                                    <dd><?php echo $project->budgetSource; ?></dd>
                                </dl>
                            </div>
                        </div>
                        <form action="<?php echo site_url('phase/beneficiary_progress'); ?>" method="post" style="display:inline;">
                            <input type="hidden" name="projectID" value="<?php echo $project->projectID; ?>">
                            <button type="submit" class="btn btn-primary btn-sm">View Progress</button>
                        </form>

                        <form action="<?php echo site_url('activity/beneficiary_add_comment_form'); ?>" method="post" style="display:inline;">
                            <input type="hidden" name="projectID" value="<?php echo $project->projectID; ?>">
                            <button type="submit" class="btn btn-primary btn-sm">Add Comment</button>
                        </form>


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
                        <th>Phase </th>
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
                            <td class="text-center">
    <?php
        $badgeClass = 'badge-secondary'; // default

                        switch ($phase->status) {
                            case 'completed':
                                $badgeClass = 'badge-success';
                                break;
                            case 'in_progress':
                                $badgeClass = 'badge-warning';
                                break;
                            case 'not_started':
                                $badgeClass = 'badge-secondary';
                                break;
                        }
                        ?>
    <span class="badge <?php echo $badgeClass; ?> text-uppercase"><?php echo $phase->status; ?></span>
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


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



   

</body>
</html>
