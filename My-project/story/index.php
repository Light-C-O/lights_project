<?php
require_once "../etc/config.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//input the findAll function into $courses
$courses = Course::findAll();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>All Courses</title>
        <link rel="stylesheet" href="course.css">
    </head>
    <body>
        <h1>Courses</h1>
        <!-- the navbar file and the flash_messsage file -->
        <?php require_once "../etc/navbar.php";?>
        <?php require_once "../etc/flash_message.php";?>
        <!-- link to the location of creating a new course -->
        <p><a href="course_create.php">Make New Course</a></p>
        <!-- check the number of courses, if more than 0, display all, using the findAll function above that is in $courses-->
        <?php if (count($courses) > 0 ): ?>
            <table>
                <thead>
                    <tr>
                        <th class= "ti">Title</th>
                        <th class= "des">Description</th>
                        <th class= "co">Code</th>
                        <th class= "dep">Department</th>
                        <th class= "act">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- a loop to push out each course with their info displayed  -->
                    <?php foreach($courses as $course): 
                        $department = Department::findById($course->department_id);
                        ?>
                        <tr class="obj">
                            <td class = "te"><?= $course->title ?></td>
                            <td class = "dn"><?= $course->description ?></td>
                            <td class = "ce"><?= $course->code ?></td>
                            <td class = "dt"><?= $department->title ?></td>
                            <td class = "an">
                                <a href="course_edit.php?id=<?= $course->id?>">Edit</a>
                                <form class="form-delete"action="course_delete.php" method="post">
                                    <input type="hidden" name="id" value="<?= $course->id?>">
                                    <input type="submit" value="Delete">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        <?php else: ?>
            <!-- if $courses is less than 0, meaning no courses, display the statement below -->
            <p>No courses found</p>
        <?php endif; ?>
        <?php require "../etc/navbar.php";?>
    </body>
</html>