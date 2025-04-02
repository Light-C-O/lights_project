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
        <style>
            .error { color: red; }
            form div { margin-bottom: 10px; }
            form div input[type="text"], 
            form div input[type="file"]{ 
                width: 200px; 
            }
        </style>
    </head>

    <body>
    <?php require_once "../etc/edit_navbar.php";?>
    <?php require_once "../etc/flash_message.php";?>
        <h2>Edit the Story Form</h2>
        <!-- go to update when clicking the submit button -->
        <form action="story_update.php" method="post" enctype="multipart/form-data">
            <!-- hide the id of the story -->
            <input type="hidden" name="id" value="<?= $story->id ?>">
            <div>
                <label for="headline">Headline</label>
                <!-- the old(); states that the former input will still be stored as a default -->
                <input id="headline" type="text" name="headline" value="<?= old("headline", $story->headline) ?>"><span class="error"><?= error("headline") ?></span>
            </div>
            <div>
                <label for="short_headline">Short Headline:<label>
                <!-- the old(); states that the former input will still be stored as a default -->
                <input id="short_headline" type="text" name="short_headline" value="<?= old("short_headline", $story->short_headline) ?>"><span class="error"><?= error("short_headline") ?></span>
            </div>

            <div>
                <label for="status">Status:</label>
                <input id="status" type="radio" name="status" value="0"<?= chosen("status", "0", $story->status) ? "checked" : "" ?>>Live
                <input type="radio" name="status" value="1"<?= chosen("status", "1", $story->status) ? "checked" : "" ?>>Not Live
            </div>

            <div>
                <label for="above">Article:</label><br>
                <textarea rows= "4" cols="50" class = "overglow" type="text" name="article" id="above" placeholder="Write the article here..."  value="<?= old("article", $story->article) ?>"><?=$story->article?></textarea><span class="error"><?= error("article") ?></span>
            </div>
            <div>
                <!-- Image:
                <input type="text" name="img_url" value="<?= old("img_url", $story->img_url) ?>"><span class="error"><?= error("img_url") ?></span> -->
                <img src="<?= $import.$story->img_url ?>" width="100">
                <label for="img_url">Image</label>
                <input type="file" id="img_url" name="img_url" />
                <span class="error"><?= error('img_url') ?></span>
            </div>
            <div>
                <label for="img_description">Image Description:</label>
                <input id="img_description" type="text" name="img_description" value="<?= old("img_description", $story->img_description) ?>"><span class="error"><?= error("img_description") ?></span>
            </div>
            <div>
            <label for="author_id">Author:</label>
                <select id="author_id" name="author_id">
                    <option value="">Please choose author...</option>"
                    <?php
                    foreach($authors as $author){ ?>
                        <option value="<?= $author->id ?>"  <?= $story->author_id === $author->id ? "selected" : " " ?>><?= $author->first_name," ", $author->last_name ?></option>
                    <?php } ?>
                </select>
                <span class="error"><?= error("author_id") ?></span>
            </div>
            
            <div>
                <label for="category_id">Category:</label>
                <select id="category_id" name="category_id">
                    <option value="">Please choose category...</option>"
                    <?php foreach($categories as $category): ?>
                    <!-- make an option to shows each new departemnt title -->
                    <option value="<?= $category->id ?>"  <?= $story->category_id === $category->id ? "selected" : "" ?>><?= $category->name ?></option>
                    <?php endforeach?>
                </select>
                <span class="error"><?= error("category_id") ?></span>
            </div>
            
            <div>
                <label for="location_id">Location:</label>
                <select id="location_id" name="location_id">
                <?php foreach($locations as $location): ?>
                    <!-- make an option to shows each new departemnt title -->
                    <option value="<?= $location->id ?>"  <?= chosen("location_id", $location->id) ? "selected" : "" ?>><?= $location->name ?></option>
                    <?php endforeach?>
                </select>
                <span class="error"><?= error("location_id") ?></span>
            </div>
            <div>
                <!-- Input img_url for the story, place an error if the requirement was not met-->
                <label for="created_at">                Creation date:</label>
                <input id="created_at" type="datetime-local" name="created_at" placeholder="yyyy-mm-dd-hh-mm-ss" value="<?= old("created_at", $story->created_at) ?>"><span class=" error"><?= error("created_at") ?><span>
            </div>
            <div>
                <!-- Input img_url for the story, place an error if the requirement was not met-->
                <label for="updated_at">                Update date:</label>
                <input id="updated_at" type="datetime-local" name="updated_at" placeholder="yyyy-mm-dd-hh-mm-ss" value="<?= old("updated_at", $story->updated_at) ?>"><span class=" error"><?= error("updated_at") ?><span>
            </div>
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