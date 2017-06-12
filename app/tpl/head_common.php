<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title><?= $this->page;?></title>

	      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,600i,700,800,900" rel="stylesheet">
				<link rel="stylesheet" href="/stp/pub/css/style.css" type="text/css">

</head>
<body>

   <div>sense temps per acabar</div>
				
     <?php

		use \X\Sys\Session;
		if( Session::get('user')){
			$ses = Session::get('user');
			if($this->page=="Home"){
				echo('<li><a href="'.APP_W.'dashboard"></span>Dashboard</a></li>');
			}
			echo '<li><a href="'.APP_W.'editor"></span>Nova història</a></li>
				<li class="dropdown">
				<a href="#" '.$ses["usersname"].' <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href= #'.APP_W."users/profile/id/".$ses["idusers"].'">Compte</a></li>
					<li><a href= #'.APP_W."dashboard/my/id/".$ses["idusers"].'">Les meves històries</a></li>';

					if( $ses["roles"]==2 ){
						echo ('<li class="divider"></li>
							<li><a href=#>Administrar Usuaris</a></li>
							<li class="divider"></li>
					');

					}else{
						echo ('<li class="divider"></li>
							<li><a href=#Cerrar Sesión</a></li>');
					}
		}else{
			if($this->page=="Home"){
				echo('<li><a href="signup"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
					<li><a href="login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>');
		}

		if($this->page=="Login"){
			echo('<li><a href="signup"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>');
		}

		if($this->page=="SignUp"){
			echo('<li><a href="login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>');
		}

		}

		?>



