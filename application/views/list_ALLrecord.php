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
                        </div>
                        <table class="table table-bordered table-striped">
                        <thead class="table-primary text-center">
    <tr>
        <th>Record</th>
        <th>Quantity</th>
        <th>Record Date</th>
        <th>Income Generated (RM)</th>
        <th>Condition</th>
        <th>Person In Charge</th> <!-- New column -->
        <th>Actions</th>
    </tr>
</thead>

<tbody>
    <div class="card mt-4">
    <div class="card-header bg-primary text-white">
        <h4>Your Progress Records</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="table-primary text-center">
                <tr>
                    <th>Record ID</th>
                    <th>Quantity</th>
                    <th>Record Date</th>
                    <th>Income Generated</th>
                    <th>Situation</th>
                    <!-- <th>Person In Charge</th> -->
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($records)): ?>
                    <?php foreach ($records as $record): ?>
                        <tr>
                            <td><?= $record['recordID']; ?></td>
                            <td><?= $record['quantity']; ?></td>
                            <td><?= $record['recordDate']; ?></td>
                            <td><?= $record['incomeGenerated']; ?></td>
                            <td><?= $record['situation']; ?></td>
                            <!-- <td><?= $record['userName']; ?></td> -->
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
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
