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
        try {
            $db = new DB();
            $db->open();
            $conn = $db->getConnection();
        
            $params = [
                ":first_name" => $this->first_name,
                ":last_name"  => $this->last_name
            ];

            if ($this->id === null) {
                $sql = "INSERT INTO authors_demo" .
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
        
            if (!$status) {
                $error_info = $stmt->errorInfo();
                $message = "SQLSTATE error code = ".$error_info[0]."; error message = ".$error_info[2];
                throw new Exception("Database error executing database query: " . $message);
            }
        
            if ($stmt->rowCount() !== 1) {
                throw new Exception("Failed to save author_demo.");
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
                $db->open();
                $conn = $db->getConnection();
        
                $sql = "DELETE FROM authors_demo WHERE id = :id" ;
                $params = [
                    ":id" => $this->id
                ];
                $stmt = $conn->prepare($sql);
                $status = $stmt->execute($params);
        
                if (!$status) {
                    $error_info = $stmt->errorInfo();
                    $message = "SQLSTATE error code = ".$error_info[0]."; error message = ".$error_info[2];
                    throw new Exception("Database error executing database query: " . $message);
                }
        
                if ($stmt->rowCount() !== 1) {
                    throw new Exception("Failed to delete author_demo.");
                }
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
            $db->open();
            $conn = $db->getConnection();

            $sql = "SELECT * FROM authors_demo";
            $stmt = $conn->prepare($sql);
            $status = $stmt->execute();

            if (!$status) {
                $error_info = $stmt->errorInfo();
                $message = "SQLSTATE error code = ".$error_info[0]."; error message = ".$error_info[2];
                throw new Exception("Database error executing database query: " . $message);
            }

            if ($stmt->rowCount() !== 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                while ($row !== FALSE) {
                    $author_demo = new Author_Demo($row);
                    $authors_demo[] = $author_demo;

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
            $db->open();
            $conn = $db->open();

            $sql = "SELECT * FROM authors_demo WHERE id = :id";
            $params = [
                ":id" => $id
            ];
            $stmt = $conn->prepare($sql);
            $status = $stmt->execute($params);

            if (!$status) {
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