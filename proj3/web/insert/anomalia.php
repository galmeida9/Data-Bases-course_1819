<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../style.css" />
	</head>
	<body>
		<div>
			<h1 id="title">Inserir Anomalia</h1>
			<form class="back-btn" action="../insert.php">
			    <input type="submit" value="Sair" />
			</form>
		</div>

		<div class="table">
			<?php
				$zona = $_REQUEST['zona'];
				$imagem = $_REQUEST['imagem'];
				$lingua = $_REQUEST['lingua'];
				$descricao = $_REQUEST['descricao'];
				$tem_anomalia_redacao = ($_POST['tem_anomalia_redacao'] == 'Yes') ? 'true' : 'false';

				try{
					$host = "ec2-54-246-98-119.eu-west-1.compute.amazonaws.com";
					$user ="gurfrjwmuedfot";
					$password = "06e304a9e8b6c7b590df483952c65689eb12d16e4ea7443c44c688b8496f0639";
					$dbname = "d4f2uther4d3uk";
					$db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
					$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					$sql = "INSERT INTO anomalia (zona, imagem, lingua, ts, descricao, tem_anomalia_redacao)
					VALUES ('$zona', '$imagem', '$lingua', now(),'$descricao', '$tem_anomalia_redacao')";

					$result = $db->prepare($sql);
					$result->execute();
					
					// Cleaning Up
					$result = null;
					$db = null;

					echo("<p>Anomalia inserida com sucesso.</p>");
				}
				catch (PDOException $e)
				{
					echo("<p>ERROR: {$e->getMessage()}</p>");
				}
			?>
		</div>
	</body>
</html>