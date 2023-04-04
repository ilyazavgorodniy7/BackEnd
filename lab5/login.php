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
<form action="" method="post">
  <input name="login" />
  <input name="pass" />
  <input type="submit" value="Войти" />
</form>
</body>
<?php
}
else {
  $_SESSION['login'] = $_POST['login'];
  $_SESSION['uid'] = 123;
  header('Location: ./form.php');
}
