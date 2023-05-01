<?php
if($_SERVER['REQUEST_METHOD']=='GET'){
  $user = 'u52805';
  $pass = '5816061';
  $db = new PDO('mysql:host=localhost;dbname=u52805', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
  $pass_hash=array();
  try{
    $get=$db->prepare("select pass_user from admin where user=?");
    $get->execute(array('admin'));
  }
  catch(PDOException $e){
    print('Error: '.$e->getMessage());
  }
  //аутентификация
  if (empty($_SERVER['PHP_AUTH_USER']) ||
  empty($_SERVER['PHP_AUTH_PW']) ||
  $_SERVER['PHP_AUTH_USER'] != 'admin' ||
  $_SERVER['PHP_AUTH_PW'] != '1234') {
header('HTTP/1.1 401 Unauthorized');
header('WWW-Authenticate: Basic realm="My site"');
header('Content-Type: text/html; charset=UTF-8');
print '<h1>401 Требуется авторизация</h1>';
exit();
}
  if(!empty($_COOKIE['del'])){
    echo 'Пользователь '.$_COOKIE['del_user'].' был удалён <br>';
    setcookie('del','');
    setcookie('del_user','');
  }
  print('Вы успешно авторизовались и видите защищенные паролем данные. Также вы можете изменить данные или удалить пользователя');
  $users=array();
  $list_super_power=array();
  $sup_def=array('1','2','3');
  $super_power_count=array();
  try{
    $get=$db->prepare("select * from person");
    $get->execute();
    $inf=$get->fetchALL();
    $get2=$db->prepare("select person_id,power_id from super_power");
    $get2->execute();
    $inf2=$get2->fetchALL();
    $count=$db->prepare("select count(*) from super_power where power_id=?");
    foreach($sup_def as $pw){
      $i=0;
      $count->execute(array($pw));
      $super_power_count[]=$count->fetchAll()[$i][0];
      $i++;
    }
  }
  catch(PDOException $e){
    print('Error: '.$e->getMessage());
    exit();
  }
  $users=$inf;
  $list_super_power=$inf2;
  include('table.php');
}
else{
  
}
