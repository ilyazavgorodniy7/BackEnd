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
    <input type="radio" checked="checked" name="man" value="man">man
  </label>
   </br>
   <label>
  <input type="radio" checked="checked" name="woman" value="woman">woman
   </label>
  <?php
  printf('Count_limb :')
  ?>
   <label>
   <input type="radio" checked="checked" name="r" value="2">2-4
   </label>
   </br>
   <label>
   <input type="radio" name="r" value="5">5-7
   </label>
   </br>
   <label>
   <input type="radio" name="r" value="8">8-10
   </label>
   </br>
   <label>
  <input type="submit" value="ok" />
</form>
