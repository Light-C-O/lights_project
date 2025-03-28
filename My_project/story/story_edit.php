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
    $story = Story::findById($id);
    if($story === null) {
        throw new Exception("story not found");
    }

    //pull the info from the other classes
$authors = Author::findAll();
$categories = Category::findAll();
$locations = Location::findAll();
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
        <link rel="stylesheet" href="story.css">
    </head>

    <body>
    <p class = "edit"><a href="<?=$import?>etc/edit_navbar.php">Edit Another Section</a></p>
    <?php require_once "../etc/flash_message.php";?>
        <h2>Edit the Story Form</h2>
        <!-- go to update when clicking the submit button -->
        <form action="story_update.php" method="POST">
            <!-- hide the id of the story -->
            <input type="hidden" name="id" value="<?= $story->id ?>">
            <p>
                Headline:
                <!-- the old(); states that the former input will still be stored as a default -->
                <input type="text" name="headline" value="<?= old("headline", $story->headline) ?>"><span class="error"><?= error("headline") ?></span>
            </p>
            <p>
                Short Headline:
                <!-- the old(); states that the former input will still be stored as a default -->
                <input type="text" name="short_headline" value="<?= old("short_headline", $story->short_headline) ?>"><span class="error"><?= error("short_headline") ?></span>
            </p>

            <p>
                Status:
                <input type="radio" name="status" value="Live"<?= chosen("status", "Live", $story->status) ? "checked" : "" ?>>Live
                <input type="radio" name="status" value="Not Live"<?= chosen("semester", "Not Live", $story->status) ? "checked" : "" ?>>Not Live
            </p>

            <p>
                <label for="above">Article:</label><br>
                <textarea rows= "4" cols="50" class = "overglow" type="text" name="article" id="above" placeholder="Write the article here..."  value="<?= old("article", $story->article) ?>"><?=$story->article?></textarea><span class="error"><?= error("article") ?></span>
            </p>
            <p>
                Image:
                <input type="text" name="img_url" value="<?= old("img_url", $story->img_url) ?>"><span class="error"><?= error("img_url") ?></span>
            </p>
            <p>
                Image description:
                <input type="text" name="img_description" value="<?= old("img_description", $story->img_description) ?>"><span class="error"><?= error("img_description") ?></span>
            </p>

            <p>
                Author:
                <select name="author_id">
                    <option value="">Please choose author...</option>"
                    <?php
                    foreach($authors as $author){ ?>
                        <option value="<?= $author->id ?>"  <?= $story->author_id === $author->id ? "selected" : " " ?>><?= $author->first_name," ", $author->last_name ?></option>
                    <?php } ?>
                </select>
                <span class="error"><?= error("author_id") ?></span>
            </p>
            
            <p>
                Category:
                <select name="category_id">
                    <option value="">Please choose category...</option>"
                    <?php foreach($categories as $category): ?>
                    <!-- make an option to shows each new departemnt title -->
                    <option value="<?= $category->id ?>"  <?= $story->category_id === $category->id ? "selected" : "" ?>><?= $category->name ?></option>
                    <?php endforeach?>
                </select>
                <span class="error"><?= error("category_id") ?></span>
            </p>
            
            <p>
                Location
                <select name="location_id">
                <?php foreach($locations as $location): ?>
                    <!-- make an option to shows each new departemnt title -->
                    <option value="<?= $location->id ?>"  <?= chosen("location_id", $location->id) ? "selected" : "" ?>><?= $location->name ?></option>
                    <?php endforeach?>
                </select>
                <span class="error"><?= error("location_id") ?></span>
            </p>
            <p>
                <!-- Input img_url for the story, place an error if the requirement was not met-->
                Creation date:
                <input type="datetime-local" name="created_at" placeholder="yyyy-mm-dd-hh-mm-ss" value="<?= old("created_at", $story->created_at) ?>"><span class=" error"><?= error("created_at") ?><span>
            </p>
            <p>
                <!-- Input img_url for the story, place an error if the requirement was not met-->
                Update date:
                <input type="datetime-local" name="updated_at" placeholder="yyyy-mm-dd-hh-mm-ss" value="<?= old("updated_at", $story->updated_at) ?>"><span class=" error"><?= error("updated_at") ?><span>
            </p>
            <!-- once clicked, it will go to the story_update.php -->
            <button type="submit">Update</button>
            <!-- Will discard the new input, take the default input and go mack to the story_tab.php unchanged -->
            <a href="story_tab.php">Cancel</a>
        </form>
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