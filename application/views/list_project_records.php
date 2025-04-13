
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="<?= base_url('assets/template/dist/css/adminlte.min.css') ?>">
</head>
<body>

<div class="content-wrapper">
    <div class="container p-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Project Records</h3>
            </div>
            <div class="card-body">
                <?php if (!empty($records)) : ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Record ID</th>
                                    <th>Person In Charge</th>
                                    <th>Quantity</th>
                                    <th>Record Date</th>
                                    <th>Income Generated</th>
                                    <th>Situation</th>
                                </tr>
                            </thead>
                            <tbody>
    <?php $i = 1; foreach ($records as $record) : ?>
        <tr>
            <td><?= $i++; ?></td> <!-- Row number starts from 1 -->
            <td><?= $record['userName']; ?></td>
            <td><?= $record['quantity']; ?></td>
            <td><?= date("d M Y", strtotime($record['recordDate'])); ?></td>
            <td>RM <?= number_format($record['incomeGenerated'], 2); ?></td>
            <td>
                <?php if ($record['situation'] == 'Good') : ?>
                    <span class="badge badge-success"><?= $record['situation']; ?></span>
                <?php elseif ($record['situation'] == 'Moderate') : ?>
                    <span class="badge badge-warning"><?= $record['situation']; ?></span>
                <?php else : ?>
                    <span class="badge badge-danger"><?= $record['situation']; ?></span>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>

                        </table>
                    </div>
                <?php else : ?>
                    <div class="alert alert-info">
                        No records found for this project.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>



</body>
</html>
