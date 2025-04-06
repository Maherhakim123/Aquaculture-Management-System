<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record List</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/template/dist/css/adminlte.min.css') ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>

<!-- <div class="content-wrapper"> -->
    <div class="container p-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>Record List</h2>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 text-end">
                            <a href="<?= site_url('record/create') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Record</a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>Record</th>
                                    <th>Quantity</th>
                                    <th>Record Date</th>
                                    <th>Income Generated (RM)</th>
                                    <th>Condition</th>
                                    <!-- <th>Project ID</th> -->
                                    <!-- <th>Actions</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($records)): ?>
                                    <?php foreach ($records as $index => $record): ?>
                                        <tr>
                                            <td><?= $index + 1; ?></td>
                                            <td><?= $record['quantity']; ?></td>
                                            <td><?= $record['recordDate']; ?></td>
                                            <td>RM<?= $record['incomeGenerated']; ?></td>
                                            <td><?= $record['situation']; ?></td>
                                            <!-- <td><?= $record['projectID']; ?></td> -->
                                            <!-- <td class="text-center">
                                                <a href="<?= site_url('record/view/' . $record['recordID']) ?>" class="btn btn-success btn-sm">View</a>
                                                <a href="<?= site_url('record/edit/' . $record['recordID']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="<?= site_url('record/delete/' . $record['recordID']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                                            </td> -->
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No records found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/template/dist/js/adminlte.min.js') ?>"></script>
</body>
</html>
