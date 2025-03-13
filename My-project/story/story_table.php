<?php
require_once "../etc/config.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//input the findAll function into $stories
$stories = Story::findAll();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>All Stories</title>
        <link rel="stylesheet" href="story.css">
    </head>
    <body>
        <h1>Stories</h1>
        <!-- the navbar file and the flash_messsage file -->
        <?php require_once "../etc/navbar.php";?>
        <?php require_once "../etc/flash_message.php";?>
        <!-- link to the location of creating a new story -->
        <p><a href="story_create.php">Make New Story</a></p>
        <!-- check the number of stories, if more than 0, display all, using the findAll function above that is in $stories-->
        <?php if (count($stories) > 0 ): ?>
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
                    <!-- a loop to push out each story with their info displayed  -->
                    <?php foreach($stories as $story): 
                        $sto = sto::findById($story->department_id);
                        $department = aur::findById($story->department_id);
                        $department = Department::findById($story->department_id);
                        ?>
                        <tr class="obj">
                            <td class = "te"><?= $story->title ?></td>
                            <td class = "dn"><?= $story->description ?></td>
                            <td class = "ce"><?= $story->code ?></td>
                            <td class = "dt"><?= $aut->$author->first_name, $author->last_name ?></td>
                            <td class = "dt"><?= $department->title ?></td>
                            <td class = "dt"><?= $department->title ?></td>
                            <td class = "an">
                                <a href="story_edit.php?id=<?= $story->id?>">Edit</a>
                                <form class="form-delete"action="story_delete.php" method="post">
                                    <input type="hidden" name="id" value="<?= $story->id?>">
                                    <input type="submit" value="Delete">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        <?php else: ?>
            <!-- if $storys is less than 0, meaning no stories, display the statement below -->
            <p>No stories found</p>
        <?php endif; ?>
        <?php require "../etc/navbar.php";?>
    </body>
</html>