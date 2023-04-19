<html>
<header>
  <link rel="stylesheet" href="style.css" type="text/css">
</header>

<head>
  <style>
    .error {
      margin: 0 auto 2px auto;
      width: 200px;
      border: 2px solid purple;
    }
  </style>
</head>

<body>
  <?php
  if (!empty($messages)) {
    print('<div id="messages">');
    foreach ($messages as $message) {
      print($message);
    }
    print('</div>');
  }
  ?>
  <form action="index.php" method="POST">
    <br>
    <label>
      <?php
      printf('Имя пользователя:');
      ?>
      <br>
      <input name="name" placeholder="name" <?php if ($errors['name']) {
        print 'class="error"';
      } ?>
        value="<?php print $values['name']; ?>">
    </label>
    <label>
      <?php
      printf('Почта:');
      ?>
      <br>
      <input name="email" type="email" placeholder="email" <?php if ($errors['email']) {
        print 'class="error"';
      } ?>
        value="<?php print $values['email']; ?>">
    </label>
    <label>
      <?php
      printf('Год рождения:');
      ?>
      <br>
      <input name="year" placeholder="year" <?php if ($errors['year']) {
        print 'class="error"';
      } ?>
        value="<?php print $values['year']; ?>">
    </label>
    <label <?php if ($errors['gender']) {
      print 'class="error"';
    } ?>>
      <?php
      printf('Пол:');
      ?>
      <br>
      <?php
      printf('М');
      ?>
      <input type="radio" name="gender" value="1" <?php if (!empty($values['gender'] == '1')) {
        print 'checked';
      } ?>>
      <?php
      printf('Ж');
      ?>
      <input type="radio" name="gender" value="2" <?php if (!empty($values['gender'] == '2')) {
        print 'checked';
      } ?>>
    </label>
    <label <?php if ($errors['count_limb']) {
      print 'class="error"';
    } ?>>
      <?php
      printf('Количество конечностей: ');
      ?>
      <br>
      <?php
      printf('1');
      ?>
      <input type="radio" value="1" name="count_limb" <?php if (!empty($values['count_limb'] == '1')) {
        print 'checked';
      } ?>>
      <?php
      printf('2');
      ?>
      <input type="radio" value="2" name="count_limb" <?php if (!empty($values['count_limb'] == '2')) {
        print 'checked';
      } ?>>
      <?php
      printf('3');
      ?>
      <input type="radio" value="3" name="count_limb" <?php if (!empty($values['count_limb'] == '3')) {
        print 'checked';
      } ?>>
    </label>
    <label>
      <?php
      printf('Сверхспособности:');
      ?>
      <br>
      <select name="super_power[]" multiple="multiple" <?php if ($errors['super_power']) {
        print 'class="error"';
      } ?>>
        <option value="1" <?php if (!empty($values['1'] == 1)) {
          print 'selected';
        } ?>>Бессмертие</option>
        <option value="2" <?php if (!empty($values['2'] == 1)) {
          print 'selected';
        } ?>>Проходить сквозь стены</option>
        <option value="3" <?php if (!empty($values['3'] == 1)) {
          print 'selected';
        } ?>>Левитация</option>
      </select>
    </label>
    <label>
      <?php
      printf('Биография:');
      ?>
      <br>
      <textarea name="biography" placeholder="about me" <?php if ($errors['biography']) {
        print 'class="error"';
      } ?>> <?php print $values['biography'] ?></textarea>
    </label>
    <label <?php if ($errors['checked']) {
      print 'class="error"';
    } ?>>
      <?php
      printf('С контрактом ознакомлен(-а)');
      ?>
      <input type="checkbox" name="checked" <?php if (!empty($values['checked'] == 'on')) {
        print 'checked';
      } ?>>
    </label>
    <label>
      <input type="submit" value="ok" class="button" />
    </label>
  </form>
  <?php
  if (empty($_SESSION['login'])) {
    echo '
   <div class="login">
    <p>Имеется аккаунт? <a href="login.php" style="color:black;">Входите!</a></p>
   </div>';
  } else {
    echo '
    <div class="logout">
      <form action="index.php" method="post">
        <input name="logout" type="submit" value="Выйти">
      </form>
    </div>';
  } ?>
</body>

</html>
