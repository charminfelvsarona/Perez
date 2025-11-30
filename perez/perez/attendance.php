<?php include "config.php"; if (!isset($_SESSION['user'])) header("Location: login.php");

if (isset($_GET['event_id'])) {
  $event_id = $_GET['event_id'];
  $user_id = $_SESSION['user']['id'];

  $stmt = $conn->prepare("INSERT INTO attendance(user_id,event_id) VALUES(?,?)");
  $stmt->bind_param("ii", $user_id, $event_id);
  if ($stmt->execute()) {
    echo "<div class='alert alert-success'>Attendance recorded!</div>";
  } else {
    echo "<div class='alert alert-danger'>Error!</div>";
  }
}
?>
<a href="events.php">Back to Events</a>
