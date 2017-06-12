<?php
	include 'head_common.php';
?>
<body>
	<div>
	<?php
		use \X\Sys\Session;
		$ses = Session::get('user');

        $archivo = $this->dataTable[0]['path'].".json";
        $arxiu = $this->dataTable[0]['path'].".txt";

            $data=file_get_contents("stories/".$archivo);
	?>

	<?php
		echo "sense temps";

						 ?>

    </div> 

<?php
	include 'footer_common.php';
?>
