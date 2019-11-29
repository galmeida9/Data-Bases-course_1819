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
			<h1 id="title">Inserir proposta de correção</h1>
			<form class="back-btn" action="../insert.php">
			    <input class="button buttonSmall" type="submit" value="Voltar" />
			</form>
		</div>

		<div class="table">
			<?php
				require("../db_class.php");
				$texto = $_REQUEST['texto'];

				if(!isset($texto) || $texto == '') {
					echo("<p>ERRO: Não foi especificado um texto.</p>");
					return;
				}

				try{
					//DB Init
					$db = new DB();
					$db->debug_to_console("Connect");
					$db->connect();

					//INSERT Query
					$db->debug_to_console("Insert Query");
					$sql = "INSERT INTO proposta_de_correcao (email, data_hora, texto)
					VALUES ('$email', now(), '$texto')";
					$result = $db->query($sql);

					if ($result == true) {
						echo("<p>Proposta de correção inserida com sucesso.</p>");
					} 
					
					// Cleaning Up
					$result = null;
					unset($db);
				}
				catch (PDOException $e)
				{
					echo("<p>ERRO: Ação reservada a utilizadores qualificados.</p>");
				}
			?>
		</div>
	</body>
</html>