<h2>Records for Project: <?= $project['projectName'] ?></h2>


<table border="1">
    <tr>
        <th>User Name</th>
        <th>Quantity</th>
        <th>Record Date</th>
        <th>Income Generated</th>
        <th>Situation</th>
    </tr>
    <?php foreach ($data['record'] as $record): ?>
    <tr>
        <td><?= $record['userName'] ?></td>
        <td><?= $record['quantity'] ?></td>
        <td><?= $record['recordDate'] ?></td>
        <td><?= $record['incomeGenerated'] ?></td>
        <td><?= $record['situation'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>
