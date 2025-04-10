<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Joined Projects</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/template/dist/css/adminlte.min.css') ?>">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>

<div class="content-wrapper">
    <div class="container p-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h3 class="card-title">My Joined Projects</h3>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($projects)): ?>
                            <div class="row">
                                <?php foreach ($projects as $project): ?>
                                    <div class="col-md-6">
                                        <div class="card mb-4 shadow-sm">
                                            <div class="card-header bg-primary text-white">
                                                <h5 class="card-title mb-0"><?= $project->projectName ?></h5>
                                            </div>
                                            <div class="card-body">
                                                <dl>
                                                    <dt><b class="border-bottom border-primary">Location</b></dt>
                                                    <dd><?= $project->projectLocation ?></dd>
                                                    <dt><b class="border-bottom border-primary">Start Date</b></dt>
                                                    <dd><?= date("d F Y", strtotime($project->startDate)) ?></dd>
                                                    <dt><b class="border-bottom border-primary">End Date</b></dt>
                                                    <dd><?= date("d F Y", strtotime($project->endDate)) ?></dd>
                                                    <dt><b class="border-bottom border-primary">Budget</b></dt>
                                                    <dd>RM<?= $project->budget ?></dd>
                                                    <dt><b class="border-bottom border-primary">Budget Source</b></dt>
                                                    <dd><?= $project->budgetSource ?></dd>
                                                </dl>
                                                <a href="<?= site_url('phase/index/' . $project->projectID) ?>" class="btn btn-primary btn-sm mt-2">
                                                    <i class="fas fa-eye"></i> View Phases
                                                </a>

                                                <a href="<?= site_url('phase/index/' . $project->projectID) ?>" class="btn btn-primary btn-sm mt-2">
                                                    <i class="fas fa-eye"></i> View Project
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info">You have not joined any projects yet.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="<?= base_url('assets/template/plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap -->
<script src="<?= base_url('assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/template/dist/js/adminlte.min.js') ?>"></script>

</body>
</html>
