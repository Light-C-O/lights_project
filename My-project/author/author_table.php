<?php
require_once "../etc/config.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//input the findAll function into $authors
$authors = Author::findAll();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>All Authors</title>
        <link rel="stylesheet" href="author.css">
    </head>
    <body>
        <h1>Authors</h1>
        <!-- the navbar file and the flash_messsage file -->
        <?php require_once "../etc/navbar.php";?>
        <?php require_once "../etc/flash_message.php";?>
        <!-- link to the location of creating a new author -->
        <p><a href="author_create.php">Make New Author</a></p>
        <!-- check the number of authors, if more than 0, display all, using the findAll function above that is in $authors-->
        <?php if (count($authors) > 0 ): ?>
            <table>
                <thead>
                    <tr>
                        <th class= "ti">Title</th>
                        <th class= "des">Description</th>
                        <th class= "cre">Credit Points</th>
                        <th class= "sem">Semester</th>
                        <th class= "act">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- a loop to push out each author with their info displayed  -->
                    <?php foreach($authors as $author): ?>
                        <tr>
                            <td class = "te"><?= $author->first_name ?></td>
                            <td class = "dn"><?= $author->last_name ?></td>
                            <td class = "an">
                                <a href="author_edit.php?id=<?= $author->id?>">Edit</a>
                                <form class="form-delete"action="author_delete.php" method="post">
                                    <input type="hidden" name="id" value="<?= $author->id?>">
                                    <input type="submit" value="Delete">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        <?php else: ?>
            <!-- if $authors is less than 0, meaning no authors, display the statement below -->
            <p>No authors found</p>
        <?php endif; ?>
        <?php require '../etc/navbar.php'?>
    </body>
</html>