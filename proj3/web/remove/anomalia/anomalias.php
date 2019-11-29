<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../../style.css" />
		<link rel="stylesheet" href="../../modal.css" />
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
			<h1 id="title">Remover anomalia</h1>
            
            <form class="back-btn" action="../../edit.php">
			    <input class="button buttonSmall" type="submit" value="Voltar" />
			</form>

            <div class="table">
				<?php
					require("../../db_class.php");
					try {
						//DB Init
						$db = new DB();
						$db->connect();

						$sql = "SELECT * FROM anomalia;";
						$result = $db->query($sql);

						echo("<table border=\"1\" cellspacing=\"5\">\n");
						echo("<tr><td><b>ID</b></td><td><b>Tipo</b></td><td><b>Zona</b></td><td><b>Imagem</b></td>");
						echo("<td><b>Língua</b></td><td><b>Data/Hora</b></td><td><b>Descrição</b></td></tr>\n");
						foreach($result as $row) {
							echo("<tr>\n");
							echo("<td>{$row['id']}</td>\n");

							if ($row['tem_anomalia_redacao'] == 1) {
								echo("<td>Redação</td>\n");
							} else {
								echo("<td><b>Tradução</b></td>\n");
							}

							echo("<td>{$row['zona']}</td>\n");
							echo("<td><a onclick='showImg(\"{$row['imagem']}\")'>Ver</a></td>\n");
							echo("<td>{$row['lingua']}</td>\n");
							echo("<td>{$row['ts']}</td>\n");
							echo("<td>{$row['descricao']}</td>\n");						
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
						echo("<p><font color='red'>ERRO</font>: {$e->getMessage()}</p>");
					}
				?>
			</div>

			<div id="myModal" class="modal">
                <span class="close">&times;</span>
                <img class="modal-content" id="img01">
            </div>
		</div>

		
	</body>
	<script src="../../modal.js"></script>
</html>
