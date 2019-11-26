<?php

require_once("db_credentials.php");

class DB {

    var $HOST = HOST;
    var $DATABASE = DATABASE;
    var $USER = USER;
    var $PORT = PORT;
    var $PASSWORD = PASSWORD;
    var $dbObj;
    var $debug;

    public function __construct($debug){
        $this->debug = $debug;
    }

    public function connect(){
        try {
            $this->dbObj = new PDO("pgsql:host=$this->HOST;dbname=$this->DATABASE", $this->USER, $this->PASSWORD);
            $this->dbObj->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) {
            return $this->debug_to_console($e->getMessage());
        }
    }

    public function query($sql){
        try {
            $result = $this->dbObj->prepare($sql);
            $result->execute();
            return $result;
        }
        catch (PDOException $e) {
            return $this->debug_to_console($e->getMessage());
        }
    }

    public function debug_to_console($data) {
        if (!$this->debug) return;
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo("<script>console.log('DB Debug: " . $output . "' );</script>");
    }
}

?>