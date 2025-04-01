<?php
require_once "../etc/config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
try{
    $authors = Author::findAll();
    $categories = Category::findAll();
    $locations = Location::findAll();
}
catch(Exception $e){
    echo $e->getMessage();
    exit();
}

echo "<pre>";
if (array_key_exists("form-data", $_SESSION)) {
    print_r($_SESSION["form-data"]);
}
if (array_key_exists("form-errors", $_SESSION)) {
    print_r($_SESSION["form-errors"]);
}
echo "</pre>";

//pull out all the info from classs
// $id = $_GET["id"];
// $story = Story::findById($id);

?>

<!DOCTYPE html>
<html lang="eng">
    <head>
    <link rel="stylesheet" href="story.css">
    
        <title>Create a Story Form</title>
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
        <p class = "edit"><a href="<?=$import?>etc/edit_navbar.php">Edit Another Section</a></p>
        <?php require_once "../etc/flash_message.php";?>
        <!-- Create in a new story -->
        <h2>New Story Form</h2>
        <form action="story_store.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="headline">Headline</label>
                <input type="text" id="headline" name="headline" value="<?= old('headline') ?>" />
                <span class="error"><?= error('headline') ?></span>
            </div>
            <!--<div>
                //Input headline for the story, place an error if the requirement was not met
                <lavel for="headline">Headline:
                <input id="healine" type="text" name="headline" value="<?= old("headline") ?>"><span class=" error"><?= error("headline") ?><span>
            </div>-->
            <div>
                <!--Input short_headline for the story, place an error if the requirement was not met-->
                <label for="short_headline">Short Headline:<label>
                <input id="short_headline" type="text" name="short_headline" value="<?= old("short_headline") ?>"><span class=" error"><?= error("short_headline") ?><span>
            </div>

            <div>
                <label for="status">Status:</label>
                <input id="status" type="radio" name="status" value="0"<?= chosen("status", "Live") ? "checked" : "" ?>>Live
                <input type="radio" name="status" value="1"<?= chosen("status", "Not Live") ? "checked" : "" ?>>Not Live
            </div>
            <div>
                <!---Input article for the story, place an error if the requirement was not met-->
                <label for="above">Article:</label><br>
                <textarea rows= "4" cols="50" class = "overglow" type="text" name="article" id="above" placeholder="Write the article here..." value="<?= old("article") ?>"></textarea><span class=" error"><?= error("article") ?><span>
            </div>
            <div>
                <!-- Input img_url for the story, place an error if the requirement was not met-->
                <!-- Image: -->
                <label for="img_url">Image</label>
                <input type="file" id="img_url" name="img_url" value="<?= old("img_url") ?>"/>
                <span class="error"><?= error('img_url') ?></span>
            </div>
            <div>
                <!-- Input img_url for the story, place an error if the requirement was not met-->
                <label for="img_description">Image Description:</label>
                <input id= "img_description"type="text" name="img_description" value="<?= old("img_description") ?>"><span class=" error"><?= error("img_description") ?><span>
            </div>
            <div>
                <!-- Select the author for story, place an error if the requirement was not met-->
                <label for="author_id">Author:</label>
                <select id="author_id" name="author_id">
                    <option value="">Please choose author...</option>"
                    <!-- a loop to dispaly an new author from the Author::findAll if added -->
                    <?php foreach($authors as $author): ?>
                    <!-- make an option to shows each new departemnt title -->
                    <option value="<?= $author->id ?>"  <?= chosen("author_id" , $author->id) ? "selected" : "" ?>><?= $author->first_name ," ", $author->last_name ?></option>
                    <?php endforeach?>
                </select>
                <span class=" error"><?= error("author_id") ?><span>
            </div>
            <div>
                <!-- Select the Category for story, place an error if the requirement was not met-->
                <label for="category_id">Category:</label>
                <select id="category_id" name="category_id">
                    <option value="">Please choose category...</option>"
                    <!-- a loop to dispaly an new category from the Category::findAll if added -->
                    <?php foreach($categories as $category): ?>
                    <!-- make an option to shows each new departemnt title -->
                    <option value="<?= $category->id ?>"  <?= chosen("category_id", $category->id) ? "selected" : "" ?>><?= $category->name ?></option>
                    <?php endforeach?>
                </select>
                <span class=" error"><?= error("category_id") ?><span>
            </div>
            <div>
                <!-- Select the location for story, place an error if the requirement was not met-->
                <label for="location_id">Location:</label>
                <select id="location_id" name="location_id">
                    <option value="">Please choose location...</option>"
                    <!-- a loop to dispaly an new category from the Category::findAll if added -->
                    <?php foreach($locations as $location): ?>
                    <!-- make an option to shows each new departemnt title -->
                    <option value="<?= $location->id ?>"  <?= chosen("location_id", $location->id) ? "selected" : "" ?>><?= $location->name ?></option>
                    <?php endforeach?>
                </select>
                <span class=" error"><?= error("location_id") ?><span>
            </div>
            <div>
                <!-- Input created for the story, place an error if the requirement was not met-->
                <label for="created_at">                Creation date:</label>
                <input id="created_at"  type="datetime-local" name="created_at" placeholder="yyyy-mm-dd-hh-mm-ss" value="<?= old("created_at") ?>"><span class=" error"><?= error("created_at") ?><span>
            </div>
            <div>
                <!-- Input created for the story, place an error if the requirement was not met-->
                <label for="updated_at">                Update date:</label>
                <input id="updated_at"  type="datetime-local" name="updated_at" placeholder="yyyy-mm-dd-hh-mm-ss" value="<?= old("updated_at") ?>"><span class=" error"><?= error("updated_at") ?><span>
            </div>


            <!-- Once you press on the submit button, it goes to store, if there are errors, it comes back to create and shows the errors made-->
            <button type="submit">Store</button>
            <!-- click on cancel to back to the All Stories page -->
            <a href="story_tab.php">Cancel</a>
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