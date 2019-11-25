<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="login/login.css" />
    </head>

    <body>
        <?php
            session_start();
        ?>

        <form action="" method="post" id="login">
            <div class="imgcontainer">
                <img src="resources/logo.png" alt="logo" class="logo">
            </div>
          
            <div class="container">
                <label for="uname"><b>Email</b></label>
                <input type="text" placeholder="Enter Username" name="uname" required>
            
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>
            
                <button type="submit">Login</button>
            </div>
        </form>

        <?php
            $username = $_REQUEST['uname'];
            $psw = $_REQUEST['psw'];
            try{
                $host = "ec2-54-246-98-119.eu-west-1.compute.amazonaws.com";
                $user ="gurfrjwmuedfot";
                $password = "06e304a9e8b6c7b590df483952c65689eb12d16e4ea7443c44c688b8496f0639";
                $dbname = "d4f2uther4d3uk";
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT psw FROM utilizador WHERE email = '$username';";

                $result = $db->prepare($sql);
                $result->execute();
                $isEmpty = 1;
                foreach($result as $row) {
                    $realPsw = $row['psw'];
                    if ($realPsw == $psw) {
                        $_SESSION['email'] = $username;
                        header("Location: index.html");
                    }
                    else {
                        echo("<center class='error'>Wrong password.</center>");
                    }
                    $isEmpty = 0;
                    break;
                }
                if ($isEmpty && $username != "") {
                    echo("<center class='error'>Wrong email.</center>");
                }
                $db = null;
            }
            catch (PDOException $e)
            {
                echo("<p>ERROR: {$e->getMessage()}</p>");
            }
        ?>
    </body>

    <script>
    </script>
</html>