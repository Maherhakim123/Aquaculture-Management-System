<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Phase Details</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
    <div class="content p-3">
      <div class="container">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <h3 class="card-title">Activities Progress</h3>
          </div>
          <div class="card-body">
            <!-- export to excel -->
            <button class="btn btn-success mb-3" onclick="exportTableToExcel('activityTable', 'activities_progress')">
              <i class="fas fa-file-excel"></i> Export to Excel
            </button>
            <!-- export to pdf -->
            <button class="btn btn-danger mb-3 ms-2" onclick="exportTableToPDF()">
              <i class="fas fa-file-pdf"></i> Export to PDF
            </button>

            <table id="activityTable" class="table table-bordered table-striped">
              <thead class="thead-dark">
                <tr>
                  <th>Phase</th>
                  <th>Activity</th>
                  <th>Comment</th>
                  <!-- <th>Approved Budget</th> -->

                </tr>
              </thead>

               <tbody>
                <!-- Phase  -->
                <?php foreach ($progressData as $entry): ?>
                  <?php 
                    $activities = $entry['activities']; 
                    $activityCount = count($activities);
                    $rowIndex = 0;
                  ?>
                  <?php foreach ($activities as $activity): ?>
                    <tr>
                      <?php if ($rowIndex === 0): ?>
                        <td rowspan="<?= $activityCount ?>">
                          <?= htmlspecialchars($entry['phase']->phaseName) ?>
                        </td>
                      <?php endif; ?>

                      <!-- Activity -->
                    <td>
              <?= htmlspecialchars($activity['activityType'] . ' - ' . $activity['activityName']) ?><br>
                  <!-- Checkbox (Mark As Complete) -->
              <label class="mt-2">
                <input 
                  type="checkbox" 
                  class="activity-checkbox" 
                  data-activity-id="<?= $activity['activityID'] ?>"
                  <?= !empty($activity['progress']) && $activity['progress'] ? 'checked' : '' ?>
                > Mark as Complete
              </label>
              <br>
               <a href="<?= base_url('activity/view_conversation/' . $activity['activityID']) ?>" class="btn btn-sm btn-info">Messages</a>
            </td>

          <!-- Comments-->
         <td>
  <?php if (!empty($activity['comments'])): ?>
    <?php foreach ($activity['comments'] as $comment): ?>
      <div style="margin-bottom: 10px;">
        <strong><?= htmlspecialchars($comment['username']) ?>:</strong> 
        <?= htmlspecialchars($comment['comment']) ?><br>
        <small class="text-muted">(<?= $comment['created_at'] ?>)</small>
        <div><strong>Spending:</strong> RM <?= number_format($comment['spending'], 2) ?></div> <br>
        <div>
  <input  type="checkbox"  class="budget-approved-checkbox"   id="budget-<?= $comment['commentID'] ?>"  data-comment-id="<?= $comment['commentID'] ?>"
  
    <?= $comment['approvalStatus'] === 'approved' ? 'checked' : '' ?>>
  <label for="budget-<?= $comment['commentID'] ?>">Approved</label>

  <!-- Delete Comment -->
  <form method="post" class="delete-btn" action="<?= site_url('phase/delete_comment_progress/' .  $comment['commentID'] . '/' . $activity['activityID']) ?>"
                          onsubmit="return confirm('Are you sure you want to delete this comment?');">
                      <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </form>

</div>
    <hr>
    </div>
    <?php endforeach; ?>
  <?php else: ?>
    <em>No comments</em>
  <?php endif; ?>
</td> 
        </td>

                    </tr>
                    <?php $rowIndex++; ?>
                  <?php endforeach; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
       </div>

            <div class="card-footer">
                <a href="<?= site_url('project/view/'.$projectID) ?>" class="btn btn-secondary">Back to Project</a>
            </div>
            
        </div>
      </div>
    </div>
  </div>


<!-- Optional: Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<!-- export into excel file .xlsx -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<!-- jsPDF and html2canvas for PDF export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
  // export excel function
function exportTableToExcel(tableID, filename = '') {
    const table = document.getElementById(tableID);
    const wb = XLSX.utils.table_to_book(table, { sheet: "Sheet1" });
    XLSX.writeFile(wb, filename ? filename + ".xlsx" : "export.xlsx");
}
 
  // export pdf function
async function exportTableToPDF() {
    const table = document.getElementById("activityTable");

    // Wrap table in a container for better rendering
    const container = document.createElement("div");
    container.appendChild(table.cloneNode(true));
    document.body.appendChild(container);

    const canvas = await html2canvas(container, { scale: 2 });
    const imgData = canvas.toDataURL("image/png");

    const { jsPDF } = window.jspdf;
    const pdf = new jsPDF("l", "mm", "a4");
    const imgProps = pdf.getImageProperties(imgData);
    const pdfWidth = pdf.internal.pageSize.getWidth();
    const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

    pdf.addImage(imgData, "PNG", 0, 10, pdfWidth, pdfHeight);
    pdf.save("activities_progress.pdf");

    document.body.removeChild(container); // Clean up
}
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.phase-complete-checkbox').change(function() {
        const checkbox = $(this);
        const phaseID = checkbox.data('phase-id');
        const isChecked = checkbox.is(':checked') ? 1 : 0;

        $.ajax({
            url: '<?= site_url("phase/update_completion_status") ?>',
            method: 'POST',
            data: {
                phaseID: phaseID,
                is_completed: isChecked
            },
            success: function(response) {
                console.log("Updated successfully");
            },
            error: function() {
                alert("Failed to update phase status.");
            }
        });
    });
});
</script>

<script>
  document.querySelectorAll('.activity-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
      const activityId = this.dataset.activityId;
      const isChecked = this.checked ? 1 : 0;

      fetch("<?= site_url('activity/update_progress') ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `activityID=${encodeURIComponent(activityId)}&progress=${isChecked}`
      })
      .then(response => response.json())
      .then(data => {
        if (data.status !== 'success') {
          alert('Failed to update progress.');
          // Optionally revert checkbox state
          this.checked = !isChecked;
        }
      })
      .catch(() => {
        alert('Error updating progress.');
        this.checked = !isChecked;
      });
    });
  });



// document.querySelectorAll('.budget-approved-checkbox').forEach(checkbox => {
//   checkbox.addEventListener('change', function() {
//     const commentId = this.dataset.commentId;
//     const isChecked = this.checked ? 1 : 0;

//     fetch("<?= site_url('activity/update_budget_approval') ?>", {
//       method: "POST",
//       headers: {
//         "Content-Type": "application/x-www-form-urlencoded"
//       },
//       body: `commentID=${encodeURIComponent(commentId)}&budget_approved=${isChecked}`
//     })
//     .then(response => response.json())
//     .then(data => {
//       if (data.status !== 'success') {
//         alert('Failed to update approval.');
//       }
//     })
//     .catch(() => {
//       alert('Error updating approval.');
//     });
//   });
// });

document.addEventListener('change', function(e) {
  if (e.target.classList.contains('budget-approved-checkbox')) {
    const commentId = e.target.dataset.commentId;
    const isChecked = e.target.checked ? 1 : 0;

    fetch("<?= site_url('activity/update_budget_approval') ?>", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded"
      },
      body: `commentID=${encodeURIComponent(commentId)}&budget_approved=${isChecked}`
    })
    .then(response => response.json())
    .then(data => {
      if (data.status !== 'success') {
        alert('Failed to update approval.');
      }
    })
    .catch(() => {
      alert('Error updating approval.');
    });
  }
});







  document.querySelectorAll('.spending-input').forEach(input => {
  input.addEventListener('change', function() {
    const activityId = this.dataset.activityId;
    const spendingValue = this.value;

    fetch("<?= site_url('activity/update_spending') ?>", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded"
      },
      body: `activityID=${encodeURIComponent(activityId)}&spending=${encodeURIComponent(spendingValue)}`
    })
    .then(response => response.json())
    .then(data => {
      if (data.status !== 'success') {
        alert('Failed to update spending.');
      }
    })
    .catch(() => {
      alert('Error updating spending.');
    });
  });
});



document.querySelectorAll('.budget-approved-checkbox').forEach(checkbox => {
  checkbox.addEventListener('change', function() {
    const commentId = this.dataset.commentId;
    const isChecked = this.checked ? 1 : 0;

    // Disable checkbox during update to avoid rapid clicks
    this.disabled = true;

    fetch("<?= site_url('activity/update_budget_approval') ?>", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded"
      },
      body: `commentID=${encodeURIComponent(commentId)}&budget_approved=${isChecked}`
    })
    .then(response => response.json())
    .then(data => {
      if (data.status !== 'success') {
        alert('Failed to update approval.');
        // revert checkbox on failure
        this.checked = !isChecked;
      }
      this.disabled = false;
    })
    .catch(() => {
      alert('Error updating approval.');
      this.checked = !isChecked;
      this.disabled = false;
    });
  });
});


</script>





</body>
</html>
