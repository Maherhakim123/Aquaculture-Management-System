<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Record</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/template/dist/css/adminlte.min.css') ?>">
</head>
<body>

<div class="content-wrapper">
    <div class="container p-3">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>ADD NEW RECORD</h2>
                    </div>
                    <div class="card-body">
                        <form action="<?= site_url('record/store') ?>" method="post">
                            <div class="mb-2">
                                <label for="quantity" class="form-label">Quantity:</label>
                                <input type="number" id="quantity" name="quantity" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label for="recordDate" class="form-label">Record Date:</label>
                                <input type="date" id="recordDate" name="recordDate" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label for="incomeGenerated" class="form-label">Income Generated (RM):</label>
                                <input type="number" id="incomeGenerated" name="incomeGenerated" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label for="situation" class="form-label">Situation:</label>
                                <input type="text" id="situation" name="situation" class="form-control" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Save</button>
                            </div>
                        </form>
                        <div class="mt-3 text-center">
                            <a href="<?= site_url('record') ?>" class="btn btn-secondary">Back to Records</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
