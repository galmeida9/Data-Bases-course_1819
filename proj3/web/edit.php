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
			<a class="active" href="">Editar</a>
			<a href="view.php">Visualizar</a>
			<a href="register.php">Registar</a>
			<a href="logout.php" class="logout">Logout</a>
		</div>

		<div id="tr" class="main">
			<h1 id="title">Editar</h1>

			<div class="row">
				<div class="column">
					<b>Locais</b>
					<form action="remove/place/places.php" method="post">
						<p> <input class="button buttonSmall" id="submit-btn" type="submit" value="Remover local"/> </p>
					</form>
				</div>
			</div>

			<div class="row">
				<div class="column">
					<b>Itens</b>
					<form action="remove/item/itens.php" method="post">
						<p> <input class="button buttonSmall" id="submit-btn" type="submit" value="Remover item"/> </p>
					</form>
				</div>
			</div>
			
			<div class="row">
				<div class="column">
					<b>Anomalias</b>
					<form action="remove/anomalia/anomalias.php" method="post">
						<p> <input class="button buttonSmall" id="submit-btn" type="submit" value="Remover anomalia"/> </p>
					</form>
				</div>
			</div>

			<div class="row">
				<div class="column">
					<b>Correções</b>
					<form action="edit/correction/corrections.php" method="post">
						<p> <input class="button buttonSmall" id="submit-btn" type="submit" value="Editar correção"/> </p>
					</form>
					<form action="" method="post">
						<p> <input class="button buttonSmall" id="submit-btn" type="submit" value="Remover correção"/> </p>
					</form>
				</div>
			</div>

			<div class="row">
				<div class="column">
					<b>Propostas de correção</b>
					<form action="" method="post">
						<p> <input class="button buttonSmall" id="submit-btn" type="submit" value="Editar proposta de correção"/> </p>
					</form>
					<form action="" method="post">
						<p> <input class="button buttonSmall" id="submit-btn" type="submit" value="Remover proposta de correção"/> </p>
					</form>
				</div>
			</div>	
		</div>
	</body>
</html>
