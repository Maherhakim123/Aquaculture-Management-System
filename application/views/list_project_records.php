<div class="container mt-4">
    <h2>Project Records</h2>
    <?php if (!empty($records)) : ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Record ID</th>
                    <th>User Name</th>
                    <th>Quantity</th>
                    <th>Record Date</th>
                    <th>Income Generated</th>
                    <th>Situation</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record) : ?>
                    <tr>
                        <td><?= $record['recordID']; ?></td>
                        <td><?= $record['userName']; ?></td>
                        <td><?= $record['quantity']; ?></td>
                        <td><?= $record['recordDate']; ?></td>
                        <td>RM <?= number_format($record['incomeGenerated'], 2); ?></td>
                        <td><?= $record['situation']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No records found for this project.</p>
    <?php endif; ?>
</div>
