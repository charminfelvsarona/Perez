<?php
include "config.php"; 
if (!isset($_SESSION['user'])) header("Location: login.php");

// ✅ Get event ID
if (!isset($_GET['id'])) {
  header("Location: events.php");
  exit;
}
$id = intval($_GET['id']);

// ✅ Fetch event details
$stmt = $conn->prepare("SELECT * FROM events WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$event = $result->fetch_assoc();

if (!$event) {
  echo "<div class='alert alert-danger'>Event not found.</div>";
  exit;
}

// ✅ Update event
if (isset($_POST['update'])) {
  $title   = $_POST['title'];
  $session = $_POST['session'];
  $date    = $_POST['date'];
  $time_in = $_POST['time_in'];
  $time_out= $_POST['time_out'];

  $stmt = $conn->prepare("UPDATE events SET title=?, session=?, event_date=?, time_in=?, time_out=? WHERE id=?");
  $stmt->bind_param("sssssi", $title, $session, $date, $time_in, $time_out, $id);
  if ($stmt->execute()) {
    header("Location: events.php");
    exit;
  } else {
    echo "<div class='alert alert-danger'>Error updating event: " . $stmt->error . "</div>";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Event</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <style>
    body { background: linear-gradient(135deg,#fbc2eb,#a6c1ee); min-height:100vh; display:flex; justify-content:center; align-items:center; font-family:'Poppins',sans-serif; }
    .edit-card { background:#fff; border-radius:20px; box-shadow:0 8px 20px rgba(0,0,0,0.1); padding:30px; width:100%; max-width:500px; }
    .edit-card h2 { text-align:center; margin-bottom:20px; color:#6a11cb; }
    .form-control { border-radius:12px; }
    .btn-custom { border-radius:12px; font-weight:500; }
    .btn-update { background:linear-gradient(135deg,#a1c4fd,#c2e9fb); border:none; color:#000; }
    .btn-update:hover { opacity:0.9; }
    .btn-back { margin-top:10px; display:block; text-align:center; text-decoration:none; color:#000; background:#d1c4e9; border-radius:12px; padding:10px; }
    .btn-back:hover { background:#b39ddb; }
  </style>
</head>
<body>
  <div class="edit-card">
    <h2>✏️ Edit Event</h2>
    <form method="post">
      <div class="mb-3">
        <label class="form-label">Event Title</label>
        <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($event['title']); ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Session</label>
        <select class="form-control" name="session" required>
          <option value="Morning" <?= ($event['session']=="Morning"?"selected":""); ?>>🌅 Morning</option>
          <option value="Afternoon" <?= ($event['session']=="Afternoon"?"selected":""); ?>>🌇 Afternoon</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Date</label>
        <input type="date" class="form-control" name="date" value="<?= $event['event_date']; ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Time In</label>
        <input type="time" class="form-control" name="time_in" value="<?= $event['time_in']; ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Time Out</label>
        <input type="time" class="form-control" name="time_out" value="<?= $event['time_out']; ?>" required>
      </div>
      <button type="submit" name="update" class="btn btn-custom btn-update w-100">💾 Update Event</button>
    </form>
    <a href="events.php" class="btn-back">⬅ Back to Events</a>
  </div>
</body>
</html>
