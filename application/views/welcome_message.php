<!-- <?php
defined('BASEPATH') or exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
		text-decoration: none;
	}

	a:hover {
		color: #97310e;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
		min-height: 96px;
	}

	p {
		margin: 0 0 10px;
		padding:0;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Welcome to !</h1>

	<div id="body">
		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

		<p>If you would like to edit this page you'll find it located at:</p>
		<code>application/views/welcome_message.php</code>

		<p>The corresponding controller for this page is found at:</p>
		<code>application/controllers/Welcome.php</code>

		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="userguide3/">User Guide</a>.</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>'.CI_VERSION.'</strong>' : ''; ?></p>
</div>

</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aquaculture | HomePage</title>

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/template/plugins/fontawesome-free/css/all.min.css'); ?>">

    <!-- AdminLTE (still used for grid/utilities) -->
    <link rel="stylesheet" href="<?php echo base_url('assets/template/dist/css/adminlte.min.css'); ?>">

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
            background: rgba(223, 218, 218, 0.56);
        }

        /* Glassy navbar */
        .navbar-glass{
            backdrop-filter: blur(10px);
            background:rgba(238, 235, 235, 0.56)!important;
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
        .hero {
            background: url('<?php echo base_url('assets/template/img/tolong-menolong.jpg'); ?>') center center / cover no-repeat;
            height: 60vh;
            min-height: 400px;
            position: relative;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
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
        <img src="<?php echo base_url('assets/template/img/UMT-logo.jpg'); ?>" alt="Logo" class="navbar-brand-logo mr-2" style="width: 35px;">
        <a class="navbar-brand font-weight-bold">Aquaculture Reporting System</a>
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
        <p class="lead mb-4">Track progress of projects, budget, and engage with the community.</p>
        <a href="<?php echo base_url('auth/register'); ?>" class="btn btn-info btn-lg mr-2 shadow">Get Started</a>
        <a href="<?php echo base_url('auth/login'); ?>" class="btn btn-outline-light btn-lg shadow">Log In</a>
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
                    <p class="card-text">Monitor project management progress in each phase and activity.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <i class="fas fa-user-alt fa-2x mb-3"></i>
                    <h5 class="card-title font-weight-bold">Community Project</h5>
                    <p class="card-text">Interaction real-time progress between project leader and beneficiary.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <i class="fas fa-dollar-sign fa-2x mb-3"></i>
                    <h5 class="card-title font-weight-bold">Budget Oversight</h5>
                    <p class="card-text">Track budget expenses and remaining funds to stay on target.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== Footer ===== -->
<footer class="text-center py-4 bg-light position-fixed bottom-0 w-100" style="background: rgba(223, 218, 218, 0.56);">
    <small>&copy;  Aquaculture Reporting System. All rights reserved.</small>
</footer>

<!-- ===== JS ===== -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>AOS.init({ once:true, duration:800 });</script>

</body>
</html>
