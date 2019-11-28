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
			<h1 id="title">Editar correção</h1>
			<form class="back-btn" action="../../edit.php">
			    <input class="button buttonSmall" type="submit" value="Voltar" />
			</form>
		</div>

		<div class="table">
			<?php
				$nro = $_REQUEST['nro'];
				$texto = $_REQUEST['texto'];

				try {
					$host = "ec2-54-246-98-119.eu-west-1.compute.amazonaws.com";
					$user ="gurfrjwmuedfot";
					$password = "06e304a9e8b6c7b590df483952c65689eb12d16e4ea7443c44c688b8496f0639";
					$dbname = "d4f2uther4d3uk";
					$db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
					$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					$sql = "UPDATE proposta_de_correcao SET texto = :texto, data_hora = now() WHERE nro = :nro;";
					$result = $db->prepare($sql);
					$result->execute([':nro' => $nro, ':texto' => $texto]);

					echo("<p>Proposta de correção editada com sucesso.</p>");

					//Cleaning up
					$result = null;
					$db = null;
				}
				catch (PDOException $e)
				{
					echo("<p>ERRO: {$e->getMessage()}</p>");
				}
			?>
		</div>
	</body>
</html>