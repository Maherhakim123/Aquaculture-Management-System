<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aquaculture | HomePage</title>

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/fontawesome-free/css/all.min.css') ?>">

    <!-- AdminLTE (still used for grid/utilities) -->
    <link rel="stylesheet" href="<?= base_url('assets/template/dist/css/adminlte.min.css') ?>">

    <!-- AOS (Animate On Scroll) -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css"/>

    <style>
        :root{
            --accent-start:#0f9b8e;
            --accent-end:#43cea2;
        }
        body{
            font-family:'Poppins',sans-serif;
            scroll-behavior:smooth;
        }

        /* Glassy navbar */
        .navbar-glass{
            backdrop-filter: blur(10px);
            background:rgba(255,255,255,0.3)!important;
        }

        /* Gradient buttons */
        .btn-accent{
            background:linear-gradient(45deg,var(--accent-start),var(--accent-end));
            border:none;
            color:#fff;
        }
        .btn-accent:hover{
            opacity:0.9;
            color:#fff;
        }

        /* Hero section */
        .hero{
            background:url('<?= base_url('assets/img/hero-pond.jpg') ?>') center/cover;
            height:60vh;
            min-height:400px;
            position:relative;
            color:#fff;
        }
        .hero-overlay{
            position:absolute;
            inset:0;
            background:rgba(0,0,0,0.45);
        }
        .hero-content{
            position:relative;
            z-index:2;
        }
    </style>
</head>
<body>

<!-- ===== Navbar ===== -->
<nav class="navbar navbar-expand-lg navbar-light navbar-glass fixed-top shadow-sm">
    <div class="container">
        <a class="navbar-brand font-weight-bold">Aquaculture Management System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ml-auto">
                <!-- Add more links later if needed -->
            </ul>
        </div>
    </div>
</nav>

<!-- ===== Hero ===== -->
<header class="hero d-flex align-items-center">
    <span class="hero-overlay"></span>
    <div class="container text-center hero-content" data-aos="fade-zoom-in">
        <h1 class="display-4 font-weight-bold mb-3">Project Community Engagement</h1>
        <p class="lead mb-4">Track projects, monitor stock, and grow healthy yields—together.</p>
        <a href="<?= base_url('auth/register'); ?>" class="btn btn-accent btn-lg mr-2 shadow">Get Started</a>
        <a href="<?= base_url('auth/login'); ?>" class="btn btn-outline-light btn-lg shadow">Log In</a>
    </div>
</header>

<!-- ===== Feature Highlights ===== -->
<section class="container my-5">
    <div class="row text-center">
        <div class="col-md-4 mb-4" data-aos="fade-up">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <i class="fas fa-chart-line fa-2x mb-3"></i>
                    <h5 class="card-title font-weight-bold">Progress Tracking</h5>
                    <p class="card-text">Real‑time milestones and harvest data at a glance.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <i class="fas fa-fish fa-2x mb-3"></i>
                    <h5 class="card-title font-weight-bold">Species Records</h5>
                    <p class="card-text">Keep accurate logs for every fish or shrimp batch.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <i class="fas fa-dollar-sign fa-2x mb-3"></i>
                    <h5 class="card-title font-weight-bold">Budget Oversight</h5>
                    <p class="card-text">Monitor expenses and income to stay on target.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== Footer ===== -->
<footer class="text-center py-4 bg-light">
    <small>&copy; <?= date('Y') ?> Aquaculture Management System. All rights reserved.</small>
</footer>

<!-- ===== JS ===== -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>AOS.init({ once:true, duration:800 });</script>

</body>
</html>
