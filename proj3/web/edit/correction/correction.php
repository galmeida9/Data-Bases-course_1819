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
			<h1 id="title">Correções</h1>
			<form class="back-btn" action="../../edit.php">
				<input type="submit" value="Voltar" />
			</form>
		</div>

		<div class="table">
			<h3>Editar correção #<?=$_REQUEST['nro']?></h3>
			<form action="update.php" method="post">
				<p><input type="hidden" name="nro" value="<?=$_REQUEST['nro']?>"/></p>
				<p>Novo ID de anomalia: <input type="text" name="anomalia_id"/></p>
				<p><input type="submit" value="Submit"/></p>
			</form>
		</div>
	</body>
</html>