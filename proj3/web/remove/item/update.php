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
				header("Location: ../../login/login.php");
			}
		?>

		<div>
			<h1 id="title">Remover item</h1>
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
					$db->debug_to_console("Query");
					$sql = "DELETE FROM item WHERE id='$id'";
					$result = $db->query($sql);

					if ($result == true) {
						echo("<p>Item removido com sucesso.</p>");
					}

					//Cleaning up
					unset($db);
					$result = null;
				}
				catch (PDOException $e)
				{
					echo("<p>ERRO: {$e->getMessage()}</p>");
				}
			?>
		</div>
	</body>
</html>