<form action="" method="POST">
  <input name="fio"  placeholder="fio"/>
  </br>
  <input name="mail" placeholder="mail"/>
  </br>
  <input name="year" placeholder="year"/>
  </br>
  <?php
  printf('Gender :')
  ?>
  <label>
    <input type="radio" checked="checked" name="radio" value="Мужской"> Мужской
  </label>
   <label>
  <input type="radio" name="radio" value="Женский">Женский
   </label>
</br>
  <?php
  printf('Count_limb :')
  ?>
   <label>
   <input type="radio" checked="checked" name="r" value="2">2-4
   </label>
   <label>
   <input type="radio" name="r" value="5">5-7
   </label>
   <label>
   <input type="radio" name="r" value="8">8-10
   </label>
   <label>
  <input type="submit" value="ok" />
</form>
