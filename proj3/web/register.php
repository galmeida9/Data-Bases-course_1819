<!DOCTYPE html>
<html>
	<script>
		function goBack() {
		  window.history.back();
		}
	</script>
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
			<a href="index.php">Home</a>
			<a href="insert.php">Inserir</a>
			<a href="edit.php">Editar</a>
			<a href="view.php">Visualizar</a>
			<a class="active" href="">Registar</a>
		</div>

		<div id="tr" class="main">
			<h1 id="title">Registar</h1>
			<div class="container">
				
			</div>
		</div>
	</body>
</html>
