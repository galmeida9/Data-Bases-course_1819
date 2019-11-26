<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../../style.css" />
	</head>
	<script>
		function goBack() {
		  window.history.back();
		}
	</script>
	<body>
		<?php
			session_start();
            if (!isset($_SESSION['email'])) {
				header("Location: login.php");
			}
		?>

		<div>
			<h1 id="title">Correções</h1>
			<button class="back-btn" onclick="goBack()">Voltar</button>
		</div>

		<div class="table">
			<h3>Editar texto para correção #<?=$_REQUEST['nro']?></h3>
			<form action="update.php" method="post">
				<p><input type="hidden" name="nro" value="<?=$_REQUEST['nro']?>"/></p>
				<p>Novo texto: <input type="text" name="text"/></p>
				<p><input type="submit" value="Submit"/></p>
			</form>
		</div>
	</body>
</html>