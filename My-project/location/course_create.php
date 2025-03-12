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
        <title>Create a Course Form</title>
        <link rel="stylesheet" href="course.css">
    </head>

    <body>
        <?php require_once "../etc/navbar.php";?>
        <?php require_once "../etc/flash_message.php";?>
        <!-- Create in a new course -->
        <h2>New Course Form</h2>
        <form action="course_store.php" method="POST">
            <p>
                <!-- Input title for the course, place an error if the requirement was not met-->
                Title:
                <input type="text" name="title" value="<?= old("title") ?>"><span class=" error"><?= error("title") ?><span>
            </p>

            <p>
                <!-- Input description for the course, place an error if the requirement was not met-->
                Description:
                <input type="text" name="description" value="<?= old("description") ?>"><span class=" error"><?= error("description") ?><span>
            </p>
            <p>
                <!-- Input code for the course, place an error if the requirement was not met-->
                Code:
                <input type="text" name="code" value="<?= old("code") ?>"><span class=" error"><?= error("code") ?><span>
            </p>
            <p>
                <!-- Select the department for course, place an error if the requirement was not met-->
                Department:
                <select name="department_id">
                    <option value="">Please choose department...</option>"
                    <!-- a loop to dispaly an new department from the Department::findAll if added -->
                    <?php foreach($departments as $department): ?>
                    <!-- make an option to shows each new departemnt title -->
                    <option value="<?= $department->id ?>"  <?= chosen("department_id", $department->id) ? "selected" : "" ?>><?= $department->title ?></option>
                    <?php endforeach?>
                </select>
                <span class=" error"><?= error("department_id") ?><span>
            </p>
            <!-- Once you press on the submit button, it goes to store, if there are errors, it comes back to create and shows the errors made-->
            <button type="submit">Store</button>
            <!-- click on cancel to back to the All Courses page -->
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