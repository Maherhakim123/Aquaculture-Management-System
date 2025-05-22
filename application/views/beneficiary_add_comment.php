<!-- beneficiary_add_comment.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Comment</title>
    <!-- Font Awesome & Bootstrap same as create_activity_record.php -->
    <link rel="stylesheet"
          href="<?= base_url('assets/template/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Add Comment</h4>
        </div>
        <div class="card-body">

            <!-- action → save_beneficiary_comment -->
            <form method="POST" action="<?= base_url('activity/save_beneficiary_comment') ?>">

                <!-- 1. hidden project -->
                <input type="hidden" name="projectID" value="<?= $projectID ?>">

                <!-- 2. choose phase (loaded for this project) -->
                <div class="form-group">
                    <label for="phaseID">Phase:</label>
                    <select name="phaseID" id="phaseID"
                            class="form-control" required>
                        <option value="">-- Select Phase --</option>
                        <?php foreach ($phases as $p): ?>
                            <option value="<?= $p->phaseID ?>"><?= $p->phaseName ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- 3. choose activity (populated by ajax when phase changes) -->
                <div class="form-group">
                    <label for="activityID">Activity:</label>
                    <select name="activityID" id="activityID"
                            class="form-control" required>
                        <option value="">-- Select Activity --</option>
                    </select>
                </div>

                <!-- 4. comment -->
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea name="comment" class="form-control"
                              rows="3" required></textarea>
                </div>

                <!-- 5. record date -->
                <!-- <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="recordDate"
                           class="form-control" required>
                </div> -->

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Submit Comment
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Ajax: when phase changes → fetch its activities -->
<script>
    document.getElementById('phaseID').addEventListener('change', function () {
        const phaseID = this.value;
        const url = "<?= base_url('activity/getActivitiesByPhase/') ?>" + phaseID;

        fetch(url)
            .then(resp => resp.json())
            .then(data => {
                const actSel = document.getElementById('activityID');
                actSel.innerHTML =
                    '<option value="">-- Select Activity --</option>';
                data.forEach(a => {
                    const opt = document.createElement('option');
                    opt.value = a.activityID;
                    opt.textContent =
                        `${a.activityType} - ${a.activityName} `;
                    actSel.appendChild(opt);
                });
            });
    });
</script>
</body>
</html>
