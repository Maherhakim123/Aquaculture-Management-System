<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record List</title>
</head>
<body>
    <h2>All Records</h2>
    <a href="<?= site_url('record/create') ?>">Add New Record</a>
    <table border="1">
        <tr>
            <th>Record Date</th>
            <th>Income Generated</th>
            <th>Condition</th>
            <th>Project ID</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($records as $record): ?>
        <tr>
            <td><?= $record['recordID']; ?></td>
            <td><?= $record['recordDate']; ?></td>
            <td><?= $record['incomeGenerated']; ?></td>
            <td><?= $record['situation']; ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
</body>
</html>
