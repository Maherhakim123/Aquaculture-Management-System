<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Project Invitations</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/bootstrap/css/bootstrap.min.css') ?>">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="<?= base_url('assets/template/dist/css/adminlte.min.css') ?>">
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper p-4">
        <section class="content">
            <div class="container-fluid">
                <h3 class="mb-4"> Pending Project Invitations </h3>

                <?php if (!empty($pending_invitations)): ?>
                    <div class="card">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="card-title mb-0">Invitations</h5>
                        </div>
  <div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-hover text-nowrap table-bordered mb-0">
            <thead class="thead-dark">
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Project Name</th>
                    <th>Location</th>
                    <th>Project By</th>
                    <th style="width: 200px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach ($pending_invitations as $invitation): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $invitation->projectName ?></td>
                        <td><?= $invitation->projectLocation ?></td>
                        <td><?= $invitation->userName ?></td>
                        <td>
                            <form action="<?= site_url('project/accept_invitation') ?>" method="POST" class="d-inline">
                                <input type="hidden" name="projectID" value="<?= $invitation->projectID ?>">
                                <button type="submit" class="btn btn-success btn-sm">
                                  Accept
                                </button>
                            </form>

                            <a href="<?= site_url('project/reject_invitation/' . $invitation->projectID . '/' . $invitation->userID) ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Are you sure you want to reject this invitation?');">
                                 Reject
                            </a>
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
        </section>
    </div>

</div>

<!-- jQuery -->
<script src="<?= base_url('assets/template/plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/template/dist/js/adminlte.min.js') ?>"></script>

</body>
</html>