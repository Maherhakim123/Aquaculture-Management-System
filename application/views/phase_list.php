<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Phases</title>
</head>
<body>

<div class="content-wrapper">
    <div class="container p-3">
        <h2>Project Phases</h2>
        <a href="<?php echo site_url('phase/create/'.$projectID); ?>" class="btn btn-success mb-2">Add Phase</a>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                <th>Phase Name</th>
                <th>Start Date</th>
                <th>Deadline</th>
                <th>Status</th>
                <th>Progress</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
    <?php foreach ($phases as $phase): ?>
        <tr>
            <td><?= $phase->phaseName; ?></td>
            <td><?= $phase->startDate; ?></td>
            <td><?= $phase->deadline; ?></td>
            <td><?= $phase->status; ?></td>
            <td><?= $phase->progress; ?>%</td>
            <td>
                <a href="<?= site_url('phase/view/' . $phase->phaseID); ?>" class="btn btn-info btn-sm">View</a>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>

        </table>
    </div>
</div>

</body>
</html>
