<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List of Users</title>
    <!-- Bootstrap and AdminLTE CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/dist/css/adminlte.min.css') ?>">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>

<div class="content-wrapper">
    <div class="container p-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>User List</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>Bil.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>IC</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($users)): ?>
                                    <?php $no = 1; foreach ($users as $user): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $user->userName; ?></td>
                                            <td><?= $user->userEmail; ?></td>
                                            <td><?= $user->userIC; ?></td>
                                            <td><?= $user->userPhoneNo; ?></td>
                                            <td><?= $user->userRole; ?></td>
                                            <td> <a href="<?= site_url('dashboard/delete_user/' . $user->userID); ?>" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this user?');"> Delete </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No users found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div> <!-- card-body -->
                </div> <!-- card -->
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="<?= base_url('assets/template/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/template/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/template/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>

<!-- sorting -->
<script>
    $(function () {
        $(".table").DataTable();
    });
</script>

</body>
</html>
