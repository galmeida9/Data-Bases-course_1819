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
			<h1 id="title">Inserir anomalia</h1>
			<form class="back-btn" action="../insert.php">
			    <input type="submit" value="Voltar" />
			</form>
		</div>

		<div class="table">
			<?php
				require("../db_class.php");
				$zona = $_REQUEST['zona'];
				$imagem = $_REQUEST['imagem'];
				$lingua = $_REQUEST['lingua'];
				$descricao = $_REQUEST['descricao'];
				$tem_anomalia_redacao = ($_POST['tem_anomalia_redacao'] == 'Yes') ? 'true' : 'false';

				if(!isset($zona) || $zona == '') {
					echo("<p>ERROR: Não foi especificada uma zona.</p>");
					return;
				}

				if(!isset($imagem) || $imagem == '') {
					echo("<p>ERROR: Não foi especificada uma imagem.</p>");
					return;
				}

				if(!isset($lingua) || $lingua == '') {
					echo("<p>ERROR: Não foi especificado uma língua.</p>");
					return;
				}

				if(!isset($descricao) || $descricao == '') {
					echo("<p>ERROR: Não foi especificada uma descrição.</p>");
					return;
				}

				try{
					//DB Init
					$db = new DB();
					$db->debug_to_console("Connect");
					$db->connect();

					//Insert Query
					$db->debug_to_console("Query");
					$sql = "INSERT INTO anomalia (zona, imagem, lingua, ts, descricao, tem_anomalia_redacao)
					VALUES ('$zona', '$imagem', '$lingua', now(),'$descricao', '$tem_anomalia_redacao')";
					$result = $db->query($sql);

					if ($result == true) {
						echo("<p>Anomalia inserida com sucesso.</p>");
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