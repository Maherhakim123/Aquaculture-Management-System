

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
                        <a href="<?= site_url('activity/beneficiary_add_comment_form/' . $phase->phaseID); ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-tasks"></i> Add Comment
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center">No phases found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>


                    <div class="card-footer">
                        <a href="<?= site_url('project/community_view/'.$projectID) ?>" class="btn btn-secondary"> Back to Project</a>
                        
                    </div>

                </div>
                 <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.container-fluid -->
    </div> <!-- /.content -->
</div> <!-- /.content-wrapper -->

</body>
</html>
