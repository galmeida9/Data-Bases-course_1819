<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../../style.css" />
	</head>
	<body>
		<?php
			session_start();
			if (!isset($_SESSION['email'])) {
				header("Location: ../../login/login.php");
			}
		?>

		<div>
			<h1 id="title">Editar proposta de correção</h1>
			<form class="back-btn" action="../../edit.php">
				<input class="button buttonSmall" type="submit" value="Cancelar" />
			</form>

			<div class="table">
				<h3>Insira o novo texto</h3>
				<form action="update.php" method="post">
					<p>
						<label for="a">Texto:</label>
						<input id="a" type="hidden" name="nro" value="<?=$_REQUEST['nro']?>">
						<input id="long-input" type="text" name="texto">
					</p>
					<p> <input class="button buttonSmall" id="submit-btn" type="submit" value="Submeter"/> </p>
				</form>
			</div>
		</div>
	</body>
</html>