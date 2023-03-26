<link rel="stylesheet" href="style.css" type="text/css">
<form action="index.php" method="POST">
    <div class="form">
    <label>
    <?php
      printf('Имя:');
    ?>
    <br>
    <input name="name" placeholder="name">
    </label>
    <label>
    <?php
      printf('E-mail:');
    ?>
    <br>
    <input name="email" type="email" placeholder="email">
    </label>
    <label>
    <?php
      printf('Год рождения:');
    ?>
    <br>
    <input name="year" placeholder="year">
    </label>
    <label>
    <?php
      printf('Гендер:');
    ?>
    <br>
    <?php
      printf('Мужской');
    ?>
    <input type="radio" name="gender" value="1">
    <?php
      printf('Женский');
    ?>
    <input type="radio" name="gender" value="2">
    </label>
    <label>
    <?php
      printf('Количество конечностей: ');
      printf('2-4');
    ?>
    <input type="radio" value="1" name="count_limb">
    <?php
      printf('5-7');
    ?>
    <input type="radio" value="2" name="count_limb">
    <?php
      printf('8-10');
    ?>
    <input type="radio" value="3" name="count_limb">
    </label>
    <label>
    <?php
      printf('Сверхспособности:');
    ?>
    <br>
    <select name="super_power[]" multiple="multiple"> 
      <option value="1">Бессмертие</option>
      <option value="2">Проходить сквозь стены</option>
      <option value="3">Левитация</option>
    </select>
    </label>
    <label>
    <?php
      printf('О себе:');
    ?>
    <br>
    <textarea name="biography" placeholder="about me"></textarea>
    </label>
    <label>
    <?php
      printf('С контрактом ознакомлен(-а)');
    ?>
    <input type="checkbox" name="checked" value="on">
    </label>
    <label>
    <input type="submit" value="ok" class="button"/>
    </label>
    </div>
  </form>
