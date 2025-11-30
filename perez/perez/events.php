<?php 
include "config.php"; 
if (!isset($_SESSION['user'])) header("Location: login.php");

// ✅ Add event
if (isset($_POST['add'])) {
  $title   = $_POST['title'];
  $session = $_POST['session'];
  $date    = $_POST['date'];
  $time_in  = $_POST['time_in'];
  $time_out = $_POST['time_out'];

  $stmt = $conn->prepare("INSERT INTO events(title,session,event_date,time_in,time_out) VALUES(?,?,?,?,?)");
  $stmt->bind_param("sssss", $title, $session, $date, $time_in, $time_out);
  $stmt->execute();
  header("Location: events.php");
  exit;
}

// ✅ Delete event
if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  $conn->query("DELETE FROM attendance WHERE event_id=$id"); // delete linked attendance
  $conn->query("DELETE FROM events WHERE id=$id");           // delete event
  header("Location: events.php");
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Events</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <style>
    body { background: linear-gradient(135deg,#fbc2eb,#a6c1ee); min-height:100vh; display:flex; justify-content:center; align-items:flex-start; padding:40px 10px; font-family:'Poppins',sans-serif; }
    .events-card { background:#fff; border-radius:20px; box-shadow:0 8px 20px rgba(0,0,0,0.1); padding:30px; width:100%; max-width:1000px; }
    .events-card h2 { font-weight:600; margin-bottom:20px; color:#6a11cb; text-align:center; }
    .form-control { border-radius:12px; }
    .btn-custom { border-radius:12px; border:none; font-weight:500; transition:0.3s; }
    .btn-add { background:linear-gradient(135deg,#a1c4fd,#c2e9fb); color:#000; }
    .btn-add:hover { opacity:0.9; }
    .btn-delete { background:linear-gradient(135deg,#ff9a9e,#fad0c4); border:none; border-radius:10px; padding:4px 12px; font-size:14px; text-decoration:none; color:#000; }
    .btn-edit { background:linear-gradient(135deg,#a8edea,#fed6e3); border:none; border-radius:10px; padding:4px 12px; font-size:14px; text-decoration:none; color:#000; margin-right:5px; }
    th { background:#f8f0ff; color:#6a11cb; text-align:center; }
    td { vertical-align:middle; text-align:center; }
    .btn-back { border-radius:12px; background:#d1c4e9; color:#000; font-weight:500; margin-top:15px; text-decoration:none; padding:8px 16px; display:inline-block; }
    .btn-back:hover { background:#b39ddb; }
    @media print { .no-print { display:none!important; } body{background:#fff;} .events-card{box-shadow:none;border:none;} }
  </style>
</head>
<body>
  <div class="events-card">
    <h2>📅 Attendance Events</h2>
    
    <!-- Event Form -->
    <form method="post" class="mb-4 no-print row g-2">
      <div class="col-md-6">
        <input class="form-control mb-2" type="text" name="title" placeholder="🎉 Event Title" required>
      </div>
      <div class="col-md-6">
        <select class="form-control mb-2" name="session" required>
          <option value="">⏰ Select Session</option>
          <option value="Morning">🌅 Morning</option>
          <option value="Afternoon">🌇 Afternoon</option>
        </select>
      </div>
      <div class="col-md-4"><input class="form-control mb-2" type="date" name="date" required></div>
      <div class="col-md-4"><input class="form-control mb-2" type="time" name="time_in" required></div>
      <div class="col-md-4"><input class="form-control mb-2" type="time" name="time_out" required></div>
      <div class="col-12"><button class="btn btn-custom btn-add w-100" name="add">➕ Add Attendance Event</button></div>
    </form>

    <!-- Events Table -->
    <table class="table table-bordered align-middle">
      <tr>
        <th>Title</th>
        <th>Session</th>
        <th>Date</th>
        <th>Time In</th>
        <th>Time Out</th>
        <th class="no-print">Action</th>
      </tr>
      <?php
      $events = $conn->query("SELECT * FROM events ORDER BY event_date DESC");
      while($row = $events->fetch_assoc()):
      ?>
      <tr>
        <td><?= htmlspecialchars($row['title']); ?></td>
        <td><?= htmlspecialchars($row['session']); ?></td>
        <td><?= htmlspecialchars($row['event_date']); ?></td>
        <td><?= htmlspecialchars($row['time_in']); ?></td>
        <td><?= htmlspecialchars($row['time_out']); ?></td>
        <td class="no-print">
          <a href="edit_event.php?id=<?= $row['id']; ?>" class="btn btn-edit">✏️ Edit</a>
          <a href="events.php?delete=<?= $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this event?')">🗑 Delete</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </table>

    <!-- Back & Print -->
    <div class="text-center no-print">
      <a href="dashboard.php" class="btn-back">⬅ Back to Dashboard</a>
      <button onclick="window.print()" class="btn btn-secondary ms-2">🖨 Print</button>
    </div>
  </div>
</body>
</html>
