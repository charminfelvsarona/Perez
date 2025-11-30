<?php 
include "config.php"; 
if (!isset($_SESSION['user'])) header("Location: login.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Profile</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <style>
    body {
      background: linear-gradient(135deg, #fbc2eb, #a6c1ee);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Poppins', sans-serif;
      margin: 0;
    }
    .profile-card {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
      padding: 40px 30px;
      width: 100%;
      max-width: 450px;
    }
    .profile-card h2 {
      font-weight: 600;
      margin-bottom: 25px;
      color: #6a11cb;
      text-align: center;
    }
    .profile-pic {
      width: 130px;
      height: 130px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid #a6c1ee;
      display: block;
      margin: 0 auto 20px auto;
    }
    .profile-info p {
      font-size: 15px;
      margin: 10px 0;
    }
    .profile-info b {
      color: #6a11cb;
      display: inline-block;
      width: 90px;
    }
    .btn-custom {
      display: block;
      width: 100%;
      border-radius: 12px;
      background: linear-gradient(135deg, #a1c4fd, #c2e9fb);
      color: #000;
      font-weight: 500;
      border: none;
      padding: 10px;
      text-align: center;
      margin-top: 10px;
      text-decoration: none;
      transition: 0.3s;
    }
    .btn-custom:hover {
      opacity: 0.9;
    }
  </style>
</head>
<body>
  <div class="profile-card">
    <h2>👤 My Profile</h2>

    <!-- Profile Picture -->
    <img class="profile-pic" src="<?= !empty($_SESSION['user']['profile_pic']) ? $_SESSION['user']['profile_pic'] : 'default.png'; ?>" alt="Profile Picture">
<a class="btn-custom" href="edit_profile.php">✏️ Edit Profile</a>

    <!-- Info -->
    <div class="profile-info mt-3">
      <p><b>Name:</b> <?= $_SESSION['user']['name']; ?></p>
      <p><b>Email:</b> <?= $_SESSION['user']['email']; ?></p>
      <p><b>Age:</b> <?= $_SESSION['user']['age'] ?? 'Not set'; ?></p>
      <p><b>Gender:</b> <?= $_SESSION['user']['gender'] ?? 'Not set'; ?></p>
      <p><b>Address:</b> <?= $_SESSION['user']['address'] ?? 'Not set'; ?></p>
      <p><b>Contact:</b> <?= $_SESSION['user']['contact'] ?? 'Not set'; ?></p>
    </div>

    <!-- Buttons -->
    <a class="btn-custom" href="dashboard.php">⬅ Back to Dashboard</a>
  </div>
</body>
</html>
