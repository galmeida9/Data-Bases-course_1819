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
			<h1 id="title">Registar duplicado</h1>
			<form class="back-btn" action="../register.php">
			    <input type="submit" value="Voltar" />
			</form>
		</div>

		<div class="table">
			<?php
				require("../db_class.php");
				$item1 = $_REQUEST['item1'];
				$item2 = $_REQUEST['item2'];

				if(!isset($item1) || $item1 == '') {
					echo("<p>ERRO: O primeiro item não foi especificado.</p>");
					return;
				}

				if(!isset($item2) || $item2 == '') {
					echo("<p>ERRO: O segundo item não foi especificado.</p>");
					return;
				}

				if ($item1 == $item2) {
					echo("<p>ERRO: Selecione itens distintos.</p>");
					return;
				}

				try{
					//DB Init
					$db = new DB();
					$db->debug_to_console("Connect");
					$db->connect();

					//INSERT Query
					$db->debug_to_console("Insert Query");
					$sql = "INSERT INTO duplicado (item1, item2)
					VALUES ('$item1', '$item2')";
					$result = $db->query($sql);

					if ($result == true) {
						echo("<p>Duplicado registado com sucesso.</p>");
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