<?php
require_once "../etc/config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//pull out all the info from the Departement classs
$authors = Author::findAll();
$categories = Category::findAll();
$locations = Location::findAll();
?>

<!DOCTYPE html>
<html lang="eng">
    <head>
        <title>Create a Story Form</title>
        <link rel="stylesheet" href="story.css">
    </head>

    <body>
        <p><a href="/intProj/lights_project/My_project/etc/edit_navbar.php">Edit Another Section</a></p>
        <?php require_once "../etc/flash_message.php";?>
        <!-- Create in a new story -->
        <h2>New Story Form</h2>
        <form action="story_store.php" method="POST">
            <p>
                <!-- Input headline for the story, place an error if the requirement was not met-->
                Headline:
                <input type="text" name="headline" value="<?= old("headline") ?>"><span class=" error"><?= error("headline") ?><span>
            </p>
            <p>
                <!-- Input short_headline for the story, place an error if the requirement was not met-->
                Short Headline:
                <input type="text" name="short_headline" value="<?= old("short_headline") ?>"><span class=" error"><?= error("short_headline") ?><span>
            </p>

            <p>
                Status:
                <input type="radio" name="status" value="0"<?= chosen("status", "0") ? "checked" : "" ?>>Live
                <input type="radio" name="status" value="1"<?= chosen("status", "1") ? "checked" : "" ?>>Not Live
            </p>
            <p>
                <!-- Input article for the story, place an error if the requirement was not met-->
                Article:
                <input type="text" name="article" value="<?= old("article") ?>"><span class=" error"><?= error("article") ?><span>
            </p>
            <p>
                <!-- Input img_url for the story, place an error if the requirement was not met-->
                Image:
                <input type="file" name="img_url" value="<?= old("img_url") ?>"><span class=" error"><?= error("img_url") ?><span>
            </p>
            <p>
                <!-- Input img_url for the story, place an error if the requirement was not met-->
                Image Description:
                <input type="text" name="img_description" value="<?= old("img_description") ?>"><span class=" error"><?= error("img_description") ?><span>
            </p>
            <p>
                <!-- Select the author for story, place an error if the requirement was not met-->
                Author:
                <select name="author_id">
                    <option value="">Please choose author...</option>"
                    <!-- a loop to dispaly an new author from the Author::findAll if added -->
                    <?php foreach($authors as $author): ?>
                    <!-- make an option to shows each new departemnt title -->
                    <option value="<?= $author->id ?>"  <?= chosen("author_id" , $author->id) ? "selected" : "" ?>><?= $author->first_name ," ", $author->last_name ?></option>
                    <?php endforeach?>
                </select>
                <span class=" error"><?= error("author_id") ?><span>
            </p>
            <p>
                <!-- Select the Category for story, place an error if the requirement was not met-->
                Category:
                <select name="category_id">
                    <option value="">Please choose category...</option>"
                    <!-- a loop to dispaly an new category from the Category::findAll if added -->
                    <?php foreach($categories as $category): ?>
                    <!-- make an option to shows each new departemnt title -->
                    <option value="<?= $category->id ?>"  <?= chosen("category_id", $category->id) ? "selected" : "" ?>><?= $category->name ?></option>
                    <?php endforeach?>
                </select>
                <span class=" error"><?= error("category_id") ?><span>
            </p>
            <p>
                <!-- Select the category for story, place an error if the requirement was not met-->
                Location:
                <select name="location_id">
                    <option value="">Please choose location...</option>"
                    <!-- a loop to dispaly an new category from the Category::findAll if added -->
                    <?php foreach($locations as $location): ?>
                    <!-- make an option to shows each new departemnt title -->
                    <option value="<?= $location->id ?>"  <?= chosen("location_id", $location->id) ? "selected" : "" ?>><?= $location->name ?></option>
                    <?php endforeach?>
                </select>
                <span class=" error"><?= error("location_id") ?><span>
            </p>
            <p>
                <!-- Input img_url for the story, place an error if the requirement was not met-->
                Creation date:
                <input type="text" name="created_at" value="<?= old("created_at") ?>"><span class=" error"><?= error("created_at") ?><span>
            </p>
            <p>
                <!-- Input img_url for the story, place an error if the requirement was not met-->
                Update date:
                <input type="text" name="updated_at" value="<?= old("updated_at") ?>"><span class=" error"><?= error("updated_at") ?><span>
            </p>

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