<?php
require_once "../etc/config.php";
require_once "../etc/global.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try{
    if($_SERVER["REQUEST_METHOD"] !== "GET") {
        throw new Exception("Invaild request method");
    }
    if(!array_key_exists("id", $_GET)) {
        throw new Exception("Invaild request parameters");
    }
    $id = $_GET["id"];
    $author = Author::findById($id);
    if($author === null) {
        throw new Exception("Author not found");
    }
}
catch(Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit</title>
        <link rel="stylesheet" href="author.css">
    </head>

    <body>
    <?php require_once '../etc/navbar.php'?>
        <h2>Edit the Author Form</h2>
        <!-- go to update when clicking the submit button -->
        <form action="author_update.php" method="POST">
            <!-- hide the id of the author -->
            <input type="hidden" name="id" value="<?= $author->id ?>">
            <p>
                First Name:
                <!-- the old(); states that the former input will still be stored as a default -->
                <input type="text" name="first_name" value="<?= old("first_name", $author->first_name) ?>"><span class="error"><?= error("first_name") ?></span>
            </p>

            <p>
                Last Name:
                <!-- the old(); states that the former input will still be stored as a default -->
                <input type="text" name="last_name" value="<?= old("last_name", $author->last_name) ?>"><span class="error"><?= error("last_name") ?></span>
            </p>
            <!-- once clicked, it will go to the course_update.php -->
            <button type="submit">Update</button>
            <!-- Will discard the new input, take the default input and go mack to the index.php unchanged -->
            <a href="author_table.php">Cancel</a>
        </form>
        <?php require_once "../etc/flash_message.php";?>
    </body>
</html>
<?php
// refresh and remove session
if (array_key_exists("form-data", $_SESSION)) {
    unset($_SESSION["form-data"]);
}
if (array_key_exists("form-errors", $_SESSION)) {
    unset($_SESSION["form-errors"]);
}
?>