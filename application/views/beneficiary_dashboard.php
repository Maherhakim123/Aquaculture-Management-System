<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
    <div class="content-header">
      <div class="container-fluid">
    


<!-- Main content -->
<section class="content">
      <div class="container-fluid">

 <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12">
            <!-- small box 1 -->
            <div class="small-box bg-info">
              <div class="inner">
              <h3><?php echo $project_count; ?></h3>

                <p>My Projects</p>
              </div>
            
            </div>
          </div>

        <div class="col-12">
  <div class="card">
    <div class="card-header bg-primary text-white">
      <h3 class="card-title">Projects</h3>
    </div>
    <div class="card-body">
      <?php if (!empty($projects)): ?>
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead class="table-primary text-center">
            <!-- <thead class="thead-dark"> -->
              <tr>
                <th>Project Name</th>
                <th>Project By</th>
                <th style="width: 120px;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($projects as $project): ?>
                <tr>
                  <td><?= $project->projectName ?></td>
                  <td><?= $project->userName ?? 'N/A' ?></td>
                  <td class="text-center">
                    <a href="<?= base_url('project/community_view/' . $project->projectID) ?>" class="btn btn-sm btn-info">View </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <p>No projects found.</p>
      <?php endif; ?>
    </div>
  </div>
</div>

       

        </div>
    </div>

</section>
 </div>


 </div>
  </div>



    
</body>
</html>
