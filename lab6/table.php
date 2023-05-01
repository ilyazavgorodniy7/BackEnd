<style>
  .form1{
    max-width: 960px;
    text-align: center;
    margin: 0 auto;
  }
  .error {
    border: 3px solid red;
  }
  .hidden{
    display: none;
  }
</style>
<body>
  <div class="table1">
    <table border="1">
      <tr>
        <th>Name</th>
        <th>EMail</th>
        <th>Year</th>
        <th>Gender</th>
        <th>Count_Limbs</th>
        <th>Super_power</th>
        <th>Biography</th>
      </tr>
      <?php
      foreach($users as $user){
          echo '
            <tr>
              <td>'.$user['name'].'</td>
              <td>'.$user['email'].'</td>
              <td>'.$user['year'].'</td>
              <td>'.$user['gender'].'</td>
              <td>'.$user['count_limb'].'</td>
              <td>';
                $user_super_power=array(
                    '1'=>FALSE,
                    '2'=>FALSE,
                    '3'=>FALSE,
                );
                foreach($list_super_power as $sup){
                    if($sup['person_id']==$user['id']){
                        if($sup['power_id']=='1'){
                            $user_super_power['1']=TRUE;
                        }
                        if($sup['power_id']=='2'){
                            $user_super_power['2']=TRUE;
                        }
                        if($sup['power_id']=='3'){
                            $user_super_power['3']=TRUE;
                        }                      
                    }
                }
                if($user_super_power['1']){echo '1<br>';}
                if($user_super_power['2']){echo '2<br>';}
                if($user_super_power['3']){echo '3<br>';}
              echo '</td>
              <td>'.$user['biography'].'</td>
              <td>
                <form method="get" action="index.php">
                  <input name=edit_id value='.$user['id'].' hidden>
                  <input type="submit" value=Edit>
                </form>
              </td>
            </tr>';
       }
      ?>
    </table>
    <?php
    printf('Пользователи с 1 способностью: %d <br>',$super_power_count[0]);
    printf('Пользователи со 2 способностью: %d <br>',$super_power_count[1]);
    printf('Пользователи с 3 способностью: %d <br>',$super_power_count[2]);
    ?>
  </div>
</body>
