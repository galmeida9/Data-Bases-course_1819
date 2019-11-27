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

			$email = $_SESSION['email'];
		?>

		<div>
			<h1 id="title">Inserir correção</h1>
			<form class="back-btn" action="../insert.php">
			    <input type="submit" value="Voltar" />
			</form>
		</div>

		<div class="table">
			<?php
				require("../db_class.php");
				$anomalia_id = $_REQUEST['anomalia_id'];

				if(!isset($anomalia_id) || $anomalia_id == '') {
					echo("<p>ERROR: Não foi especificada um ID de anomalia.</p>");
					return;
				}

				try{
					//DB Init
					$db = new DB();
					$db->debug_to_console("Connect");
					$db->connect();

					//INSERT Query
					$db->debug_to_console("Insert Query");
					echo("<p>$email</p>");
					echo("<p>$anomalia_id</p>");
					$sql = "INSERT INTO correcao (email, anomalia_id)
					VALUES ('$email', '$anomalia_id')";
					$result = $db->query($sql);

					if (!result) {
						echo("ERROR\n");
					}
					
					// Cleaning Up
					$result = null;
					unset($db);

					echo("<p>Correção inserida com sucesso.</p>");
				}
				catch (PDOException $e)
				{
					echo("<p>ERROR: {$e->getMessage()}</p>");
				}
			?>
		</div>
	</body>
</html>