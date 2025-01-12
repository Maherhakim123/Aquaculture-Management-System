<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>


<div class="content-wrapper">
<div class="container mt-3">
    <div class="row justify-content-center">
    <div class="col-md-9">
    <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h2>Project List</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>#</th>
                                <th>Project Name</th>
                                <th>Location</th>
                                <th style="width: 100px;">Start Date</th>
                                <th style="width: 100px;">End Date</th>
                                <th>Budget</th>
                                <th>Budget Source</th>
                                <th style="width: 200px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($projects)): ?>
                                <?php foreach ($projects as $index => $project): ?>
                                    <tr>
                                        <td><?php echo $index + 1; ?></td>
                                        <td><?php echo ($project->projectName); ?></td>
                                        <td><?php echo ($project->projectLocation); ?></td>
                                        <td><?php echo ($project->startDate); ?></td>
                                        <td><?php echo ($project->endDate); ?></td>
                                        <td><?php echo ($project->budget); ?></td>
                                        <td><?php echo ($project->budgetSource); ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo site_url('project/view/' . $project->projectID); ?>" class="btn btn-success btn-sm">View</a>
                                            <a href="<?php echo site_url('project/edit/' . $project->projectID); ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="<?php echo site_url('project/delete/' . $project->projectID); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this project?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">No projects found.</td>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-Ym2G28oVuKMbcbUP46OEuEUmPO0IkUfyRfMkgL37dkwSfVP1GMv4VJkxjNhypGn4" crossorigin="anonymous"></script>
