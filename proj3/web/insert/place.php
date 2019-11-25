<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../style.css" />
	</head>
	<body>
		<?php
			session_start();
            if (!isset($_SESSION['email'])) {
				header("Location: login.php");
			}
		?>

		<div>
			<h1 id="title">Inserir Local</h1>
			<form class="back-btn" action="../insert.php">
			    <input type="submit" value="Voltar" />
			</form>
		</div>

		<div class="table">
			<?php
				$latitude = $_REQUEST['latitude'];
				$longitude = $_REQUEST['longitude'];
				$nome = $_REQUEST['nome'];

				if(!isset($latitude) || $latitude == '') {
					echo("<p>ERROR: Não foi especificada uma latitude.</p>");
					return;
				}

				if(!isset($longitude) || $longitude == '') {
					echo("<p>ERROR: Não foi especificada uma longitude.</p>");
					return;
				}

				if(!isset($nome) || $nome == '') {
					echo("<p>ERROR: Não foi especificado um nome.</p>");
					return;
				}

				try{
					$host = "ec2-54-246-98-119.eu-west-1.compute.amazonaws.com";
					$user ="gurfrjwmuedfot";
					$password = "06e304a9e8b6c7b590df483952c65689eb12d16e4ea7443c44c688b8496f0639";
					$dbname = "d4f2uther4d3uk";
					$db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
					$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$sql = "INSERT INTO local_publico (latitude, longitude, nome)
					VALUES ('$latitude', '$longitude', '$nome')";

					$result = $db->prepare($sql);
					$result->execute();
					
					// Cleaning Up
					$result = null;
					$db = null;

					echo("<p>Local inserido com sucesso.</p>");
				}
				catch (PDOException $e)
				{
					echo("<p>ERROR: {$e->getMessage()}</p>");
				}
			?>
		</div>
	</body>
</html>