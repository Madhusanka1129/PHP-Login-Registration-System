<?php
session_start();

$name = $_SESSION['user'] ?? null;
$alerts = $_SESSION['alerts'] ?? [];
$active_from = $_SESSION['active_from'] ?? 'login';

// Unset only alerts and form state, NOT full session
unset($_SESSION['alerts'], $_SESSION['active_from']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login & Register</title>
  <link rel="stylesheet" href="style.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

  <header>
    <a href="#" class="logo">Logo</a>
    <nav>
      <a href="#">Home</a>
      <a href="#">About</a>
      <a href="#">Services</a>
      <a href="#">Contact</a>
    </nav>
    <div class="user-auth">
      <?php if (!empty($name)) : ?>
        <div class="profile-box">
          <div class="avatar-circle"><?= strtoupper($name[0]); ?></div>
          <div class="dropdown">
            <a href="#">My Account</a>
            <a href="logout.php">Logout</a>
          </div>
        </div>
      <?php else : ?>
        <button type="button" class="login-btn-modal">Login</button>
      <?php endif; ?>
    </div>
  </header>

  <section>
    <h1>Hey <?= htmlspecialchars($name ?? 'developer'); ?>!</h1>
  </section>

  <?php if (!empty($alerts)) : ?>
    <div class="alter-box">
      <?php foreach ($alerts as $alert) : ?>
        <div class="alter <?= $alert['type']; ?>">
          <i class='bx <?= $alert['type'] === 'success' ? 'bxs-check-circle' : 'bxs-error'; ?>'></i>
          <span><?= htmlspecialchars($alert['message']); ?></span>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <div class="auth-modal <?= $active_from === 'register' ? 'show slide' : ($active_from === 'login' ? 'show' : ''); ?>">
    <button type="button" class="close-btn-modal"><i class='bx bxs-x'></i></button>

    <div class="form-box login">
      <h2>Login</h2>
      <form action="auth_process.php" method="post">
        <div class="input-box">
          <input type="email" name="email" placeholder="Email" required>
          <i class='bx bxs-envelope'></i>
        </div>
        <div class="input-box">
          <input type="password" name="password" placeholder="Password" required>
          <i class='bx bxs-lock-keyhole'></i>
        </div>
        <button type="submit" name="login_btn" class="btn">Login</button>
        <p>Don't have an account? <a href="#" class="register-link">Register</a></p>
      </form>
    </div>

    <div class="form-box register">
      <h2>Register</h2>
      <form action="auth_process.php" method="POST">
        <div class="input-box">
          <input type="text" name="name" placeholder="Name" required>
          <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
          <input type="email" name="email" placeholder="Email" required>
          <i class='bx bxs-envelope'></i>
        </div>
        <div class="input-box">
          <input type="password" name="password" placeholder="Password" required>
          <i class='bx bxs-lock-keyhole'></i>
        </div>
        <button type="submit" name="register_btn" class="btn">Register</button>
        <p>Already have an account? <a href="#" class="login-link">Login</a></p>
      </form>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>
