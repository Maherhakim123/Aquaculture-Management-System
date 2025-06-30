<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Project List</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/template/plugins/fontawesome-free/css/all.min.css'); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/template/dist/css/adminlte.min.css'); ?>">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body>

<div class="content-wrapper">
  <div class="container-fluid p-3">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card shadow">
          <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">Project List</h2>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover">
                <thead class="table-primary text-center">
                  <tr class="align-middle">
                    <th>#</th>
                    <th>Project Name</th>
                    <th>Location</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Budget</th>
                    <th>Budget Source</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($projects)) { ?>
                    <?php foreach ($projects as $index => $project) { ?>
                      <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td class="text-nowrap"><?php echo $project->projectName; ?></td>
                        <td class="text-nowrap"><?php echo $project->projectLocation; ?></td>
                        <td><?php echo date('d M Y', strtotime($project->startDate)); ?></td>
                        <td><?php echo date('d M Y', strtotime($project->endDate)); ?></td>
                        <td class="text-nowrap">RM<?php echo $project->budget; ?></td>
                        <td><?php echo $project->budgetSource; ?></td>
                        <td class="text-center text-nowrap">
                          <form action="<?php echo site_url('project/view'); ?>" method="post" style="display:inline;">
                            <input type="hidden" name="projectID" value="<?php echo $project->projectID; ?>">
                            <button type="submit" class="btn btn-success btn-sm mb-1">View</button>
                          </form>
                          <form action="<?php echo site_url('project/edit'); ?>" method="post" style="display:inline;">
                            <input type="hidden" name="projectID" value="<?php echo $project->projectID; ?>">
                            <button type="submit" class="btn btn-warning btn-sm mb-1">Edit</button>
                          </form>
                          <a href="<?php echo site_url('project/delete/'.$project->projectID); ?>" class="btn btn-danger btn-sm mb-1"
                             onclick="return confirm('Are you sure you want to delete this project?');">Delete</a>
                        </td>
                      </tr>
                    <?php } ?>
                  <?php } else { ?>
                    <tr>
                      <td colspan="8" class="text-center">No projects found.</td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div> <!-- /.table-responsive -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
