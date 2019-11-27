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
			<h1 id="title">Remover proposta de correção</h1>
			<form class="back-btn" action="../../edit.php">
			    <input type="submit" value="Sair" />
			</form>
		</div>

		<div class="table">
			<?php
				require("../../db_class.php");
				$nro = $_REQUEST['nro'];

				try{
					//DB Init
					$db = new DB();
					$db->debug_to_console("Connect");
					$db->connect();

					$sql = "DELETE FROM proposta_de_correcao WHERE nro='$nro'";
					$result = $db->query($sql);

					if ($result == true) {
						echo("<p>Proposta de correção removida com sucesso.</p>");
					}

					// Cleaning Up
					$result = null;
					unset($db);					
				}
				catch (PDOException $e)
				{
					echo("<p>ERROR: {$e->getMessage()}</p>");
				}
			?>
		</div>
	</body>
</html>