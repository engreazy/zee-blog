<!DOCTYPE html>
<html>
<head>

  <title><?=$title?></title>
  <meta charset="utf-8">
  <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
  <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
<header>
  <nav class="nav">
    <ul>
      <li><a href="?route=zee/home">Zee Blog</a></li>
      <li><a href="?route=zee/home">Home</a></li>
      <li><a href="?route=article/blog">Blog</a></li>
      <li><a href="?route=client/contact">Contact</a></li>
    <?php if(isset($_SESSION['firstname'])):?>
      <li><a href="?route=user/dashboard">Dashboard</a></li>
    <?php else: ?>
      <li><a href="?route=login">Login</a></li>
    <?php endif; ?>
    </ul>
  </nav>
</header>
<main class="main">
  <?=$output?>
</main>
<footer class="footer">
  <p><a href="#">Terms & Conditions </a>| <a href="#">Privacy Policy</a> &copy; <span id="year"></span> <a href="?route=zee/home"> zeeblog</a> | <a href="?route=client/contact">Contact</a></p>
<p>Designed by O.Israel a Test Project</p>
<script src="scripts/script.js"></script>
</footer>
</body>
</html>