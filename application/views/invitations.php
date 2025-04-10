<!DOCTYPE html>
<html>
<head>
    <title>My Project Invitations</title>
    <link rel="stylesheet" href="<?= base_url('assets/template/dist/css/adminlte.min.css') ?>">
</head>
<body>
<div class="container mt-5">
    <h3>Pending Project Invitations</h3>
    <?php if (!empty($pending_invitations)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Location</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pending_invitations as $invitation): ?>
                    <tr>
                        <td><?= $invitation->projectName ?></td>
                        <td><?= $invitation->projectLocation ?></td>
                        <td>
                            <form action="<?= site_url('project/accept_invitation') ?>" method="POST">
                                <input type="hidden" name="projectID" value="<?= $invitation->projectID ?>">
                                <button type="submit" class="btn btn-success btn-sm">Accept</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>You have no pending invitations.</p>
    <?php endif; ?>
</div>

</body>

</html>