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
    $category = Category::findById($id);
    if($category === null) {
        throw new Exception("Category not found");
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
        <link rel="stylesheet" href="category.css">
    </head>

    <body>
    <p><a href="/intProj/lights_project/My-project/etc/edit_navbar.php">Edit Another Section</a></p>
        <h2>Edit the Category Form</h2>
        <!-- go to update when clicking the submit button -->
        <form action="category_update.php" method="POST">
            <!-- hide the id of the category -->
            <input type="hidden" name="id" value="<?= $category->id ?>">
            <p>
                Name:
                <!-- the old(); states that the former input will still be stored as a default -->
                <input type="text" name="name" value="<?= old("name", $category->name) ?>"><span class="error"><?= error("name") ?></span>
            </p>
            <!-- once clicked, it will go to the course_update.php -->
            <button type="submit">Update</button>
            <!-- Will discard the new input, take the default input and go mack to the category_tab.php unchanged -->
            <a href="category_tab.php">Cancel</a>
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