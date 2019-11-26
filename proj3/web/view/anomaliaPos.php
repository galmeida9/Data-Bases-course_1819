<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../style.css" />
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
				header("Location: ../login.php");
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
                    require("../db_class.php");
                    $lat = $_REQUEST['lat'];
                    $long = $_REQUEST['long'];
                    $dx = $_REQUEST['dx'];
                    $dy = $_REQUEST['dy'];
                    $anomId = array();

                    //DB Init
                    $db = new DB();
                    $db->connect();

                    //SELECT Query
                    $db->debug_to_console("Query");
                    $sql = "SELECT anomalia_id, item_id, email FROM incidencia";
                    $result = $db->query($sql);

                    foreach($result as $row) {
                        $currentId = $row['anomalia_id'];
                        $sql2 = "SELECT latitude, longitude FROM item WHERE id = $currentId;";
                        $result2 = $db->query($sql2);

                        $row2 = $result2->fetch();
                        if ($row2['latitude'] > $lat - $dx && $row2['latitude'] < $lat + $dx &&
                            $row2['longitude'] > $long - $dy && $row2['longitude'] < $long + $dy) {
                                array_push($anomId, $row['anomalia_id']);
                        }
                    }

                    if (count($anomId) > 0) {
                        echo("<table border=\"1\" cellspacing=\"5\">\n");
                        echo("<tr><td>id</td><td>zona</td><td>imagem</td><td>língua</td><td>tempo</td><td>descrição</td><td>Anomalia Redação</td></tr>\n");
                        foreach($anomId as $id) {
                            $sql3 = "SELECT id, zona, imagem, lingua, ts, descricao, tem_anomalia_redacao FROM anomalia WHERE id = $id;";
                            $result3 = $db->query($sql3);
                            $row3 = $result3->fetch();

                            echo("<tr>\n");
                            echo("<td>{$row3['id']}</td>\n");
                            echo("<td>{$row3['zona']}</td>\n");
                            echo("<td>{$row3['imagem']}</td>\n");
                            echo("<td>{$row3['lingua']}</td>\n");
                            echo("<td>{$row3['ts']}</td>\n");
                            echo("<td>{$row3['descricao']}</td>\n");
                            echo("<td>{$row3['tem_anomalia_redacao']}</td>\n");
                            echo("</tr>\n");
                        }
                        echo("</table>\n");
                    }
                    else {
                        echo("<p>Não foram encontradas Anomalias</p>");
                    }
                        
                    // Cleaning Up
                    $result = null;
                    unset($db);
                ?>
            </div>
		</div>

	</body>
</html>