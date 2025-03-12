<?php
require_once "../etc/config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//pull out all the info from the Departement classs
$departments = Department::findAll();
?>

<!DOCTYPE html>
<html lang="eng">
    <head>
        <title>Create a Author Form</title>
        <link rel="stylesheet" href="author.css">
    </head>

    <body>
        <?php require_once "../etc/navbar.php";?>
        <?php require_once "../etc/flash_message.php";?>
        <!-- Create in a new author -->
        <h2>New Author Form</h2>
        <form action="author_store.php" method="POST">
            <p>
                First Name:
                <!-- Input first name for the author, place an error if the requirement was not met-->
                <input type="text" name="first_name" value="<?= old("first_name") ?>"><span class="error"><?= error("first_name") ?></span>
            </p>

            <p>
                Last Name:
                <!-- Input last name for the author, place an error if the requirement was not met-->
                <input type="text" name="last_name" value="<?= old("last_name") ?>"><span class="error"><?= error("last_name") ?></span>
            </p>
            <!-- Once you press on the submit button, it goes to store, if there are errors, it comes back to create and shows the errors made-->
            <button type="submit">Store</button>
            <!-- click on cancel to back to the All Authors page -->
            <a href="index.php">Cancel</a>
        </form>
    </body>
</hmtl>
<?php
//if you refesh, everthing written will be removed, both the error message and the data inputed
if (array_key_exists("form-data", $_SESSION)) {
    unset($_SESSION["form-data"]);
    
}
if (array_key_exists("form-errors", $_SESSION)) {
    unset($_SESSION["form-errors"]);
    
}
?>