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
				header("Location: ../login/login.php");
			}
		?>

		<div>
			<h1 id="title">Inserir local</h1>
			<form class="back-btn" action="../insert.php">
			    <input type="submit" value="Voltar" />
			</form>
		</div>

		<div class="table">
			<?php
				require("../db_class.php");
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
					//DB Init
					$db = new DB();
					$db->debug_to_console("Connect");
					$db->connect();

					//INSERT Query
					$db->debug_to_console("Insert Query");
					$sql = "INSERT INTO local_publico (latitude, longitude, nome)
					VALUES ('$latitude', '$longitude', '$nome')";
					$result = $db->query($sql);

					if ($result == true) {
						echo("<p>Local inserido com sucesso.</p>");
					} 
					
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