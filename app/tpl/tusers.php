<?php
	include 'head_common.php';
	?>
<body>
	<h1>Perfil</h1>
	<div>
		<form>
			<label> UserID: <label for="UserID" id="userid"> <?php echo $this->dataTable[0]['idusers']; ?> </label> </label>
			<label for="UserName"> Username: <input type="text" placeholder="username " id="username" name="username"> </label> <br>
		    <label for="Email"> Email: <input type="text" placeholder="email " id="email" name="email"> </label> <br><br>

		     <button class="edit-btn" >Editar</button>
		</form>
	</div>

<?php
	include 'footer_common.php';
?>
