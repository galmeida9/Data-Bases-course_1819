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
			<h1 id="title">Editar correção</h1>
			<form class="back-btn" action="../../edit.php">
			    <input type="submit" value="Voltar" />
			</form>
		</div>

		<div class="table">
			<?php
				require("../../db_class.php");
				$email = $_REQUEST['email'];
				$nro = $_REQUEST['nro'];
				$anomalia_id = $_REQUEST['anomalia_id'];

				try {
					//DB Init
					$db = new DB();
					$db->debug_to_console("Connect");
					$db->connect();

					//DELETE Query
					$db->debug_to_console("Delete Query");
					$sql = "UPDATE correcao SET anomalia_id = :anomalia_id WHERE nro = :nro;";
					$db->debug_to_console($sql);
					$result = $db->query($sql);

					// If returns False is error
					if (!$result) return;

					$db->debug_to_console("PHP acabado.");
					echo("<p>Local removido com sucesso.</p>");

					//Cleaning up
					unset($db);
					$result = null;
				}
				catch (PDOException $e)
				{
					echo("<p>ERROR: {$e->getMessage()}</p>");
				}
			?>
		</div>
	</body>
</html>