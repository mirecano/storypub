<?php
            include 'head_common.php';
?>

<div id="mens"></div>

  <label>Títol:</label><br>
  <input type="text" name="titulo"><br><br>
  <label>Historia:</label><br>

  <textarea id="textarea"></textarea>

  <br>
  <button type="submit" id="edit_hist" >Editar história</button>

  <?php

      $archivo = $this->dataTable[0]['path'].".json"; 
      $arxiu = $this->dataTable[0]['path'].".txt"; 

      $data=file_get_contents("stories/".$archivo); 

      $story = json_decode($data, true); 

      $gestor = @fopen("stories/".$arxiu, "r"); 
      $contents = fread($gestor, filesize("stories/".$arxiu)); 

      echo "<textarea style='display:none;' id='story'>".$contents."</textarea>";
      echo "<textarea style='display:none;' id='title'>".$story['titulo']."</textarea>";
      echo "<textarea style='display:none;' id='iduser'>".$this->dataTable[0]['idusers']."</textarea>";
      echo "<textarea style='display:none;' id='idstory'>".$this->dataTable[0]['path']."</textarea>";

  ?>

<?php
            include 'footer_common.php';
?>
