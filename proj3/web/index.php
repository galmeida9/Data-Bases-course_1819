<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="style.css" />
	</head>
	<body>
		<?php
			session_start();
            if (!isset($_SESSION['email'])) {
				header("Location: login.php");
			}
		?>

		<div class="sidenav">
			<a class="active" href="">Home</a>
			<a href="insert.php">Inserir</a>
			<a href="edit.php">Editar</a>
			<a href="view.php">Visualizar</a>
			<a href="register.php">Registar</a>
			<a href="logout.php" class="logout">Logout</a>
		</div>

		<div id="tr" class="main">
			<h1 id="title">Translate Right</h1>
		</div>
		<div id="repor">
			<h3 id="indexTitle">Repor Base de Dados</h3>
			<form action="reporDados.php" method="post">
    			<input type="submit" value="Repor dados" />
			</form>
		</div>
	</body>
</html>