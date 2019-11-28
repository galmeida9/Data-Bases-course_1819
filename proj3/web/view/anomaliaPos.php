<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="../style.css" />
        <link rel="stylesheet" href="../modal.css" />
	</head>
	<body>
		<?php
			session_start();
            if (!isset($_SESSION['email'])) {
				header("Location: ../login.php");
			}
		?>
        
        <div class="sidenav">
            <a href="../index.php">Home</a>
            <a href="../insert.php">Inserir</a>
            <a href="../edit.php">Editar</a>
            <a href="../view.php">Visualizar</a>
            <a href="../register.php">Registar</a>
            <a href="../login/logout.php" class="logout">Logout</a>
        </div>

		<div id="tr" class="main">
			<h1 id="title">Anomalias numa vizinhança</h1>
            
            <form class="back-btn" action="../view.php">
                <input class="button buttonSmall" type="submit" value="Voltar" />
            </form>

            <div class="table">
                <?php
                    require("../db_class.php");
                    $lat = $_REQUEST['lat'];
                    $long = $_REQUEST['long'];
                    $dx = $_REQUEST['dx'];
                    $dy = $_REQUEST['dy'];
                    $anomId = array();

                    if(!isset($lat) || $lat == '') {
                        echo("<p>ERRO: Não foi especificada uma latitude.</p>");
                        return;
                    }

                    if(!isset($long) || $long == '') {
                        echo("<p>ERRO: Não foi especificada uma longitude.</p>");
                        return;
                    }

                    if(!isset($dx) || $dx == '') {
                        echo("<p>ERRO: O parâmetro dx não foi especificado.</p>");
                        return;
                    }

                    if(!isset($dy) || $dy == '') {
                        echo("<p>ERRO: O parâmetro dy não foi especificado.</p>");
                        return;
                    }

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
                        echo("<tr><td><b>ID</b></td><td><b>Zona</b></td><td><b>Imagem</b></td><td><b>Língua</b></td>");
                        echo("<td><b>Data/Hora</b></td><td><b>Descrição</b></td><td><b>Anomalia Redação?</b></td></tr>\n");
                        foreach($anomId as $id) {
                            $sql3 = "SELECT * FROM anomalia WHERE id = $id;";
                            $result3 = $db->query($sql3);
                            $row3 = $result3->fetch();

                            echo("<tr>\n");
                            echo("<td>{$row3['id']}</td>\n");
                            echo("<td>{$row3['zona']}</td>\n");
                            echo("<td><a onclick='showImg(\"{$row3['imagem']}\")'>imagem</a></td>\n");
                            echo("<td>{$row3['lingua']}</td>\n");
                            echo("<td>{$row3['ts']}</td>\n");
                            echo("<td>{$row3['descricao']}</td>\n");

                            if ($row3['tem_anomalia_redacao'] == 1) {
                                echo("<td>Sim</td>\n");
                            } else {
                                echo("<td>-</td>\n");
                            }

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

            <div id="myModal" class="modal">
                <span class="close">&times;</span>
                <img class="modal-content" id="img01">
            </div>
		</div>

    </body>
    
    <script src="../modal.js"></script>

</html>