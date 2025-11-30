<?php include "config.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <style>
    body {
      background: linear-gradient(135deg, #fbc2eb, #a6c1ee);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Poppins', sans-serif;
    }
    .login-card {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      padding: 30px;
      width: 100%;
      max-width: 400px;
      text-align: center;
    }
    .login-card h2 {
      font-weight: 600;
      margin-bottom: 20px;
      color: #6a11cb;
    }
    .form-control {
      border-radius: 12px;
    }
    .btn-custom {
      background: #6a11cb;
      background: linear-gradient(135deg, #ff9a9e, #fad0c4);
      border: none;
      border-radius: 12px;
      font-weight: 500;
      transition: 0.3s;
    }
    .btn-custom:hover {
      opacity: 0.85;
    }
    .btn-link {
      font-size: 14px;
      color: #6a11cb;
      text-decoration: none;
    }
    .btn-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-card">
    <h2>✨ Student Login ✨</h2>
    <form method="post">
      <input class="form-control mb-3" type="email" name="email" placeholder="📧 Email" required>
      <input class="form-control mb-3" type="password" name="password" placeholder="🔑 Password" required>
      <button class="btn btn-custom w-100 mb-2" name="login">Login</button>
      <a href="register.php" class="btn-link">Create an account</a>
    </form>
  </div>
</body>
</html>

<?php
if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $user = $stmt->get_result()->fetch_assoc();

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user'] = $user;
    header("Location: dashboard.php");
    exit();
  } else {
    echo "<div class='alert alert-danger text-center mt-3'>Invalid login</div>";
  }
}
?>
