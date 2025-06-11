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
            <!-- small box 1 (List Project) -->
            <div class="small-box bg-info">
              <div class="inner">
              <h3><?php echo $project_count; ?></h3>

                <p>All Projects</p>
              </div>
              <div class="icon">
                <i class="ion ion-clipboard"></i>
              </div>
            </div>

             <!-- small box 2 (List User)-->
            <div class="small-box bg-success">
              <div class="inner">
              <h3><?php echo $project_count; ?></h3>

                <p>All Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
            </div>


          <!-- ./col -->
          </div>
    </div>
    </div>

</section>
 </div>


 </div>
  </div>



    
</body>
</html>
