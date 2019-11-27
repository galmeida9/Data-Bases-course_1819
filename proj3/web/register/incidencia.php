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
			<h1 id="title">Registar incidência</h1>
			<form class="back-btn" action="../register.php">
			    <input type="submit" value="Voltar" />
			</form>
		</div>

		<div class="table">
			<?php
				require("../db_class.php");
				$anomalia_id = $_REQUEST['anomalia_id'];
				$item_id = $_REQUEST['item_id'];

				if(!isset($anomalia_id) || $anomalia_id == '') {
					echo("<p>ERROR: Não foi especificada uma anomalia.</p>");
					return;
				}

				if(!isset($item_id) || $item_id == '') {
					echo("<p>ERROR: Não foi especificado um item.</p>");
					return;
				}

				try{
					//DB Init
					$db = new DB();
					$db->debug_to_console("Connect");
					$db->connect();

					//INSERT Query
					$db->debug_to_console("Insert Query");
					$sql = "INSERT INTO incidencia (anomalia_id, item_id, email)
					VALUES ('$anomalia_id', '$item_id', '$email')";
					$result = $db->query($sql);

					if ($result == true) {
						echo("<p>Incidência registada com sucesso.</p>");
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