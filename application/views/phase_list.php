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
                        <td><?= htmlspecialchars($phase->phaseName) ?></td>
                        <td><?= htmlspecialchars($phase->startDate) ?></td>
                        <td><?= htmlspecialchars($phase->deadline) ?></td>
                        <td><?= htmlspecialchars($phase->status) ?></td>
                        <td><?= htmlspecialchars($phase->progress) ?>%</td>
                        <td>
                            <a href="<?= site_url('phase/edit/' . $phase->phaseID) ?>">Edit</a> |
                            <a href="<?= site_url('phase/delete/' . $phase->phaseID) ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
