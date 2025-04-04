<?php

class Author_Demo {
        //State the variables
    public $id;
    public $first_name;
    public $last_name;

 //ALL FUNCTIONS

  //--Construct
    //when creating author_demo, give it an array with info of what to put in the author_demo
    //This what will be used anytime a author_demo needs to be created

    //props is first equal to null, meaning not there
    public function __construct($props = null) {
        //if there are props, display the props stated below
        if ($props != null) {
            //check if the props array has a key called id 
            //and if it does bring an id with the props
            if (array_key_exists("id", $props)) {
                $this->id = $props["id"];
            }
            //regardless of an id existing, still show the below and  if none exists, assign an id
            $this->first_name = $props["first_name"];
            $this->last_name  = $props["last_name"];
        }
    }
  //

  //Save
    public function save() {
        //database will be stated an not open
        $db = null;
        try {
            //Access the database
            $db = new DB();
            //Use the open function to open the database
            $conn = $db->open();
        
            $params = [
                ":first_name" => $this->first_name,
                ":last_name"  => $this->last_name
            ];

            //If there is no id
            if ($this->id === null) {
                $sql = 
                "INSERT INTO author_demos" .
                "(first_name, last_name)" .
                "VALUES (:first_name, :last_name)";
            }
            else {//otherwise update the data where id is mentioned
                $sql = 
                "UPDATE author_demos SET " .
                "first_name = :first_name, " .
                "last_name = :last_name " .
                "WHERE id = :id" ;

                $params[":id"] = $this->id;
            }
            //Prepare this install in the database through sql and execute whatever is inside the $params. Input that another variable called $status
            $stmt = $conn->prepare($sql);
            $status = $stmt->execute($params);

            //There is no status throw out a message of error
            if(!$status) {
                $error_info = $stmt->errorInfo();
                $message = sprintf(
                    "SQLSTATE error code: %d; error message: %s",
                $error_info[0],
                $error_info[2]
                );
                throw new Exception($message);
            }
        
            //If no row has been affected, which means nothing had been inputed or updated, throw out a message that the author_demo has not been saved, therefore no author_demo
            if($stmt->rowCount() !==1) {
                throw new Exception("[AUTHOR_DEMO REMAINS UNCHANGED]");
            }
        
            //This is related to the insert, meaning,  no id. If no id, then take the last id that was inserted from the 'lastInsertId();'
            if ($this->id === null) {
                $this->id = $conn->lastInsertId();
            }
        }
        finally {
            //Check if the database is not empty & is open. If it is, close the database
            if ($db !== null && $db->isOpen()) {
                $db->close();
            }
        }
    }
  //

    //Delete
        public function delete() {
            //Make databse no available
            $db = null;
            try {
                if ($this->id !== null) {
                    //give access
                    $db = new DB();
                    //Use the open(); function for the database
                    $conn = $db->open();
            
                    //Delete in the sql whatever id is stated
                    $sql = "DELETE FROM author_demos WHERE id = :id" ;
                    $params = [
                        ":id" => $this->id
                    ];
                    
                    //Prepare this install in the database through sql and execute whatever is inside the $params. Input that another variable called $status
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
                    //If no row has been affected, which means nothing had been deleted, throw out a message that the author_demo has not been deleted, therefore author_demo still remains
                    if($stmt->rowCount() !==1) {
                        throw new Exception("[AUTHOR REMAINS UNCHANGED]");
                    }
                    //the id will now be null if it has been deleted succesfully
                    $this->id = null;
                }
            }
            finally {
                //Check if the database is not empty & is open. If it is close the database
                if ($db !== null && $db->isOpen()) {
                    $db->close();
                }
            }
        }
    //

   //--Find all info (no manipulation)
    public static function findAll() {
        $author_demos = array();

        try {
            $db = new DB();
            //Go to DB.php - open() location
            //the $conn is now one of the PDO, and we use that for what to do in the database
            $conn = $db->open();

            //Show everything that is in author_demos table
            $sql = "SELECT * FROM author_demos";

            //Prepare this install what is in $sql and execute whatever is inside the $params. Input that another variable called $status to be viewed in the database
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
                    $author_demos[] = $author_demo;

                    //this reads the next row
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                }

            }
        }
        finally {
            //Check if the database is occupied & is open regardless if everthing when soomthly or not. If it is open, close the database
            if ($db !== null && $db->isOpen()) {
                $db->close();
            }
        }
        //returns the value of that array
        return $author_demos;
    }
  //

  //--Find by an id (no manipulation)
    public static function findById($id) {
        //author_demo starts as null
        $author_demo = null;

        try {
            //open and connect to the database
            $db = new DB();
            $conn = $db->open();

            //Show everything that is in author_demos table based on the id stated below
            //have query with a id placeholder
            $sql = "SELECT * FROM author_demos WHERE id = :id";
            $params = [
                ":id" => $id
            ];
            //Prepare this install what is in $sql and execute whatever is inside the $params. Input that another variable called $status to be viewed in the database
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

            if ($stmt->rowCount() !== 0) {
                //if everything goes okay, fetch the first row when excuting the query
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                //then create a Author_Demo object out of the row
                $author_demo = new Author_Demo($row);
            }
        }
        finally {
            //then create a Author_Demo object out of the row
            if ($db !== null && $db->isOpen()) {
                $db->close();
            }
        }

        //then return that value that is now inside $author_demo
        return $author_demo;
    }
  //

 //
}
?>