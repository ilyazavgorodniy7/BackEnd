<header class="header_l">
 <link rel="stylesheet" href="style.css" type="text/css">
</header>

<?php
header('Content-Type: text/html; charset=UTF-8');

session_start();
if (!empty($_SESSION['login'])) {
  header('Location: ./form.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
?>
<body>
<form action="index.php" method="post">
  <input name="login" placeholder="login"/>
  <input name="password" placeholder="password"/>
  <input type="submit" value="Войти" />
</form>
</body>
<?php
}
else {
  $_SESSION['login'] = $_POST['login'];
  $_SESSION['user_id'] = $db->lastInsertId();
  header('Location: ./form.php');
}
