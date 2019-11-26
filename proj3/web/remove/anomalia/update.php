<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../../style.css" />
	</head>
	<body>
		<?php
			session_start();
            if (!isset($_SESSION['email'])) {
				header("Location: login.php");
			}
		?>

		<div>
			<h1 id="title">Remover Anomalia</h1>
			<form class="back-btn" action="../../edit.php">
			    <input type="submit" value="Sair" />
			</form>
		</div>

		<div class="table">
			<?php
				require("../../db_class.php");
				$id = $_REQUEST['id'];
				try{
					//DB Init
					$db = new DB();
					$db->debug_to_console("Connect");
					$db->connect();

					//DELETE Query
					$db->debug_to_console("Delete Query");
					$sql = "DELETE FROM anomalia WHERE id='$id'";
					$result = $db->query($sql);

					// Cleaning Up
					$result = null;
					unset($db);

					echo("<p>Anomalia removida com sucesso.</p>");
				}
				catch (PDOException $e)
				{
					echo("<p>ERROR: {$e->getMessage()}</p>");
				}
			?>
		</div>
	</body>
</html>