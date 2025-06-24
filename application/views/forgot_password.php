<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 bg-light">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <?php if ($this->session->flashdata('message')): ?>
                <div class="alert alert-success"><?= $this->session->flashdata('message') ?></div>
            <?php elseif ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('reset_link')): ?>
                <div class="alert alert-info text-center">
                    <strong>Password reset link generated!</strong><br>
                    <a href="<?= $this->session->flashdata('reset_link') ?>" class="btn btn-sm btn-outline-primary mt-2">Click to Reset Password</a>
                </div>
            <?php endif; ?>

            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h5>Forgot Password</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= base_url('auth/forgot_password') ?>">
                        <div class="mb-3">
                            <label for="email" class="form-label">Enter your email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Generate Reset Link</button>
                    </form>
                </div>
            </div>

            <div class="text-center mt-3">
                <a href="<?= base_url('auth/login') ?>">Back to login</a>
            </div>

        </div>
    </div>
</div>

</body>
</html>
