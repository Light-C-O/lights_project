<?php
require_once "../etc/config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="eng">
    <head>
        <title>Create a Category Form</title>
        <link rel="stylesheet" href="category.css">
    </head>

    <body>
        <p><a href="/intProj/lights_project/My-project/etc/edit_navbar.php">Edit Another Section</a></p>
        <?php require_once "../etc/flash_message.php";?>
        <!-- Create in a new category -->
        <h2>New Category Form</h2>
        <form action="category_store.php" method="POST">
            <!-- Input name for the category, place an error if the requirement was not met-->
            <p>
                Name:
                <!-- Input name for the category, place an error if the requirement was not met-->
                <input type="text" name="name" value="<?= old("name") ?>"><span class="error"><?= error("name") ?></span>
            </p>
            <!-- Once you press on the submit button, it goes to store, if there are errors, it comes back to create and shows the errors made-->
            <button type="submit">Store</button>
            <!-- click on cancel to back to the All Categories page -->
            <a href="category_table.php">Cancel</a>
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