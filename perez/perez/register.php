<?php include "config.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
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
    .register-card {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      padding: 30px;
      width: 100%;
      max-width: 450px;
      text-align: center;
    }
    .register-card h4 {
      font-weight: 600;
      margin-bottom: 20px;
      color: #6a11cb;
      font-size: 22px;
    }
    .form-control, .form-select {
      border-radius: 12px;
    }
    .btn-custom {
      background: linear-gradient(135deg, #ff9a9e, #fad0c4);
      border: none;
      border-radius: 12px;
      font-weight: 500;
      transition: 0.3s;
    }
    .btn-custom:hover {
      opacity: 0.9;
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
  <div class="register-card">
    <h4>✨ Student Register ✨</h4>
    <form method="post">
      <input class="form-control mb-3" type="text" name="name" placeholder="👤 Full Name" required>
      <input class="form-control mb-3" type="email" name="email" placeholder="📧 Email" required>
      <input class="form-control mb-3" type="password" name="password" placeholder="🔑 Password" required>
      <input class="form-control mb-3" type="number" name="age" placeholder="🎂 Age" required>
      <select class="form-select mb-3" name="gender" required>
        <option value="" disabled selected>⚧ Select Gender</option>
        <option value="Male">♂ Male</option>
        <option value="Female">♀ Female</option>
        <option value="Other">⚧ Other</option>
      </select>
      <input class="form-control mb-3" type="text" name="address" placeholder="🏠 Address" required>
      <input class="form-control mb-3" type="text" name="contact" placeholder="📞 Contact Number" required>
      <button class="btn btn-custom w-100 mb-2" name="register">Register</button>
      <a href="login.php" class="btn-link">Already have an account? Login</a>
    </form>
  </div>
</body>
</html>

<?php
if (isset($_POST['register'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $age = $_POST['age'];
  $gender = $_POST['gender'];
  $address = $_POST['address'];
  $contact = $_POST['contact'];

  $stmt = $conn->prepare("INSERT INTO users(name,email,password,age,gender,address,contact) VALUES(?,?,?,?,?,?,?)");
  $stmt->bind_param("sssisss", $name, $email, $password, $age, $gender, $address, $contact);

  if ($stmt->execute()) {
    echo "<div class='alert alert-success text-center mt-3'>
            Registered! 🎉 <a href='login.php'>Login now</a>
          </div>";
  } else {
    echo "<div class='alert alert-danger text-center mt-3'>Error: ".$conn->error."</div>";
  }
}
?>
