<?php $show_title="$MSG_RANKLIST - $OJ_NAME"; ?>
<?php include("template/$OJ_TEMPLATE/header.php");?>

<div class="padding">
  <form action="ranklist.php" class="ui mini form" method="get" role="form" style="margin-bottom: 25px; text-align: right; ">
    <div class="ui action left icon input inline" style="width: 180px; margin-right: 77px; ">
      <i class="search icon"></i><input name="prefix" placeholder="<?php echo $MSG_USER?>" type="text" value="<?php echo htmlentities(isset($_GET['prefix'])?$_GET['prefix']:"",ENT_QUOTES,"utf-8") ?>">
      <button class="ui mini button" type="submit"><?php echo $MSG_SEARCH?></button>
    </div>
  </form>
	    <table class="ui very basic center aligned table rank_table" style="table-layout: fixed; ">
	        <thead>
	        <tr>
	            <th style="width: 120px; "><?php echo $MSG_Number?></th>
	            <th><?php echo $MSG_USERINFO?></th>
              <th style="width: 120px; "><?php echo $MSG_SOVLED?></th>
              <th style="width: 120px; "><?php echo $MSG_SUBMIT?></th>
              <th style="width: 120px; "><?php echo $MSG_RATIO?></th>
	        </tr>
	        </thead>
	        <tbody>
          <?php
          foreach($view_rank as $row){
          echo "<tr>";
          for ( $i=0; $i<6; $i++ ) {
            echo "<td>";
            if($i == 1){
              echo "<img class=\"profile_img\" src=\"/upload/" . htmlentities ( $row[$i]['user_id'],ENT_QUOTES,"UTF-8") . ".webp\"></img>";
              echo "<div class=\"user_info\">";
              echo "<p>"."<a href='userinfo.php?user=" .htmlentities ( $row[$i]['user_id'],ENT_QUOTES,"UTF-8"). "'>" . $row['user_id'] . "</a>" . "/ " . htmlentities ( $row['nick'] ,ENT_QUOTES,"UTF-8") . "</div>";
              echo "</div>";
              $i++;
            } else {
            echo "\t".$row[$i];
          }
            echo "</td>";
          }
          echo "</tr>";
          }
          ?>
	        </tbody>
	    </table>
    <br>
    <div style="margin-bottom: 30px; ">
  
  <div style="text-align: center; ">
	<div class="ui pagination" style="box-shadow: none; ">      
    <?php
    for($i = 0; $i <$view_total ; $i += $page_size) {
    $str= "<a class=\"ui button\" href='./ranklist.php?start=" . strval ( $i ).($scope?"&scope=$scope":"") . "'>";
    $str.= strval ( $i + 1 );
    $str.= "-";
    $str.= strval ( $i + $page_size );
    $str.= "</a>";
    echo $str;
    }
    ?>
	</div>
  </div>
</div>
</div>

<?php include("template/$OJ_TEMPLATE/footer.php");?>
