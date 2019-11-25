<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../../style.css" />
	</head>
	<body>
		<div>
			<h1 id="title">Remover Anomalia</h1>
			<form class="back-btn" action="../../edit.html">
			    <input type="submit" value="Sair" />
			</form>
		</div>

		<div class="table">
			<?php
				$id = $_REQUEST['id'];
				try{
					$host = "ec2-54-246-98-119.eu-west-1.compute.amazonaws.com";
					$user ="gurfrjwmuedfot";
					$password = "06e304a9e8b6c7b590df483952c65689eb12d16e4ea7443c44c688b8496f0639";
					$dbname = "d4f2uther4d3uk";
					$db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
					$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					$sql = "DELETE FROM anomalia
					WHERE id='$id'";

					echo("<p>$sql</p>");
					$result = $db->prepare($sql);
					$result->execute();
					$db = null;
				}
				catch (PDOException $e)
				{
					echo("<p>ERROR: {$e->getMessage()}</p>");
				}
			?>
		</div>
	</body>
</html>