<html>
<header>
  <link rel="stylesheet" href="style.css" type="text/css">
</header>
  <?php
  header('Content-Type: text/html; charset=UTF-8');
  session_start();
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_SESSION['login'])) {
    header('Location: index.php');
    }else{
  ?>
  <body>
    <form action="login.php" method="post">
      <br>Логин
      <input name="login" placeholder="login">
      Пароль
      <input name="password" type="password" placeholder="password">
      <input type="submit" value="Войти" />
    </form>
  </body>
</html>
<?php
  }
}
// Иначе, если запрос был методом POST, т.е. нужно сделать авторизацию с записью логина в сессию.
else {
  $login=$_POST['login'];
  $password=$_POST['password'];
  $uid=0;
  $error=TRUE;
  $user = 'u52805';
  $pass = '5816061';
  $db1 = new PDO('mysql:host=localhost;dbname=u52805', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
  if(!empty($login) and !empty($password)){
    try{
      $chk=$db1->prepare("SELECT * FROM user_info WHERE login=?");
      $chk->bindParam(1,$login);
      $chk->execute();
      $username=$chk->fetchALL();
	  print($username[0]['password']);
      if(password_verify($password,$username[0]['password'])){
        $uid=$username[0]['id'];
        $error=FALSE;
      }
    }
    catch(PDOException $e){
      print('Error : ' . $e->getMessage());
      exit();
    }
  }
  if($error==TRUE){
    print('<br>Неверный логин/пароль. <br> Создайте нового <a href="index.php" style="color:black;">пользователя</a> или попытайтесь <a href="login.php"style="color:black;">войти</a> снова');
    session_destroy();
    exit();
  }
  // Если все ок, то авторизуем пользователя.
  $_SESSION['login'] = $login;
  // Записываем ID пользователя.
  $_SESSION['uid'] = $uid;
  // Делаем перенаправление.
  header('Location: index.php');
}

