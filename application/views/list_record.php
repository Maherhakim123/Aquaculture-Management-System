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

<div class="container">
    <h2>Project Records</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Record ID</th>
                <th>Quantity</th>
                <th>Record Date</th>
                <th>Income Generated</th>
                <th>Situation</th>
                <th>User Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records as $record): ?>
                <tr>
                    <td><?php echo $record['recordID']; ?></td>
                    <td><?php echo $record['quantity']; ?></td>
                    <td><?php echo $record['recordDate']; ?></td>
                    <td><?php echo $record['incomeGenerated']; ?></td>
                    <td><?php echo $record['situation']; ?></td>
                    <td><?php echo $record['userName']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/template/dist/js/adminlte.min.js') ?>"></script>
</body>
</html>
