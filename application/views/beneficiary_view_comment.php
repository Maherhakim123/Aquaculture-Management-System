<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Comment Conversation</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/template/plugins/fontawesome-free/css/all.min.css'); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- AdminLTE -->
  <link rel="stylesheet" href="<?php echo base_url('assets/template/dist/css/adminlte.min.css'); ?>">
  <!-- Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/template/plugins/bootstrap/css/bootstrap.min.css'); ?>">
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <style>
    .chat-container {
      padding: 20px;
      max-height: 65vh;
      overflow-y: auto;
      background-color: #f4f6f9;
    }

    .chat-bubble {
      max-width: 70%;
      padding: 15px 20px;
      border-radius: 20px;
      margin-bottom: 15px;
      position: relative;
      clear: both;
      word-wrap: break-word;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      animation: fadeIn 0.3s ease-in;
    }

    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(10px);}
      to {opacity: 1; transform: translateY(0);}
    }

    .chat-bubble.sent {
      background-color: #d4edda;
      margin-right: auto;
      border-bottom-left-radius: 0;
    }

    .chat-bubble.received {
      background-color: #cce5ff;
      margin-left: auto;
      border-bottom-right-radius: 0;
    }

    .chat-bubble .user {
      font-weight: bold;
      margin-bottom: 5px;
    }

    .chat-bubble .timestamp {
      font-size: 0.8rem;
      color: #666;
      margin-top: 10px;
      display: block;
    }

    .chat-bubble .spending {
      color: #28a745;
      font-size: 0.9em;
      font-weight: 500;
      margin-top: 6px;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <div class="content-wrapper">
    <div class="content py-4">
      <div class="container">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">Comment Conversation</h3>
          </div>

          <div class="card-body position-relative" style="min-height: 400px;">
            <div class="chat-container">
              <h5 class="text-center mb-4">Conversation for Activity: <?php echo htmlspecialchars($activity->activityName); ?></h5>

              <?php if (!empty($comments)) { ?>
                <?php foreach ($comments as $comment) { ?>
                  <?php
                    $isSender = $comment->userID == $this->session->userdata('userID');
                    $bubbleClass = $isSender ? 'sent' : 'received';
                    ?>
                  <div class="chat-bubble <?php echo $bubbleClass; ?>">
                    <div class="user"><?php echo htmlspecialchars($comment->username); ?></div>
                    <div><?php echo nl2br(htmlspecialchars($comment->comment)); ?></div>
                    <?php if (!empty($comment->spending)) { ?>
                      <div class="spending">Spending: RM <?php echo number_format($comment->spending, 2); ?></div>
                    <?php } ?>
                    <span class="timestamp"><?php echo date('d M Y h:i A', strtotime($comment->created_at)); ?></span>
                  </div>
                <?php } ?>
              <?php } else { ?>
                <div class="alert alert-info text-center">No comments yet.</div>
              <?php } ?>

            </div>
          </div>
        </div>
        <div class="card-footer">
            <form method="post" action="<?php echo site_url('project/community_view'); ?>">
            <input type="hidden" name="projectID" value="<?php echo htmlspecialchars($projectID); ?>">
            <button type="submit" class="btn btn-secondary">Back to Project</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const container = document.querySelector('.chat-container');
    if (container) {
      container.scrollTop = container.scrollHeight;
    }
  });
</script>

<!-- JS Scripts -->
<script src="<?php echo base_url('assets/template/plugins/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/template/dist/js/adminlte.min.js'); ?>"></script>
</body>
</html>