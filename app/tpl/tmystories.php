<?php
  include 'head_common.php';
?>

<div>
  <?php for($i=0;$i<count($this->dataTable);$i++){ ?>
      <a href="<?= APP_W."story/get/user/".$this->dataTable[$i]['idusers']."/idstory/".$this->dataTable[$i]['idstories'];?>">
      <div id="<?=$this->dataTable[$i]['path']?>">
        <?php

        $arxiu = $this->dataTable[$i]['path'].".json";
        $data=file_get_contents("stories/".$arxiu);
        $story = json_decode($data, true);
        echo "<label>@".$this->dataTable[$i]['usersname']."</label>";
        echo "<label>".$story['date']."</label>";
        echo "<label>".$story['titulo']."</label>";
        ?>
      </div> 
      </a>
    
<?php } ?>

</div>

<??>
