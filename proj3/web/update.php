<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="style.css" />
	</head>
	<body>
		<div>
			<h1 id="title">Correções</h1>
			<form class="back-btn" action="edit.html">
			    <input type="submit" value="Sair" />
			</form>
		</div>

		<div class="table">
			<?php
				$account_number = $_REQUEST['account_number'];
				$balance = $_REQUEST['balance'];
				try{
					$host = "db.ist.utl.pt";
					$user ="ist189522";
					$password = "";
					$dbname = $user;
					$db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
					$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$sql = "UPDATE account SET balance = :balance WHERE account_number = :account_number;";echo("<p>$sql</p>");
					$result = $db->prepare($sql);
					$result->execute([':balance' => $balance, ':account_number' => $account_number]);
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