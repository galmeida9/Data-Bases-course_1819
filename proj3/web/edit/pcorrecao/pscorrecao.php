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

		<div class="main">
			<h1 id="title">Editar proposta de correção</h1>
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

						//GET Query
						$db->debug_to_console("Query");
						$sql = "SELECT * FROM proposta_de_correcao;";
						$result = $db->query($sql);

						echo("<table border=\"1\" cellspacing=\"5\">\n");
						echo("<tr><td><b>Número</b></td><td><b>Email</b></td><td><b>Data/Hora</b></td><td><b>Texto</b></td></tr>\n");
						foreach($result as $row) {
							echo("<tr>\n");
							echo("<td>{$row['nro']}</td>\n");
							echo("<td>{$row['email']}</td>\n");
							echo("<td>{$row['data_hora']}</td>\n");
							echo("<td>{$row['texto']}</td>\n");
							echo("<td><a href=\"pcorrecao.php?nro={$row['nro']}\">Editar</a></td>\n");
							echo("</tr>\n");
						}
						
						echo("</table>\n");

						// Cleaning up
						$result = null;
						unset($db);
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