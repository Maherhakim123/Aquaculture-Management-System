<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project</title>
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


<div class="content-wrapper">
<div class="container p-3">
    <div class="row justify-content-center">
    <div class="col-md-12">
    <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h2>Project List</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>Project</th>
                                <th>Project Name</th>
                                <th>Location</th>
                                <th style="width: 105px;">Start Date</th>
                                <th style="width: 105px;">End Date</th>
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
                                        <td><?= date('d M Y', strtotime($project->startDate)); ?></td>
                                        <td><?= date('d M Y', strtotime($project->endDate)); ?></td>                         
                                        <td>RM<?php echo ($project->budget); ?></td>
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
