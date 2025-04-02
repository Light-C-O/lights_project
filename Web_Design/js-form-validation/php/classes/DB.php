<?php

class DB {
    private $conn;

    public function __construct() {
        $this->conn = null;
    }

    public function open() {
        if ($this->conn === null) {
            $server = 'localhost';
            $database = 'js_demo';
            $username = 'root';
            $password = '';

            $dsn = "mysql:host={$server};dbname={$database}";

            //When using the open(); it creates this PDO (PHP Data Object), it is an object used in excuting sql command in the database 

            //create one of those objects
            $this->conn = new PDO($dsn, $username,$password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
        }
        //and return that object
        return $this->conn;
        //back to the Author_Demo class
    }

    public function isOpen() {
        return $this->conn !== null;
    }

    public function close() {
        $this->conn = null;
    }
}