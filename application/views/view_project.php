<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Details</title>
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
<div class="container p-5">
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
                        <dd><?php echo date("d F Y", strtotime($project->startDate)); ?></dd>
                    </dl>
                </div>
                <div class="col-md-6">
                    <dl>
                        <dt><b class="border-bottom border-primary">End Date</b></dt>
                        <dd><?php echo date("d F Y", strtotime($project->endDate)); ?></dd>
                        <dt><b class="border-bottom border-primary">Budget</b></dt>
                        <dd><?php echo "RM" . $project->budget; ?></dd>
                        <dt><b class="border-bottom border-primary">Budget Source</b></dt>
                        <dd><?php echo $project->budgetSource; ?></dd>
                    </dl>
                </div>
            </div>

            <a href="<?php echo site_url('phase/index/'.$project->projectID); ?>" class="btn btn-primary btn-sm">View Phases</a>

            <a href="<?php echo site_url('phase/progress_by_project/'.$project->projectID); ?>" class="btn btn-primary btn-sm">View Progress</a>

        <div class="card mt-4">
    <div class="card-header bg-info text-white">
        <h4>Phases in This Project</h4>
    </div>
    <div class="card-body">
        <?php if (!empty($phases)) : ?>
            <table class="table table-bordered table-striped">
                <thead class="table-info text-center">
                    <tr>
                        <th>Phase Name</th>
                        <th>Progress</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($phases as $phase) : 
                        $progress = ($phase->totalActivities > 0) 
                            ? round(($phase->completedActivities / $phase->totalActivities) * 100) 
                            : 0;
                    ?>
                        <tr>
                            <td><?= $phase->phaseName ?></td>
                            <td>
                                
                               <div class="progress">
                                                <div class="progress-bar <?= ($phase->progress == 100) ? 'bg-success' : 'bg-info' ?>"
                                                    role="progressbar"
                                                    style="width: <?= $phase->progress ?>%;"
                                                    aria-valuenow="<?= $phase->progress ?>"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    <?= $phase->progress ?>%
                                                </div>
                                            </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No phases have been added to this project.</p>
        <?php endif; ?>
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


        <h4>Invite Users to This Project</h4>
<?php if (!empty($users)): ?>
    <form action="<?= site_url('project/invite_user') ?>" method="POST">
        <div class="form-group">
            <label for="userID">Select User</label>
            <select name="userID" class="form-control" required>
                <option value="">Select Member</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?= $user->userID ?>"><?= $user->userName ?> (<?= $user->userEmail ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>
        <input type="hidden" name="projectID" value="<?= $project->projectID ?>">
        <button type="submit" class="btn btn-primary mt-2">Invite</button>
    </form>
<?php else: ?>
    <p>No Project Member.</p>
<?php endif; ?>


<h4 class="mt-5">Invited Members</h4>
<?php if (!empty($members)): ?>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($members as $member): ?>
                <tr>
                    <td><?= $member->userName ?></td>
                    <td><?= $member->userEmail ?></td>
                    <td>
                        <?php if ($member->status == 'accepted'): ?>
                            <span class="badge badge-success">Accepted</span>
                        <?php elseif ($member->status == 'rejected'): ?>
                            <span class="badge badge-danger">Rejected</span>
                        <?php else: ?>
                            <span class="badge badge-warning">Pending</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($member->status == 'accepted'): ?>
                            <a href="<?= base_url('project/remove_member/' . $projectID . '/' . $member->userID) ?>"
                               class="btn btn-sm btn-danger w-30"
                               onclick="return confirm('Are you sure you want to remove this member from the project?');">
                               Remove
                            </a>
                        <?php elseif ($member->status == 'pending'): ?>
                            <a href="<?= base_url('project/cancel_invitation/' . $projectID . '/' . $member->userID) ?>"
                               class="btn btn-sm btn-info w-30"
                               onclick="return confirm('Are you sure you want to cancel the invitation?');">
                               Cancel
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No members have been invited yet.</p>
<?php endif; ?>
        
        </div>
    </div>
</div>
</div>
</div>
</div>

</body>
</html>
