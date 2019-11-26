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
			<h1 id="title">Itens</h1>
			<button class="back-btn" onclick="goBack()">Voltar</button>
		</div>

		<div class="table">
			<?php
				require("../../db_class.php");
				try {
					//DB Init
					$db = new DB();
					$db->debug_to_console("Connect");
					$db->connect();

					//SELECT Query
					$db->debug_to_console("Query");
					$sql = "SELECT id, descricao, localizacao, latitude, longitude FROM item;";
					$result = $db->query($sql);

					echo("<table border=\"0\" cellspacing=\"5\">\n");
					echo("<tr><td><b>ID</b></td><td><b>Descrição</b></td><td><b>Localização</b></td>");
					echo("<td><b>Latitude</b></td><td><b>Longitude</b></td></tr>\n");
					foreach($result as $row) {
						echo("<tr>\n");
						echo("<td>{$row['id']}</td>\n");
						echo("<td>{$row['descricao']}</td>\n");
						echo("<td>{$row['localizacao']}</td>\n");
						echo("<td>{$row['latitude']}</td>\n");
						echo("<td>{$row['longitude']}</td>\n");
						echo("<td><a href=\"update.php?id={$row['id']}\">Remover</a></td>\n");
						echo("</tr>\n");
					}
					
					echo("</table>\n");

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