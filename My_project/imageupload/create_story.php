<?php
require_once "./etc/config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
try {
    $authors = Author::findAll();
    $categories = Category::findAll();
    $locations = Location::findAll();
}
catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
// echo "<pre>";
// if (array_key_exists("form-data", $_SESSION)) {
//     print_r($_SESSION["form-data"]);
// }
// if (array_key_exists("form-errors", $_SESSION)) {
//     print_r($_SESSION["form-errors"]);
// }
// echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Create Story</title>
        <style>
            .error { color: red; }
            form div { margin-bottom: 10px; }
            form div label { display: inline-block; width: 100px; }
            
            form div input[type="text"], 
            form div input[type="file"], 
            form div select, 
            form div textarea { 
                width: 200px; 
            }
            form div textarea { height: 100px; }
        </style>
    </head>
    <body>
        <?php require_once "./etc/navbar.php"; ?>
        <?php require_once "./etc/flash_message.php"; ?>
        <h1>Create Story</h1>
        <form action="store_story.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="headline">Headline</label>
                <input type="text" id="headline" name="headline" value="<?= old('headline') ?>" />
                <span class="error"><?= error('headline') ?></span>
            </div>
            <div>
                <label for="article">Article</label>
                <textarea id="article" name="article"><?= old('article') ?></textarea>
                <span class="error"><?= error('article') ?></span>
            </div>
            <div>
                <label for="author_id">Author</label>
                <select id="author_id" name="author_id">
                    <option value="">Select author</option>
                    <?php foreach ($authors as $a) { ?>
                        <option value="<?= $a->id ?>" <?= chosen('author_id', $a->id) ? "selected" : "" ?>><?= $a->first_name . " " . $a->last_name ?></option>
                    <?php } ?>
                </select>
                <span class="error"><?= error('author_id') ?></span>
            </div>
            <div>
                <label for="category_id">Category</label>
                <select id="category_id" name="category_id">
                    <option value="">Select category</option>
                    <?php foreach ($categories as $c) { ?>
                        <option value="<?= $c->id ?>" <?= chosen('category_id', $c->id) ? "selected" : "" ?>><?= $c->name ?></option>
                    <?php } ?>
                </select>
                <span class="error"><?= error('category_id') ?></span>
            </div>
            <div>
                <label for="location_id">Location</label>
                <select id="location_id" name="location_id">
                    <option value="">Select location</option>
                    <?php foreach ($locations as $l) { ?>
                        <option value="<?= $l->id ?>" <?= chosen('location_id', $l->id) ? "selected" : "" ?>><?= $l->name ?></option>
                    <?php } ?>
                </select>
                <span class="error"><?= error('location_id') ?></span>
            </div>
            <div>
                <label for="img_url">Image</label>
                <input type="file" id="img_url" name="img_url" />
                <span class="error"><?= error('img_url') ?></span>
            </div>
            <div>
                <input type="submit" value="Store" />
            </div>
        </form>
    </body>
</html>
<?php
if (array_key_exists("form-data", $_SESSION)) {
    unset($_SESSION["form-data"]);
}
if (array_key_exists("form-errors", $_SESSION)) {
    unset($_SESSION["form-errors"]);
}
?>