<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Joined Projects</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="<?= base_url('assets/template/dist/css/adminlte.min.css') ?>">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0 text-dark">My Joined Projects</h1>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <?php if (!empty($projects)): ?>
                <div class="row">
                    <?php foreach ($projects as $project): ?>
                        <div class="col-md-6">
                            <div class="card shadow-sm mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="card-title mb-0"><?= $project->projectName ?></h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Location:</strong> <?= $project->projectLocation ?></p>
                                    <p><strong>Start Date:</strong> <?= date("d F Y", strtotime($project->startDate)) ?></p>
                                    <p><strong>End Date:</strong> <?= date("d F Y", strtotime($project->endDate)) ?></p>
                                    <p><strong>Budget:</strong> RM<?= $project->budget ?></p>
                                    <p><strong>Budget Source:</strong> <?= $project->budgetSource ?></p>

    

                                    <a href="<?= site_url('project/Communityview/' . $project->projectID) ?>" class="btn btn-primary btn-sm">
                                         View Project
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
    </section>
</div>

</body>
</html>
