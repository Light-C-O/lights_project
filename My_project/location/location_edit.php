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
    $location = Location::findById($id);
    if($location === null) {
        throw new Exception("Location not found");
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
        <link rel="stylesheet" href="location.css">
    </head>

    <body>
    <p class = "edit"><a href="<?=$import?>etc/edit_navbar.php">Edit Another Section</a></p>
        <h2>Edit the Location Form</h2>
        <!-- go to update when clicking the submit button -->
        <form action="location_update.php" method="POST">
            <!-- hide the id of the location -->
            <input type="hidden" name="id" value="<?= $location->id ?>">
            <p>
                Name:
                <!-- the old(); states that the former input will still be stored as a default -->
                <input type="text" name="name" value="<?= old("name", $location->name) ?>"><span class="error"><?= error("name") ?></span>
            </p>
            <!-- once clicked, it will go to the course_update.php -->
            <button type="submit">Update</button>
            <!-- Will discard the new input, take the default input and go mack to the location_tab.php unchanged -->
            <a href="location_tab.php">Cancel</a>
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