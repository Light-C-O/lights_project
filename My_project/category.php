<?php
require_once "./etc/config.php";

try {
    if (!isset($_GET["id"])) {
        throw new Exception("Category ID not provided.");
    }
    $categoryId = $_GET["id"];
    $category = Category::findById($categoryId);
    if ($category == null) {
        throw new Exception("Category not found.");
    }
    // $stories = Story::findByCategory($categoryId);
    $stories = Story::findByCategory($categoryId, $options = array('limit' => 3));
    // $stories = Story::findByCategory($categoryId, $options = array('limit' => 3, 'offset' => 1));
}
catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>
<html>
    <head>
        <title>Stories: <?= $category->name ?></title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php require_once "./etc/navbar.php"; ?>
        <?php require_once "./etc/flash_message.php"; ?>
        <h1>Stories: <?= $category->name ?></h1>
            <div class = "cat container ">
                <?php foreach ($stories as $s) { ?>
                <div class = "whole width-4">
                    <div class = "first">
                        <p class = "catImg"><img src="<?= $s->img_url ?>"></p>

                        <div class ="loc_head">
                            <p class = "catLocation"><?= Location::findById($s->location_id)->name ?></p>
                            <h2 class = "catHeadline"><a href="view_story.php?id=<?= $s->id ?>"><?= $s->short_headline ?></a></h2>
                        </div>
                    </div>
                    <!-- <p class= "catArticle"><?= substr($s->article, 0, 100)?>...</p> -->
                    <p class = "catAuthor">Author: <?= Author::findById($s->author_id)->first_name . " " . Author::findById($s->author_id)->last_name ?></p>
                    <!-- <p class = "catCategory"> Category: <?= Category::findById($s->category_id)->name ?></p> -->
                    <p class = "catCreate">Date created: <?= $s->created_at ?></p>
                    <p class = "catUpdate">Last modified: <?= $s->updated_at ?></p>
                </div>
                <?php } ?>
            </div>
    </body>
</html>