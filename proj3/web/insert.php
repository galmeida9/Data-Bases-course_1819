<!DOCTYPE html>
<html>
	<script>
		function goBack() {
		  window.history.back();
		}
	</script>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="style.css" />
	</head>
	<body>
		<?php
			session_start();
            if (!isset($_SESSION['email'])) {
				header("Location: login.php");
			}
		?>
		
		<div class="sidenav">
			<a href="index.php">Home</a>
			<a class="active" href="">Inserir</a>
			<a href="edit.php">Editar</a>
			<a href="view.php">Visualizar</a>
			<a href="register.php">Registar</a>
			<a href="logout.php" class="logout">Logout</a>
		</div>

		<div id="tr" class="main">
			<h1 id="title">Inserir</h1>

			<div class="row">
				<div class="column">
					<b>Local</b>
					<form action="insert/place.php" method="post">
						<p>
							<label for="a">Latitude:</label>
							<input id="a" type="text" name="latitude">
						</p>
						<p>
							<label for="b">Longitude:</label>
							<input id="b" type="text" name="longitude">
						</p>
						<p>
							<label for="b">Nome:</label>
							<input id="b" type="text" name="nome">
						</p>
						<p> <input id="submit-btn" type="submit" value="Submit"/> </p>
					</form>
				</div>
				
				<div class="column">
					<b>Item</b>
					<form action="insert/item.php" method="post">
						<p>
							<label for="a">Descrição:</label>
							<input id="a" type="text" name="descricao">
						</p>
						<p>
							<label for="b">Localização:</label>
							<input id="b" type="text" name="localizacao">
						</p>
						<p>
							<label for="b">Local:</label>
							<select name="local">
							<?php
								try{
									$host = "ec2-54-246-98-119.eu-west-1.compute.amazonaws.com";
									$user ="gurfrjwmuedfot";
									$password = "06e304a9e8b6c7b590df483952c65689eb12d16e4ea7443c44c688b8496f0639";
									$dbname = "d4f2uther4d3uk";
									$db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
									$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

									$sql = "SELECT nome FROM local_publico";
									$result = $db->prepare($sql);
									$result->execute();

									foreach($result as $row) {
										$local = $row['nome'];
										printf('<option value="%1$s">%1$s</option>', $local);
									}
									
									// Cleaning Up
									$result = null;
									$db = null;
								}
								catch (PDOException $e)
								{
									echo("<p>ERROR: {$e->getMessage()}</p>");
								}
							?>
							</select>
						</p>
						<p> <input id="submit-btn" type="submit" value="Submit"/> </p>
					</form>
				</div>

				<div class="column">
					<b>Anomalia</b>
					<form action="insert/anomalia.php" method="post">
						<p>
							<label for="a">Zona:</label>
							<input id="a" type="text" name="zona">
						</p>
						<p>
							<label for="b">Imagem:</label>
							<input id="b" type="text" name="imagem">
						</p>
						<p>
							<label for="b">Língua:</label>
							<input id="b" type="text" name="lingua">
						</p>
						<p>
							<label for="b">Descrição:</label>
							<input id="b" type="text" name="descricao">
						</p>
						<p>
							<label for="b">Anomalia Redação?:</label>
							<input id="b" type="checkbox" name="tem_anomalia_redacao" value="Yes">
						</p>
						<p> <input id="submit-btn" type="submit" value="Submit"/> </p>
					</form>
				</div>
			</div>

			<div class="row">
				<div class="column">
					<b>Correção</b>
					<form action="" method="post">
						<p>
							<label for="b">ID Anomalia:</label>
							<input id="b" type="text" name="anomalia_id">
						</p>
						<p> <input id="submit-btn" type="submit" value="Submit"/> </p>
					</form>
				</div>
				
				<div class="column">
					<b>Proposta de correção</b>
					<form action="" method="post">
						<p>
							<label for="b">Texto:</label>
							<input id="b" type="text" name="texto">
						</p>
						<p> <input id="submit-btn" type="submit" value="Submit"/> </p>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
