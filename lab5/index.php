<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
$bioreg = "/^\s*\w+[\w\s\.,-]*$/";
$reg = "/^\w+[\w\s-]*$/";
$mailreg = "/^[\w\.-]+@([\w-]+\.)+[\w-]{2,4}$/";
$list_abilities = array('1', '2', '3');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $messages = array();

  if (!empty($_COOKIE['save'])) {
    setcookie('save', '', 100000);
    setcookie('login', '', 100000);
    setcookie('password', '', 100000);
    $messages[] = 'Спасибо, результаты сохранены.';
    if (!empty($_COOKIE['password'])) {
      $messages[] = sprintf('<br> Вы можете <a href="login.php">войти</a> с логином <strong>%s</strong>
        и паролем <strong>%s</strong> для изменения данных.',
        strip_tags($_COOKIE['login']),
        strip_tags($_COOKIE['password'])
      );
    }
    setcookie('name_value', '', 100000);
    setcookie('email_value', '', 100000);
    setcookie('year_value', '', 100000);
    setcookie('gender_value', '', 100000);
    setcookie('count_limb_value', '', 100000);
    setcookie('biography_value', '', 100000);
    setcookie('1_value', '', 100000);
    setcookie('2_value', '', 100000);
    setcookie('3_value', '', 100000);
    setcookie('checked_value', '', 100000);
  }
  $errors = array();
  $errors['name'] = !empty($_COOKIE['name_error']);
  $errors['year'] = !empty($_COOKIE['year_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['gender'] = !empty($_COOKIE['gender_error']);
  $errors['count_limb'] = !empty($_COOKIE['count_limb_error']);
  $errors['biography'] = !empty($_COOKIE['biography_error']);
  $errors['checked'] = !empty($_COOKIE['checked_error']);
  $errors['super_power'] = !empty($_COOKIE['super_power_error']);


  if ($errors['name']) {
    setcookie('name_error', '', 100000);
    $messages[] = '<div class="error">Неправильная форма имени</div>';
  }
  if ($errors['year']) {
    setcookie('year_error', '', 100000);
    $messages[] = '<div class="error">Неправильная форма года</div>';
  }
  if ($errors['email']) {
    setcookie('email_error', '', 100000);
    $messages[] = '<div class="error">Неправильная форма email</div>';
  }
  if ($errors['gender']) {
    setcookie('gender_error', '', 100000);
    $messages[] = '<div class="error">Выберите пол</div>';
  }
  if ($errors['count_limb']) {
    setcookie('count_limb_error', '', 100000);
    $messages[] = '<div class="error">Выберите кол-во конечностей</div>';
  }
  if ($errors['biography']) {
    setcookie('biography_error', '', 100000);
    $messages[] = '<div class="error">Неправильная форма биографии</div>';
  }
  if ($errors['checked']) {
    setcookie('checked_error', '', 100000);
    $messages[] = '<div class="error">Примите согласие</div>';
  }
  if ($errors['super_power']) {
    setcookie('super_power_error', '', 100000);
    $messages[] = '<div class="error">Выберите суперсилу</div>';
  }

  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
  $values['year'] = empty($_COOKIE['year_value']) ? '' : $_COOKIE['year_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['gender'] = empty($_COOKIE['gender_value']) ? '' : $_COOKIE['gender_value'];
  $values['count_limb'] = empty($_COOKIE['count_limb_value']) ? '' : $_COOKIE['count_limb_value'];
  $values['biography'] = empty($_COOKIE['biography_value']) ? '' : $_COOKIE['biography_value'];
  $values['checked'] = empty($_COOKIE['checked_value']) ? '' : $_COOKIE['checked_value'];
  $values['1'] = empty($_COOKIE['1_value']) ? '' : $_COOKIE['1_value'];
  $values['2'] = empty($_COOKIE['2_value']) ? '' : $_COOKIE['2_value'];
  $values['3'] = empty($_COOKIE['3_value']) ? '' : $_COOKIE['3_value'];

  if (!empty($_COOKIE[session_name()]) && !empty($_SESSION['login'])) {
    $user = 'u52805';
    $pass = '5816061';
    $db = new PDO('mysql:host=localhost;dbname=u52805', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
    try {
      $get = $db->prepare("SELECT * FROM person WHERE id=?");
      $get->bindParam(1, $_SESSION['uid']);
      $get->execute();
      $inf = $get->fetchALL();
      $values['name'] = $inf[0]['name'];
      $values['email'] = $inf[0]['email'];
      $values['year'] = $inf[0]['year'];
      $values['gender'] = $inf[0]['gender'];
      $values['count_limb'] = $inf[0]['count_limb'];
      $values['biography'] = $inf[0]['biography'];
      $values['checked'] = $inf[0]['checked'];
      $get2 = $db->prepare("SELECT power_id FROM super_power WHERE person_id=?");
      $get2->bindParam(1, $_SESSION['uid']);
      $get2->execute();
      $inf2 = $get2->fetchALL();
      for ($i = 0; $i < count($inf2); $i++) {
        if ($inf2[$i]['power_id'] == '1') {
          $values['1'] = 1;
        }
        if ($inf2[$i]['power_id'] == '2') {
          $values['2'] = 1;
        }
        if ($inf2[$i]['power_id'] == '3') {
          $values['3'] = 1;
        }
      }
    } catch (PDOException $e) {
      print('Error: ' . $e->getMessage());
      exit();
    }
    printf('Произведен вход с логином %s, uid %d', $_SESSION['login'], $_SESSION['uid']);
  }
  include('form.php');
} else {
  $errors = FALSE;
  if (!empty($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
  } else {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $year = $_POST['year'];
    $gender = $_POST['gender'];
    $count_limb = $_POST['count_limb'];
    $abilities = $_POST['super_power'];
    $biography = $_POST['biography'];
    if (empty($_SESSION['login'])) {
      $checked = $_POST['checked'];
    }
    if (empty($_POST['name']) || !preg_match($reg, $_POST['name'])) {
      setcookie('name_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
    } else {
      setcookie('name_value', $_POST['name'], time() + 30 * 24 * 60 * 60 * 12);
    }

    if (empty($_POST['email']) || !preg_match($mailreg, $_POST['email'])) {
      setcookie('email_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
    } else {
      setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60 * 12);
    }
    if (empty($_POST['year']) || !is_numeric($_POST['year']) || !preg_match('/^\d+$/', $_POST['year'])) {
      setcookie('year_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
    } else {
      setcookie('year_value', $_POST['year'], time() + 30 * 24 * 60 * 60 * 12);
    }
    if (empty($_POST['biography']) || !preg_match($bioreg, $_POST['biography'])) {
      setcookie('biography_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
    } else {
      setcookie('biography_value', $_POST['biography'], time() + 30 * 24 * 60 * 60 * 12);
    }
    if (empty($_POST['gender'])) {
      setcookie('gender_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
    } else {
      setcookie('gender_value', $_POST['gender'], time() + 30 * 24 * 60 * 60 * 12);
    }
    if (empty($_POST['count_limb'])) {
      setcookie('count_limb_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
    } else {
      setcookie('count_limb_value', $_POST['count_limb'], time() + 30 * 24 * 60 * 60 * 12);
    }
    if (empty($_POST['checked'])) {
      setcookie('checked_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
    } else {
      setcookie('checked_value', $_POST['checked'], time() + 30 * 24 * 60 * 60 * 12);
    }

    if (!isset($abilities)) {
      setcookie('super_power_error', '1', time() + 24 * 60 * 60);
      setcookie('1_value', '', 100000);
      setcookie('2_value', '', 100000);
      setcookie('3_value', '', 100000);
      $errors = TRUE;
    }
    if (empty($_SESSION['login'])) {
      if (!isset($checked)) {
        setcookie('checked_error', '1', time() + 24 * 60 * 60);
        setcookie('checked_value', '', 100000);
        $errors = TRUE;
      } else {
        setcookie('checked_value', TRUE, time() + 60 * 60);
        setcookie('checked_error', '', 100000);
      }
    }
    if ($errors) {
      setcookie('save', '', 100000);
      header('Location: login.php');
    } else {
      setcookie('name_error', '', 100000);
      setcookie('email_error', '', 100000);
      setcookie('year_error', '', 100000);
      setcookie('gender_error', '', 100000);
      setcookie('count_limb_error', '', 100000);
      setcookie('super_power_error', '', 100000);
      setcookie('biography_error', '', 100000);
      setcookie('checked_error', '', 100000);
    }

    $user = 'u52805';
    $pass = '5816061';
    $db = new PDO(
      'mysql:host=localhost;dbname=u52805',
      $user,
      $pass,
      [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    if (!empty($_COOKIE[session_name()]) && !empty($_SESSION['login']) and !$errors) {
      $id = $_SESSION['uid'];
      $upd = $db->prepare("UPDATE person SET name=:name, email=:email, year=:year, gender=:gender, count_limb=:count_limb, biography=:biography WHERE id=:id");
      $cols = array(
        ':name' => $name,
        ':email' => $email,
        ':year' => $year,
        ':gender' => $gender,
        ':count_limb' => $count_limb,
        ':biography' => $biography
      );
      foreach ($cols as $k => &$v) {
        $upd->bindParam($k, $v);
      }
      $upd->bindParam(':id', $id);
      $upd->execute();
      $del = $db->prepare("DELETE FROM super_power WHERE person_id=?");
      $del->execute(array($id));
      $upd1 = $db->prepare("INSERT INTO super_power SET person_id=:id, power_id=:power");
      $upd1->bindParam(':id', $id);
      foreach($abilities as $value){
        if (in_array($value, $list_abilities)) {
          $upd1->bindParam(':power', $value);
          $upd1->execute();
        }
      }    
    } else {
      if (!$errors) {
        $login = 'u' . substr(uniqid(), -5);
        $password = substr(md5(uniqid()), 0, 16);
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        setcookie('login', $login);
        setcookie('password', $password);

        try {
          $stmt = $db->prepare("INSERT INTO person SET name = ?,email= ?, year= ?, gender= ?, count_limb= ?, biography= ?,checked= ?");
          $stmt->execute([$_POST['name'], $_POST['email'], $_POST['year'], $_POST['gender'], $_POST['count_limb'], $_POST['biography'], $_POST['checked']]);
          $id = $db->lastInsertId();
          $usr = $db->prepare("INSERT INTO user_info SET id=?,login=?,password=?");
          $usr->bindParam(1, $id);
          $usr->bindParam(2, $login);
          $usr->bindParam(3, $pass_hash);
          $usr->execute();
          $pwr = $db->prepare("INSERT INTO super_power SET power_id=:power, person_id=:id");
          $pwr->bindParam(':id', $id);
          foreach ($_POST['super_power'] as $powers) {
            $pwr->bindParam(':power', $powers);
            $pwr->execute();
          }
        } catch (PDOException $e) {
          print('Error : ' . $e->getMessage());
          exit();
        }
      }
    }
    if (!$errors) {
      setcookie('save', '1');
    }
    header('Location: ./');
  }
}
