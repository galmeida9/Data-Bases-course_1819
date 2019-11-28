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

		<div class="sidenav">
			<a href="../../index.php">Home</a>
			<a href="../../insert.php">Inserir</a>
			<a href="../../edit.php">Editar</a>
			<a href="../../view.php">Visualizar</a>
			<a href="../../register.php">Registar</a>
			<a href="../../login/logout.php" class="logout">Logout</a>
		</div>

		<div id="tr" class="main">
			<h1 id="title">Remover local</h1>
            
            <form class="back-btn" action="../../edit.php">
			    <input type="submit" value="Voltar" />
			</form>

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
						$sql = "SELECT latitude, longitude, nome FROM local_publico;";
						$result = $db->query($sql);

						// If returns False is error
						if (!$result) return;

						echo("<table border=\"1\" cellspacing=\"5\">\n");
						echo("<tr><td><b>Latitude</b></td><td><b>Longitude</b></td><td><b>Nome</b></td></tr>\n");
						foreach($result as $row) {
							echo("<tr>\n");
							echo("<td>{$row['latitude']}</td>\n");
							echo("<td>{$row['longitude']}</td>\n");
							echo("<td>{$row['nome']}</td>\n");
							echo("<td><a href=\"update.php?latitude={$row['latitude']}&longitude={$row['longitude']}\">Remover</a></td>\n");
							echo("</tr>\n");
						}
						
						echo("</table>\n");

						//Cleaning up
						unset($db);
						$result = null;
					}
					catch (PDOException $e)
					{
						echo("<p>ERRO: {$e->getMessage()}</p>");
					}
				?>
			</div>
		</div>

	</body>
</html>