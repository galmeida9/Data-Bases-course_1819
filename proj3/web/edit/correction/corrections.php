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
				try {
					//DB Init
					$db = new DB();
					$db->debug_to_console("Connect");
					$db->connect();

					//GET Query
					$db->debug_to_console("Query");
					$sql = "SELECT email, nro, anomalia_id FROM correcao;";
					$result = $db->query($sql);

					echo("<table border=\"1\" cellspacing=\"5\">\n");
					echo("<tr><td><b>Número</b></td><td><b>Email</b></td><td><b>ID Anomalia</b></td></tr>\n");
					foreach($result as $row) {
						echo("<tr>\n");
						echo("<td>{$row['nro']}</td>\n");
						echo("<td>{$row['email']}</td>\n");
						echo("<td>{$row['anomalia_id']}</td>\n");
						echo("<td><a href=\"correction.php?nro={$row['nro']}\">Editar Correção</a></td>\n");
						echo("</tr>\n");
					}
					
					echo("</table>\n");

					// Cleaning up
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