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
		<?php
			session_start();
            if (!isset($_SESSION['email'])) {
				header("Location: login.php");
			}
		?>
        
        <div class="sidenav">
			<a href="index.php">Home</a>
			<a href="insert.php">Inserir</a>
			<a href="edit.php">Editar</a>
			<a href="view.php">Visualizar</a>
			<a href="register.php">Registar</a>
			<a href="logout.php" class="logout">Logout</a>
		</div>

		<div id="tr" class="main">
			<h1 id="title">Visualizar</h1>
            
            <button class="button buttonSmall" onclick="goBack()" style="margin-left: 20pt;margin-bottom: 20pt;">Voltar</button>

            <div class="table">
                <?php
                    require("db_class.php");
                    try {
                        //DB Init
                        $db = new DB();
                        $db->debug_to_console("Connect");
                        $db->connect();

                        //SELECT Query
                        $db->debug_to_console("Query");
                        $sql = "SELECT id, zona, imagem, lingua, ts, descricao, tem_anomalia_redacao FROM anomalia;";
                        $result = $db->query($sql);

                        echo("<table border=\"1\" cellspacing=\"5\">\n");
                        echo("<tr><td>id</td><td>zona</td><td>imagem</td><td>língua</td><td>tempo</td><td>descrição</td><td>Anomalia Redação</td></tr>\n");
                        foreach($result as $row) {
                            echo("<tr>\n");
                            echo("<td>{$row['id']}</td>\n");
                            echo("<td>{$row['zona']}</td>\n");
                            echo("<td>{$row['imagem']}</td>\n");
                            echo("<td>{$row['lingua']}</td>\n");
                            echo("<td>{$row['ts']}</td>\n");
                            echo("<td>{$row['descricao']}</td>\n");
                            echo("<td>{$row['tem_anomalia_redacao']}</td>\n");
                            echo("</tr>\n");
                        }
                        echo("</table>\n");
                        
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
		</div>

	</body>
</html>