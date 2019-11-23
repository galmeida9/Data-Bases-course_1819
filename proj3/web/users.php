<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="style.css" />
	</head>
	<script>
		function goBack() {
		  window.history.back();
		}
	</script>

	<body>
		<div>
			<h1 id="title">Utilizadores</h1>
			<button class="back-btn" onclick="goBack()">Voltar</button>
		</div>

		<div class="table">
			<?php
				try {
					$host = "db.ist.utl.pt";
					$user ="ist189522";
					$password = "hznv7019";
					$dbname = $user;
					$db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
					$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$sql = "SELECT account_number, branch_name, balance FROM account;";
					$result = $db->prepare($sql);
					$result->execute();
					echo("<table border=\"1\">\n");
					echo("<tr><td>account_number</td><td>branch_name</td><td>balance</td></tr>\n");
					foreach($result as $row) {
						echo("<tr><td>");
						echo($row['account_number']);
						echo("</td><td>");
						echo($row['branch_name']);
						echo("</td><td>");
						echo($row['balance']);
						echo("</td></tr>\n");
					}
					echo("</table>\n");
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