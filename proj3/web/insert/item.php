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
			<h1 id="title">Inserir item</h1>
			<form class="back-btn" action="../insert.php">
			    <input type="submit" value="Voltar" />
			</form>
		</div>

		<div class="table">
			<?php
				require("../db_class.php");

				$descricao = $_REQUEST['descricao'];
				$localizacao = $_REQUEST['localizacao'];
				$local = $_REQUEST['local'];

				if(!isset($descricao) || $descricao == '') {
					echo("<p>ERROR: Não foi especificada uma descrição.</p>");
					return;
				}

				if(!isset($localizacao) || $localizacao == '') {
					echo("<p>ERROR: Não foi especificada uma localização.</p>");
					return;
				}

				if(!isset($local) || $local == '') {
					echo("<p>ERROR: Não foi especificado um local.</p>");
					return;
				}
				
				try {
					//DB Init
            		$db = new DB();
            		$db->debug_to_console("Connect");
            		$db->connect();
					
					//Begin Transaction
					$db->beginTransaction();

					//SELECT Query
					$db->debug_to_console("Select Query");
					$sql = "SELECT latitude, longitude FROM local_publico WHERE nome='$local' LIMIT 1;";
					$result = $db->queryTransaction($sql);

					$row = $result->fetch();
					$latitude = $row['latitude'];
					$longitude = $row['longitude'];
					
					//INSERT Query
					$db->debug_to_console("Insert Query");
					$sql = "INSERT INTO item (descricao, localizacao, latitude, longitude)
					VALUES ('$descricao', '$localizacao', '$latitude', '$longitude')";
					$result = $db->queryTransaction($sql);

					//Commit
					$db->commit();

					// Cleaning Up
					$result = null;
					unset($db);

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