<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="style.css" />
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
			<h1 id="title">Utilizadores</h1>
			<button class="back-btn" onclick="goBack()">Voltar</button>
		</div>

		<div class="table">
			<?php
				require("db_class.php");
				try {
					//DB Init
					$db = new DB();
					$db->debug_to_console("Connect");
					$db->connect();

					//GET Query
					$db->debug_to_console("Query");
					$sql = "SELECT email, psw FROM utilizador;";
					$result = $db->query($sql);

					echo("<table border=\"1\">\n");
					echo("<tr><td>email</td></tr>\n");
					foreach($result as $row) {
						echo("<tr><td>");
						echo($row['email']);
						echo("</td></tr>\n");
					}
					echo("</table>\n");
					
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