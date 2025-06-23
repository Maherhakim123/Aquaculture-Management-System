<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Phases</title>

    <!-- Bootstrap and AdminLTE styles -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/dist/css/adminlte.min.css') ?>">
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
                            <?php if (!empty($phases)): ?>
                                <?php foreach ($phases as $phase): ?>
                                    <tr>
                                        <td><?= $phase->phaseName; ?></td>
                                        <td><?= date('d M Y', strtotime($phase->startDate)); ?></td>
                                        <td><?= date('d M Y', strtotime($phase->deadline)); ?></td>
                                        <td>
                                           <span class="badge
                                                <?= ($phase->status == 'completed') ? 'badge-success' : (($phase->status == 'not_started') ? 'badge-secondary' : 'badge-warning'); ?>">
                                                <?= ucwords(str_replace('_', ' ', $phase->status)); ?>
                                            </span>
                                        </td>                               
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
                                              <small class="text-muted d-block mt-1">
                                                <?= $phase->completedActivities ?> of <?= $phase->totalActivities ?> activities completed
                                              </small>
                                        </td>
                                        <td>
                                            <a href="<?= site_url('phase/view/' . $phase->phaseID); ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> View
                                            </a>

                                            <a href="<?= site_url('phase/edit/' . $phase->phaseID); ?>" class="btn btn-warning btn-sm">
                                                <i class="fas fa-eye"></i> Edit
                                            </a>

                                            <a href="<?= site_url('phase/delete/' . $phase->phaseID . '/' . $projectID); ?>" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this activity?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No phases found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <div class="card-footer">
                        <a href="<?= site_url('phase/create/'.$projectID); ?>" class="btn btn-success"> Add Phase</a>
                        <a href="<?= site_url('project/view/'.$projectID) ?>" class="btn btn-secondary"> Back to Project</a>
                        
                    </div>

                </div>
            </div>
        </div> 
    </div> 
</div> 

</body>
</html>
