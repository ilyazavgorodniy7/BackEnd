<header class="header_l">
 <link rel="stylesheet" href="style.css" type="text/css">
</header>
<?php
header('Content-Type: text/html; charset=UTF-8');
<body>
session_start();
if (!empty($_SESSION['login'])) {
  header('Location: ./');
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
?>

<form action="" method="post">
  <input name="login" />
  <input name="pass" />
  <input type="submit" value="Войти" />
</form>

<?php
}
else {
  $_SESSION['login'] = $_POST['login'];
  $_SESSION['uid'] = 123;
  header('Location: ./');
}
</body>
