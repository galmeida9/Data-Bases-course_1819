<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../style.css" />
	</head>
	<body>
		<div>
			<h1 id="title">Inserir Item</h1>
			<form class="back-btn" action="../insert.php">
			    <input type="submit" value="Sair" />
			</form>
		</div>

		<div class="table">
			<?php
				$descricao = $_REQUEST['descricao'];
				$localizacao = $_REQUEST['localizacao'];
				$local = $_REQUEST['local'];

				try {
					$host = "ec2-54-246-98-119.eu-west-1.compute.amazonaws.com";
					$user ="gurfrjwmuedfot";
					$password = "06e304a9e8b6c7b590df483952c65689eb12d16e4ea7443c44c688b8496f0639";
					$dbname = "d4f2uther4d3uk";
					$db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
					$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					$db->beginTransaction();

					$sql = "SELECT latitude, longitude FROM local_publico WHERE nome='$local' LIMIT 1;";
					$result = $db->prepare($sql);
					$result->execute();

					$row = $result->fetch();
					$latitude = $row['latitude'];
					$longitude = $row['longitude'];
					
					$sql = "INSERT INTO item (descricao, localizacao, latitude, longitude)
					VALUES ('$descricao', '$localizacao', '$latitude', '$longitude')";
					$result = $db->prepare($sql);
					$result->execute();
					
					$db->commit();

					// Cleaning Up
					$result = null;
					$db = null;

					echo("<p>Item inserido com sucesso.</p>");
				}
				catch (PDOException $e)
				{
					$db->rollBack();
					echo("<p>ERROR: {$e->getMessage()}</p>");
				}
			?>
		</div>
	</body>
</html>