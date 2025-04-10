<!DOCTYPE html>
<html>
<head>
    <title>My Project Invitations</title>
    <!-- AdminLTE and Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/dist/css/adminlte.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/bootstrap/css/bootstrap.min.css') ?>">
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper p-4">

        <div class="container-fluid">
            <h3 class="mb-4"><i class="fas fa-envelope-open-text"></i> Pending Project Invitations</h3>

            <?php if (!empty($pending_invitations)): ?>
                <div class="card">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Project Name</th>
                                    <th>Location</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach ($pending_invitations as $invitation): ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $invitation->projectName ?></td>
                                        <td><?= $invitation->projectLocation ?></td>
                                        <td>
                                            <form action="<?= site_url('project/accept_invitation') ?>" method="POST" class="d-inline">
                                                <input type="hidden" name="projectID" value="<?= $invitation->projectID ?>">
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="fas fa-check"></i> Accept
                                                </button>
                                            </form>
                                            <!-- Optional: Add Reject Button -->
                                            <!--
                                            <form action="<?= site_url('project/reject_invitation') ?>" method="POST" class="d-inline">
                                                <input type="hidden" name="projectID" value="<?= $invitation->projectID ?>">
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-times"></i> Reject
                                                </button>
                                            </form>
                                            -->
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-info mt-4">
                    <i class="fas fa-info-circle"></i> You have no pending invitations.
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>

<!-- Scripts (optional, for full AdminLTE functionality) -->
<script src="<?= base_url('assets/template/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/template/dist/js/adminlte.min.js') ?>"></script>

</body>
</html>
