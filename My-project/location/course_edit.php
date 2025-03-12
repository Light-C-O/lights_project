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
    $course = Course::findById($id);
    if($course === null) {
        throw new Exception("Course not found");
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
        <link rel="stylesheet" href="course.css">
    </head>

    <body>
    <?php require_once '../etc/navbar.php'?>
        <h2>Edit the Course Form</h2>
        <!-- go to update when clicking the submit button -->
        <form action="course_update.php" method="POST">
            <!-- hide the id of the course -->
            <input type="hidden" name="id" value="<?= $course->id ?>">
            <p>
                Title:
                <!-- the old(); states that the former input will still be stored as a default -->
                <input type="text" name="title" value="<?= old("title", $course->title) ?>"><span class="error"><?= error("title") ?></span>
            </p>

            <p>
                Description:
                <input type="text" name="description" value="<?= old("description", $course->description) ?>"><span class="error"><?= error("description") ?></span>
            </p>
            <p>
                Code:
                <input type="text" name="code" value="<?= old("code", $course->code) ?>"><span class="error"><?= error("code") ?></span>
            </p>
            <p>
                Department:
                <select name="department_id">
                    <option value="">Please choose department...</option>"
                    <option value="1"
                            <?= chosen("department_id", "1", $course->department_id) ? "selected" : "" ?>
                    >
                        Art Department
                    </option>
                    <option value="2"
                            <?= chosen("department_id", "2", $course->department_id) ? "selected" : "" ?>
                    >
                        Business Department</option>
                    <option value="3"
                            <?= chosen("department_id", "3", $course->department_id) ? "selected" : "" ?>
                    >
                        Science Department</option>
                </select>
                <span class="error"><?= error("department_id") ?></span>
            </p>
            <!-- once clicked, it will go to the course_update.php -->
            <button type="submit">Update</button>
            <!-- Will discard the new input, take the default input and go mack to the index.php unchanged -->
            <a href="index.php">Cancel</a>
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