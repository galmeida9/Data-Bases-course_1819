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
				header("Location: login/login.php");
			}
		?>

		<div class="sidenav">
			<a href="index.php">Home</a>
			<a href="insert.php">Inserir</a>
			<a href="edit.php">Editar</a>
			<a class="active" href="">Visualizar</a>
			<a href="register.php">Registar</a>
			<a href="login/logout.php" class="logout">Logout</a>
		</div>

		<div id="tr" class="main">
			<h1 id="title">Visualizar</h1>

			<div class="row">
				<div class="column">
					<b>Utilizadores</b>
					<form action="view/users.php" method="post">
						<p> <input class="button buttonSmall" id="submit-btn" type="submit" value="Listar utilizadores"/> </p>
					</form>
				</div>
			</div>

			<div class="row">
				<div class="column">
					<b>Anomalias entre 2 locais</b>
					<form action="view/anomalia.php" method="post">
						<p> <input class="button buttonSmall" id="submit-btn" type="submit" value="Listar anomalias"/> </p>
					</form>
				</div>
			</div>

			<div class="row">
				<div class="column">
					<b>Anomalias numa vizinhança</b>
					<form action="view/anomaliaPos.php" method="post">
						<p>
							<label for="a">Latitude:</label>
							<input id="a" type="text" name="lat">
						</p>
						<p>
							<label for="b">Longitude:</label>
							<input id="b" type="text" name="long">
						</p>
						<p>
							<label for="b">dx:</label>
							<input id="b" type="text" name="dx">
						</p>
						<p>
							<label for="b">dy:</label>
							<input id="b" type="text" name="dy">
						</p>
						<p> <input class="button buttonSmall" id="submit-btn" type="submit" value="Submit"/> </p>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
