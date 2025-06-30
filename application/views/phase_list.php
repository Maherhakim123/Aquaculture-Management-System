<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Phases</title>

    <!-- Bootstrap and AdminLTE styles -->
    <link rel="stylesheet" href="<?php echo base_url('assets/template/plugins/fontawesome-free/css/all.min.css'); ?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/dist/css/adminlte.min.css'); ?>">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>

<div class="content-wrapper">
    <div class="content p-3">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Project Phases</h3>
                   
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Phase Name</th>
                                <th>Start Date</th>
                                <th>Deadline</th>
                                <th>Status</th>
                                <th>Progress</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($phases)) { ?>
                                <?php foreach ($phases as $phase) { ?>
                                    <tr>
                                        <td><?php echo $phase->phaseName; ?></td>
                                        <td><?php echo date('d M Y', strtotime($phase->startDate)); ?></td>
                                        <td><?php echo date('d M Y', strtotime($phase->deadline)); ?></td>
                                        <td>
                                           <span class="badge
                                                <?php echo ($phase->status == 'completed') ? 'badge-success' : (($phase->status == 'not_started') ? 'badge-secondary' : 'badge-warning'); ?>">
                                                <?php echo ucwords(str_replace('_', ' ', $phase->status)); ?>
                                            </span>
                                        </td>                               
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
                                              <small class="text-muted d-block mt-1">
                                                <?php echo $phase->completedActivities; ?> of <?php echo $phase->totalActivities; ?> activities completed
                                              </small>
                                        </td>
                                        <td>
                                            <form action="<?php echo site_url('phase/view'); ?>" method="post" class="d-inline">
                                                <input type="hidden" name="phaseID" value="<?php echo $phase->phaseID; ?>">
                                                <button type="submit" class="btn btn-info btn-sm"> View </button>
                                            </form>

                                            <form action="<?php echo site_url('phase/edit'); ?>" method="post" class="d-inline">
                                                <input type="hidden" name="phaseID" value="<?php echo $phase->phaseID; ?>">
                                                <button type="submit" class="btn btn-warning btn-sm"> Edit </button>
                                            </form>

                                            <form action="<?php echo site_url('phase/delete'); ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this activity?')">
                                                <input type="hidden" name="phaseID" value="<?php echo $phase->phaseID; ?>">
                                                <input type="hidden" name="projectID" value="<?php echo $projectID; ?>">
                                                <button type="submit" class="btn btn-danger btn-sm"> Delete </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="6" class="text-center">No phases found.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <div class="card-footer">
                        <form action="<?php echo site_url('phase/create'); ?>" method="post" class="d-inline">
                            <input type="hidden" name="projectID" value="<?php echo $projectID; ?>">
                            <button type="submit" class="btn btn-success">Add Phase</button>
                        </form>
                        <form action="<?php echo site_url('project/view'); ?>" method="post" class="d-inline">
                            <input type="hidden" name="projectID" value="<?php echo $projectID; ?>">
                            <button type="submit" class="btn btn-secondary">Back to Project</button>
                        </form>
                        
                    </div>

                </div>
            </div>
        </div> 
    </div> 
</div> 

</body>
</html>
