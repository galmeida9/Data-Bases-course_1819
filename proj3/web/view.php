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
			<a class="active" href="">Visualizar</a>
			<a href="register.php">Registar</a>
			<a href="logout.php" class="logout">Logout</a>
		</div>

		<div id="tr" class="main">
			<h1 id="title">Visualizar</h1>

			<div class="row">
				<div class="column">
					<b>Utilizadores</b>
					<form action="users.php" method="post">
						<p> <input class="button buttonSmall" id="submit-btn" type="submit" value="Listar utilizadores"/> </p>
					</form>
				</div>
			</div>

			<div class="row">
				<div class="column">
					<b>Anomalias</b>
					<form action="" method="post">
						<p> <input class="button buttonSmall" id="submit-btn" type="submit" value="Listar anomalias"/> </p>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
