<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 bg-light">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h5>Reset Your Password</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="" onsubmit="return showSuccessMessage()">
                        <div class="mb-3">
                            <label for="userPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" name="userPassword" id="userPassword" required />
                        </div>
                        <button type="submit" class="btn btn-success w-100">Update Password</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="<?= base_url('auth/login') ?>">Back to login</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function showSuccessMessage() {
    alert("Password updated successfully!");
    return true; // let the form continue submitting
}
</script>

</body>
</html>
