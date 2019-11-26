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
				header("Location: login.php");
			}
		?>

		<div class="sidenav">
			<a href="../../index.php">Home</a>
			<a href="../../insert.php">Inserir</a>
			<a href="../../edit.php">Editar</a>
			<a href="../../view.php">Visualizar</a>
			<a href="../../register.php">Registar</a>
			<a href="../../logout.php" class="logout">Logout</a>
		</div>

		<div id="tr" class="main">
			<h1 id="title">Remover anomalia</h1>
            
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
						$sql = "SELECT id, zona, imagem, lingua, ts, descricao, tem_anomalia_redacao FROM anomalia;";
						$result = $db->query($sql);

						echo("<table border=\"1\" cellspacing=\"5\">\n");
						echo("<tr><td><b>ID</b></td><td><b>Zona</b></td><td><b>Imagem</b></td><td><b>Língua</b></td>");
						echo("<td><b>Data/Hora</b></td><td><b>Descrição</b></td><td><b>Anomalia Redação?</b></td></tr>\n");
						foreach($result as $row) {
							echo("<tr>\n");
							echo("<td>{$row['id']}</td>\n");
							echo("<td>{$row['zona']}</td>\n");
							echo("<td>{$row['imagem']}</td>\n");
							echo("<td>{$row['lingua']}</td>\n");
							echo("<td>{$row['ts']}</td>\n");
							echo("<td>{$row['descricao']}</td>\n");

							if ($row['tem_anomalia_redacao'] == 1) {
								echo("<td>Sim</td>\n");
							} else {
								echo("<td>-</td>\n");
							}

							
							echo("<td><a href=\"update.php?id={$row['id']}\">Remover</a></td>\n");
							echo("</tr>\n");
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
		</div>

		
	</body>
</html>
