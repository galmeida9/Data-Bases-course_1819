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
			<h1 id="title">Correções</h1>
			<button class="back-btn" onclick="goBack()">Voltar</button>
		</div>

		<div class="table">
			<h3>Change balance for account <?=$_REQUEST['account_number']?></h3>
			<form action="update.php" method="post">
				<p><input type="hidden" name="account_number" value="<?=$_REQUEST['account_number']?>"/></p>
				<p>New balance: <input type="text" name="balance"/></p>
				<p><input type="submit" value="Submit"/></p>
			</form>
		</div>
	</body>
</html>