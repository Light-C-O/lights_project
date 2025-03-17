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
        <?php require_once "../etc/edit_navbar.php";?>
        <?php require_once "../etc/flash_message.php";?>
        <!-- link to the location of creating a new story -->
        <p><a href="story_create.php">Make New Story</a></p>
        <!-- check the number of stories, if more than 0, display all, using the findAll function above that is in $stories-->
        <?php if (count($stories) > 0 ): ?>
            <table>
                <thead>
                    <tr>
                        <th class= "hd">Headline</th>
                        <th class= "shd">Short headline</th>
                        <th class= "st">Status</th>
                        <th class= "ar">Article</th>
                        <th class= "im">Image</th>
                        <th class= "imd">Image description</th>
                        <th class= "au">Author</th>
                        <th class= "ca">Category</th>
                        <th class= "ln">Location</th>
                        <th class= "act">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- a loop to push out each story with their info displayed  -->
                    <?php foreach($stories as $story): 
                        $author = Author::findById($story->author_id);
                        $category = Category::findById($story->category_id);
                        $location = Location::findById($story->location_id);
                        ?>
                        <tr class="obj">
                            <td class = "hed"><?= $story->headline ?></td>
                            <td class = "sho"><?= $story->short_headline ?></td>
                            <td class = "sat"><?= $story->status ?></td>
                            <td class = "art"><?= $story->article ?></td>
                            <td class = "url"><?= $story->img_url ?></td>
                            <td class = "dep"><?= $story->img_description ?></td>
                            <td class = "aut"><?= $author->$author->first_name , $author->last_name ?></td>
                            <td class = "cat"><?= $category->name ?></td>
                            <td class = "loc"><?= $location->name ?></td>

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
        <?php require "../etc/edit_navbar.php";?>
    </body>
</html>