<?php
include "config.php";
if (!isset($_SESSION['user'])) header("Location: login.php");

// Fetch current user data
$user_id = $_SESSION['user']['id'];
$query = $conn->query("SELECT * FROM users WHERE id = $user_id");
$user = $query->fetch_assoc();

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $age = (int) $_POST['age'];
    $gender = $conn->real_escape_string($_POST['gender']);
    $address = $conn->real_escape_string($_POST['address']);
    $contact = $conn->real_escape_string($_POST['contact']);

    // Profile picture upload
    $profile_pic = $user['profile_pic']; // existing picture
    if (!empty($_FILES['profile_pic']['name'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir); // make uploads folder if not exists
        $fileName = time() . "_" . basename($_FILES['profile_pic']['name']);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $targetFile)) {
            $profile_pic = $targetFile;
        }
    }

    $sql = "UPDATE users SET 
                name='$name', 
                email='$email', 
                age='$age', 
                gender='$gender', 
                address='$address', 
                contact='$contact',
                profile_pic='$profile_pic'
            WHERE id=$user_id";

    if ($conn->query($sql)) {
        // Update session values
        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['age'] = $age;
        $_SESSION['user']['gender'] = $gender;
        $_SESSION['user']['address'] = $address;
        $_SESSION['user']['contact'] = $contact;
        $_SESSION['user']['profile_pic'] = $profile_pic;

        header("Location: profile.php?success=1");
        exit;
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Profile</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <style>
    body {
      background: linear-gradient(135deg, #a6c1ee, #fbc2eb);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Poppins', sans-serif;
    }
    .edit-card {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
      padding: 30px;
      width: 100%;
      max-width: 500px;
    }
    .edit-card h2 {
      text-align: center;
      font-weight: 600;
      color: #6a11cb;
      margin-bottom: 20px;
    }
    .btn-custom {
      width: 100%;
      border-radius: 12px;
      background: linear-gradient(135deg, #a1c4fd, #c2e9fb);
      color: #000;
      font-weight: 500;
      border: none;
      padding: 10px;
      margin-top: 10px;
      transition: 0.3s;
    }
    .btn-custom:hover { opacity: 0.9; }
  </style>
</head>
<body>
  <div class="edit-card">
    <h2>✏️ Edit Profile</h2>
    <form method="POST" enctype="multipart/form-data">
      <!-- Profile Picture Preview -->
      <div class="text-center mb-3">
        <img src="<?= !empty($user['profile_pic']) ? $user['profile_pic'] : 'default.png'; ?>" 
             alt="Profile Picture" 
             style="width:120px; height:120px; border-radius:50%; object-fit:cover; border:3px solid #a6c1ee;">
      </div>

      <div class="mb-3">
        <label class="form-label">Change Profile Picture</label>
        <input type="file" name="profile_pic" class="form-control">
      </div>

      <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" value="<?= htmlspecialchars($user['name']); ?>" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Age</label>
        <input type="number" name="age" value="<?= htmlspecialchars($user['age']); ?>" class="form-control">
      </div>
      <div class="mb-3">
        <label class="form-label">Gender</label>
        <select name="gender" class="form-select">
          <option value="">Select</option>
          <option value="Male" <?= $user['gender']=='Male' ? 'selected' : ''; ?>>Male</option>
          <option value="Female" <?= $user['gender']=='Female' ? 'selected' : ''; ?>>Female</option>
          <option value="Other" <?= $user['gender']=='Other' ? 'selected' : ''; ?>>Other</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Address</label>
        <input type="text" name="address" value="<?= htmlspecialchars($user['address']); ?>" class="form-control">
      </div>
      <div class="mb-3">
        <label class="form-label">Contact</label>
        <input type="text" name="contact" value="<?= htmlspecialchars($user['contact']); ?>" class="form-control">
      </div>
      <button type="submit" class="btn-custom">💾 Save Changes</button>
      <a href="profile.php" class="btn btn-secondary w-100 mt-2">⬅ Cancel</a>
    </form>
  </div>
</body>
</html>
