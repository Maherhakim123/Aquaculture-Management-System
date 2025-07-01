<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Comment Conversation</title>
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

<!-- Replace your current <style> section with this one -->
<style>

    html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}

.wrapper {
  display: flex;
  flex-direction: column;
  height: 100%;
}

.content-wrapper {
  flex: 1;
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

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
    transition: all 0.3s ease;
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
    font-weight: 600;
    margin-bottom: 6px;
    color: #333;
  }

  .chat-bubble .timestamp {
    font-size: 0.8em;
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

  .delete-btn {
    position: absolute;
    top: 10px;
    right: 15px;
    opacity: 0.6;
    transition: opacity 0.2s ease;
  }

  .delete-btn:hover {
    opacity: 1;
  }

  .content-wrapper {
    padding-bottom: 90px;
  }

 .message-input-container {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  padding: 10px 15px;
  background-color: #fff;
  border-top: 1px solid #ccc;
  z-index: 100;
  display: flex;
  align-items: center;
}


  .message-input-container input[type="text"] {
    flex-grow: 1;
    padding: 10px 15px;
    font-size: 1rem;
    border-radius: 25px;
    border: 1px solid #ccc;
    margin-right: 10px;
    outline: none;
    transition: border 0.2s ease;
  }

  .message-input-container input[type="text"]:focus {
    border-color: #007bff;
  }

  .message-input-container button {
    background-color: #007bff;
    border: none;
    color: white;
    padding: 10px 16px;
    border-radius: 50%;
    cursor: pointer;
  }

  .message-input-container button:hover {
    background-color: #0056b3;
  }

  .message-input-container button i {
    font-size: 1.2rem;
  }

  @media (max-width: 576px) {
    .chat-bubble {
      max-width: 90%;
    }

    .message-input-container input[type="text"] {
      font-size: 0.9rem;
    }
  }
</style>

</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <div class="content-wrapper mt-3">

   <!-- Back to Progress Button -->  
      <form method="post" action="<?php echo site_url('phase/progress_by_project'); ?>">
            <input type="hidden" name="projectID" value="<?php echo htmlspecialchars($projectID); ?>">
            <button type="submit" class="btn btn-secondary"> <i class="fas fa-arrow-left"></i> Back to Progress</button>
      </form>

    <div class="content py-4">
      <div class="container">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">Messages</h3>
          </div>

          <div class="card-body position-relative" style="min-height: 400px;">
  <div class="chat-container pr-1" style="padding-bottom: 80px;">
            <h5 class="text-center mb-4">Conversation for Activity: <?php echo htmlspecialchars($activity->activityName); ?></h5>

            <?php if (!empty($comments)) { ?>
              <?php foreach ($comments as $comment) { ?>
                <?php
                  $isSender = $comment->userID == $this->session->userdata('userID');
                  $bubbleClass = $isSender ? 'sent' : 'received';  // <-- flipped
                  ?>
                <div class="chat-bubble <?php echo $bubbleClass; ?>">
                  <div class="user"><?php echo htmlspecialchars($comment->username); ?></div>
                  <div><?php echo nl2br(htmlspecialchars($comment->comment)); ?></div>
                  <?php if (!empty($comment->spending)) { ?>
                    <div class="spending">Spending: RM <?php echo number_format($comment->spending, 2); ?></div>
                  <?php } ?>
                  <span class="timestamp"><?php echo date('d M Y h:i A', strtotime($comment->created_at)); ?></span>

                  <?php if ($this->session->userdata('role') === 'leader' || $isSender) { ?>
                    <!-- <form method="post" class="delete-btn" action="<?php echo site_url('activity/delete_comment_messages/'.$comment->commentID.'/'.$activityID); ?>"
                          onsubmit="return confirm('Are you sure you want to delete this comment?');">
                      <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </form> -->

                    <form method="post" class="delete-btn" action="<?php echo site_url('activity/delete_comment_messages'); ?>">
  <input type="hidden" name="commentID" value="<?php echo $comment->commentID; ?>">
  <input type="hidden" name="activityID" value="<?php echo $activityID; ?>">
  <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this comment?');">
    <i class="fas fa-trash-alt"></i>
  </button>
</form>

                  <?php } ?>
                </div>
              <?php } ?>
            <?php } else { ?>
              <div class="alert alert-info text-center">No comments yet.</div>
            <?php } ?>

        <!-- Message input bar -->
        <form action="<?php echo base_url('activity/leader_add_comment'); ?>" method="post" class="message-input-container">
        <input type="hidden" name="activityID" value="<?php echo $activity->activityID; ?>">
        <input type="text" name="comment" placeholder="Type a message..." required>
        <button type="submit" title="Send"><i class="fas fa-paper-plane"></i></button>
        </form>

                </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function () {
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
