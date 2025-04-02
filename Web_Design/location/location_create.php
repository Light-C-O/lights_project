<?php
require_once "../etc/config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="eng">
    <head>
        <title>Create a Location Form</title>
        <link rel="stylesheet" href="location.css">
    </head>

    <body>
        <?php require_once "../etc/edit_navbar.php";?>
        <?php require_once "../etc/flash_message.php";?>
        <!-- Create in a new location -->
        <h2>New Location Form</h2>
        <form action="location_store.php" method="POST">
            <!-- Input name for the location, place an error if the requirement was not met-->
            <p>
                Name:
                <!-- Input name for the location, place an error if the requirement was not met-->
                <input type="text" name="name" value="<?= old("name") ?>"><span class="error"><?= error("name") ?></span>
            </p>
            <!-- Once you press on the submit button, it goes to store, if there are errors, it comes back to create and shows the errors made-->
            <button type="submit">Store</button>
            <!-- click on cancel to back to the All Locations page -->
            <a href="location_tab.php">Go Back</a>
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