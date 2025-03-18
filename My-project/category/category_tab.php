<?php
require_once "../etc/config.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//input the findAll function into $categories
$categories = Category::findAll();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>All Categories</title>
        <link rel="stylesheet" href="category.css">
    </head>
    <body>
        <h1>Categories</h1>
        <!-- the navbar file and the flash_messsage file -->
        <?php require_once "../etc/edit_navbar.php";?>
        <?php require_once "../etc/flash_message.php";?>
        <!-- link to the location of creating a new category -->
        <p><a href="category_create.php">Make New Category</a></p>
        <!-- check the number of categories, if more than 0, display all, using the findAll function above that is in $categories-->
        <?php if (count($categories) > 0 ): ?>
            <table>
                <thead>
                    <tr>
                        <th class= "ti">Name</th>
                        <th class= "act">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- a loop to push out each category with their info displayed  -->
                    <?php foreach($categories as $category): ?>
                        <tr>
                            <td class = "te"><?= $category->name ?></td>
                            <td class = "an">
                                <a href="category_edit.php?id=<?= $category->id?>">Edit</a>
                                <form class="form-delete"action="category_delete.php" method="post">
                                    <input type="hidden" name="id" value="<?= $category->id?>">
                                    <input type="submit" value="Delete">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        <?php else: ?>
            <!-- if $categories is less than 0, meaning no categories, display the statement below -->
            <p>No categories found</p>
        <?php endif; ?>
    </body>
</html>