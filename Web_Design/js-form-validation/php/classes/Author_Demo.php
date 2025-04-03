<?php

class Author_Demo {
    public $id;
    public $first_name;
    public $last_name;

    public function __construct($props = null) {
        if ($props != null) {
            if (array_key_exists("id", $props)) {
                $this->id = $props["id"];
            }
            $this->first_name = $props["first_name"];
            $this->last_name  = $props["last_name"];
        }
    }

    public function save() {
        $db = null;
        try {
            $db = new DB();
            $conn = $db->open();
        
            $params = [
                ":first_name" => $this->first_name,
                ":last_name"  => $this->last_name
            ];

            if ($this->id === null) {
                $sql = 
                "INSERT INTO authors_demo" .
                "(first_name, last_name)" .
                "VALUES (:first_name, :last_name)";
            }
            else {
                $sql = 
                "UPDATE authors_demo SET " .
                "first_name = :first_name, " .
                "last_name = :last_name " .
                "WHERE id = :id" ;

                $params[":id"] = $this->id;
            }
            $stmt = $conn->prepare($sql);
            $status = $stmt->execute($params);

            if(!$status) {
                $error_info = $stmt->errorInfo();
                $message = sprintf(
                    "SQLSTATE error code: %d; error message: %s",
                $error_info[0],
                $error_info[2]
                );
                throw new Exception($message);
            }
        
            if($stmt->rowCount() !==1) {
                throw new Exception("[AUTHOR REMAINS UNCHANGED]");
            }
        
            if ($this->id === null) {
                $this->id = $conn->lastInsertId();
            }
        }
        finally {
            if ($db !== null && $db->isOpen()) {
                $db->close();
            }
        }
    }

    public function delete() {
        $db = null;
        try {
            if ($this->id !== null) {
                $db = new DB();
                $conn = $db->open();
        
                $sql = "DELETE FROM authors_demo WHERE id = :id" ;
                $params = [
                    ":id" => $this->id
                ];
                $stmt = $conn->prepare($sql);
                $status = $stmt->execute($params);
        
                //There is no status in the first place throw out a message of error
                if(!$status) {
                    $error_info = $stmt->errorInfo();
                    $message = sprintf(
                        "SQLSTATE error code: %d; error message: %s",
                        $error_info[0],
                        $error_info[2]
                    );
                    throw new Exception($message);
                }
                //If no row has been affected, which means nothing had been deleted, throw out a message that the course has not been deleted, therefore course still remains
                if($stmt->rowCount() !==1) {
                    throw new Exception("[AUTHOR REMAINS UNCHANGED]");
                }
                //the id will now be null if it has been deleted succesfully
                $this->id = null;
            }
        }
        finally {
            if ($db !== null && $db->isOpen()) {
                $db->close();
            }
        }
    }

    public static function findAll() {
        $authors_demo = array();

        try {
            $db = new DB();
            $conn = $db->open();

            $sql = "SELECT * FROM authors_demo";
            $stmt = $conn->prepare($sql);
            $status = $stmt->execute();

            //When excuting, you get a status that will be either true or false
            //There is no status (false), something went wrong 
            if(!$status) {
                $error_info = $stmt->errorInfo();
                $message = sprintf(
                    "SQLSTATE error code: %d; error message: %s",
                    $error_info[0],
                    $error_info[2]
                );
            //Then throw out a message of error
                throw new Exception($message);
            }


            //checks if the first row is not 0, since we are not using 0
            if($stmt->rowCount() !== 0) {
                //Fetches the first row on the table
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                while ($row !== FALSE) {
                    //fetch row and using to create a Author_Demo object
                    $author_demo = new Author_Demo($row);
                    //put it into this array below
                    $authors_demo[] = $author_demo;

                    //this reads the next row
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                }

            }
        }
        finally {
            if ($db !== null && $db->isOpen()) {
                $db->close();
            }
        }

        return $authors_demo;
    }

    public static function findById($id) {
        $author_demo = null;

        try {
            $db = new DB();
            $conn = $db->open();

            $sql = "SELECT * FROM authors_demo WHERE id = :id";
            $params = [
                ":id" => $id
            ];
            $stmt = $conn->prepare($sql);
            $status = $stmt->execute($params);

            if(!$status) {
                $error_info = $stmt->errorInfo();
                $message = sprintf(
                    "SQLSTATE error code: %d; error message: %s",
                    $error_info[0],
                    $error_info[2]
                );
                throw new Exception($message);
            }

            if ($stmt->rowCount() !== 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $author_demo = new Author_Demo($row);
            }
        }
        finally {
            if ($db !== null && $db->isOpen()) {
                $db->close();
            }
        }

        return $author_demo;
    }
}
?>