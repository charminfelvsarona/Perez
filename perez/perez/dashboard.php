<?php 
include "config.php"; 
if (!isset($_SESSION['user'])) header("Location: login.php"); 
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard | Student Event Attendance</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <style>
    body {
      background: linear-gradient(135deg, #fbc2eb, #a6c1ee);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      font-family: 'Poppins', sans-serif;
      padding: 30px;
    }
    .dashboard-container {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      padding: 30px;
      width: 100%;
      max-width: 1000px;
    }
    .dashboard-header {
      text-align: center;
      margin-bottom: 30px;
    }
    .dashboard-header h2 {
      font-weight: 700;
      color: #6a11cb;
      margin-bottom: 10px;
    }
    .btn-custom {
      border-radius: 12px;
      padding: 10px 20px;
      font-weight: 500;
      border: none;
      transition: 0.3s;
    }
    .btn-profile {
      background: linear-gradient(135deg, #a1c4fd, #c2e9fb);
      color: #000;
    }
    .btn-events {
      background: linear-gradient(135deg, #fddb92, #d1fdff);
      color: #000;
    }
    .btn-logout {
      background: linear-gradient(135deg, #ff9a9e, #fad0c4);
      color: #000;
    }
    .btn-custom:hover { opacity: 0.9; }

    /* Event cards */
    .event-card {
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 6px 16px rgba(0,0,0,0.1);
      transition: transform 0.2s;
    }
    .event-card:hover {
      transform: translateY(-5px);
    }
    .event-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }
    .event-card .card-body {
      text-align: center;
    }
    .event-card h5 {
      font-weight: 600;
      color: #333;
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <div class="dashboard-header">
      <h2>🌸 Welcome, <?= $_SESSION['user']['name']; ?>! 🌸</h2>
      <div class="d-flex justify-content-center gap-3 flex-wrap mt-3">
        <a class="btn btn-custom btn-profile" href="profile.php">👤 Profile</a>
        <a class="btn btn-custom btn-events" href="events.php">📅 Events</a>
        <a class="btn btn-custom btn-logout" href="logout.php">🚪 Logout</a>
      </div>
    </div>

    <h4 class="mb-3 text-center">📸 Student Events</h4>
    <div class="row g-4">
      <!-- Intramurals -->
      <div class="col-md-4">
        <div class="card event-card">
          <img src="https://calendarmedia.blob.core.windows.net/assets/667eeac6-fbcd-4702-8780-91e9f19a0629.jpg" alt="Intramurals">
          <div class="card-body">
            <h5>Intramurals</h5>
            <p>Annual sports fest where students compete in different games and activities.</p>
          </div>
        </div>
      </div>
      <!-- CCIS Day -->
      <div class="col-md-4">
        <div class="card event-card">
          <img src="https://scontent.fcgy2-3.fna.fbcdn.net/v/t39.30808-6/415016453_122100505826075983_3281088690009863371_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeHgCBZQznZazSZV69Fh3kcI2jT9qFIFc9PaNP2oUgVz0xlVbbooQ8vaBb9I56Povx4FdozxaDf4l5VKrq-QU5Qi&_nc_ohc=ykUIfZc5_14Q7kNvwGnzWod&_nc_oc=AdkYcMfbzLrxPYsr9aZBPfwmUfASw6-69Es6uBS7BTc6lo58oPEtD43wpCrbNqZrSsM&_nc_zt=23&_nc_ht=scontent.fcgy2-3.fna&_nc_gid=Mn7MPf_FfuKYFjvaztD5Mg&oh=00_AfcFkeJEQQURxoWa7wNZUiaUHRBZQswAstLi0-z90vU8Mg&oe=68FB6A7C" alt="CCIS Day">
          <div class="card-body">
            <h5>CCIS Day</h5>
            <p>A celebration of the College of Computing and Information Sciences with exhibits and contests.</p>
          </div>
        </div>
      </div>
      <!-- Seminar -->
      <div class="col-md-4">
        <div class="card event-card">
          <img src="https://members.atra.com/media/marketplace/techseminaricon.png" alt="Seminar">
          <div class="card-body">
            <h5>Tech Seminar</h5>
            <p>Workshops and talks from guest speakers about the latest in technology and innovation.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
