<?php
    require("db_class.php");
    $db = new DB();
    $db->connect();
    $db->executeFileQuery("schema.sql");
    $db->executeFileQuery("populate.sql");
    header("Location: index.php");
?>