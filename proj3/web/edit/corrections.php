<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../style.css" />
	</head>
	<script>
		function goBack() {
		  window.history.back();
		}
	</script>
	<body>
		<div>
			<h1 id="title">Correções</h1>
			<button class="back-btn" onclick="goBack()">Voltar</button>
		</div>

		<div class="table">
			<?php
				try {
					$host = "ec2-54-246-98-119.eu-west-1.compute.amazonaws.com";
					$user ="gurfrjwmuedfot";
					$password = "06e304a9e8b6c7b590df483952c65689eb12d16e4ea7443c44c688b8496f0639";
					$dbname = "d4f2uther4d3uk";
					$db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
					$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$sql = "SELECT email, nro, anomalia_id FROM correcao;";
					$result = $db->prepare($sql);
					$result->execute();
					echo("<table border=\"0\" cellspacing=\"5\">\n");
					foreach($result as $row) {
						echo("<tr>\n");
						echo("<td>{$row['email']}</td>\n");
						echo("<td>{$row['nro']}</td>\n");
						echo("<td>{$row['anomalia_id']}</td>\n");
						echo("<td><a href=\"balance.php?nro={$row['nro']}\">Editar Correção</a></td>\n");
						echo("</tr>\n");
					}
					
					echo("</table>\n");
					$db = null;
				}
				catch (PDOException $e)
				{
					echo("<p>ERROR: {$e->getMessage()}</p>");
				}
			?>
		</div>
	</body>
</html>