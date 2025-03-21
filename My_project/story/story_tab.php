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
        <p class = "new"><a href="story_create.php">Make New Story</a></p>
        <!-- check the number of stories, if more than 0, display all, using the findAll function above that is in $stories-->
        <?php if (count($stories) > 0 ): ?>
            <table>
                <thead>
                    <tr>
                        <th class= "thd">Headline</th>
                        <th class= "thd">Short headline</th>
                        <th class= "thd">Status</th>
                        <th class= "thd">Article</th>
                        <th class= "thd">Image</th>
                        <th class= "thd">Image description</th>
                        <th class= "thd">Author</th>
                        <th class= "thd">Category</th>
                        <th class= "thd">Location</th>
                        <th class= "thd">Creation</th>
                        <th class= "thd">Updated</th>
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
                            <td class = "sat"><?= $story->status ?>
                            <!-- <?php if ($story->status === 0){
                                echo $story->status = "Live";
                            } else{
                                echo $story->status = "Not Live";
                            }
                            ?> -->
                            </td>
                            <td class = "art"><?= substr($story->article, 0, 50)?>...</td>
                            <td class = "url"><img src="<?= $import.$story->img_url ?>" width="100"> 
                                <?php if ($import.$story->img_url === null || $import.$story->img_url === ""){
                                    echo "No image";} ?></td>
                            <td class = "dep"><?= $story->img_description ?></td>
                            <td class = "aut"><?= $author->first_name ?> <?= $author->last_name ?></td>
                            <td class = "cat"><?= $category->name ?></td>
                            <td class = "loc"><?= $location->name ?></td>
                            <td class = "crt"><?= $story->created_at ?></td>
                            <td class = "upt"><?= $story->updated_at ?></td>

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
        <p class = "new"><a href="story_create.php">Make New Story</a></p>
        <?php require "../etc/edit_navbar.php";?>
    </body>
</html>