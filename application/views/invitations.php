<!DOCTYPE html>
<html>
<head>
    <title>My Project Invitations</title>
    <link rel="stylesheet" href="<?= base_url('assets/template/dist/css/adminlte.min.css') ?>">
</head>
<body class="container mt-5">
    <h2>Pending Project Invitations</h2>

    <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-info"><?= $this->session->flashdata('message') ?></div>
    <?php endif; ?>

    <?php if (!empty($invitations)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Location</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($invitations as $invite): ?>
                    <tr>
                        <td><?= $invite->projectName ?></td>
                        <td><?= $invite->projectLocation ?></td>
                        <td>
                            <a href="<?= site_url('project/respond_invitation/'.$invite->id.'/accepted') ?>" class="btn btn-success btn-sm">Accept</a>
                            <a href="<?= site_url('project/respond_invitation/'.$invite->id.'/rejected') ?>" class="btn btn-danger btn-sm">Reject</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No invitations available.</p>
    <?php endif; ?>
</body>
</html>
