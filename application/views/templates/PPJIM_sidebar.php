<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">AQUACULTURE REPORTING SYSTEM</a>
      </li>
    </ul>

                                        
  <div class="dropdown ml-auto">
    <span class="text-muted mr-3">
      <strong><?php echo ucfirst($this->session->userdata('userRole')); ?></strong>
    </span>
  <button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" style="border: none; padding: 0;">
    <i class="fas fa-user-circle" style="font-size: 40px; color: grey;"></i>
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#" onclick="confirmLogout(event)">Log Out</a>
    </div>
</div>

<script>
  function confirmLogout(event) {
    event.preventDefault(); // Prevents the default action of the link
    const confirmation = confirm("Are you sure you want to log out?");
    
    if (confirmation) {
      // Redirect to the log out URL if confirmed
      window.location.href = "<?php echo base_url('dashboard/homepage'); ?>";
    }
  }
</script>







 </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 position-fixed">
    <!-- Sidebar -->
    <div class="sidebar">
 
     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
              <a href="<?php echo base_url('dashboard/PPJIM_dashboard'); ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
               Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
             <a href="<?php echo base_url('project/listAll_Project'); ?>"  class="nav-link" >
                  <i class="nav-icon fas fa-file"></i>
                  <p>List Project</p>
                </a>
          </li>


          <li class="nav-item">
            <a href="<?php echo base_url('dashboard/list_users'); ?>"  class="nav-link" >
                <i class="nav-icon fas fa-user"></i>
              <p>
                Users
              </p>
            </a>
          </li>
            </ul>
          </li>
        </ul>

        
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>



    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">