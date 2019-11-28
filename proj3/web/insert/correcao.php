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
			    <input class="button buttonSmall" type="submit" value="Voltar" />
			</form>
		</div>

		<div class="table">
			<?php
				require("../db_class.php");
				$anomalia_id = $_REQUEST['anomalia_id'];
				$nro = $_REQUEST['nro'];

				if(!isset($anomalia_id) || $anomalia_id == '') {
					echo("<p>ERRO: Não foi especificada um ID de anomalia.</p>");
					return;
				}

				try{
					//DB Init
					$db = new DB();
					$db->debug_to_console("Connect");
					$db->connect();

					//INSERT Query
					$db->debug_to_console("Insert Query");
					$sql = "INSERT INTO correcao (email, nro, anomalia_id)
					VALUES ('$email', '$nro', '$anomalia_id')";
					$result = $db->query($sql);
					

					if ($result == true) {
						echo("<p>Correção inserida com sucesso.</p>");
					} 

					// Cleaning Up
					$result = null;
					unset($db);
				}
				catch (PDOException $e)
				{
					echo("<p>ERRO: {$e->getMessage()}</p>");
				}
			?>
		</div>
	</body>
</html>