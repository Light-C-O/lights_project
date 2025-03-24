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
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
        href="https://fonts.googleapis.com/css2?
            family=Noto+Sans+JP:wght@100..900&
            family=Playfair+Display:ital,wght@0,400..900;1,400..900&
            family=Roboto:ital,wght@0,100..900;1,100..900&
            family=Sahitya:wght@400;700&display=swap"
        rel="stylesheet"
        />
        <!-- end of fonts -->
        <link rel="stylesheet" href="css/all.min.css" />
        <link rel="stylesheet" href="css/reset.css" />
        <link rel="stylesheet" href="css/grid.css" />
        <link rel="stylesheet" href="css/style.css" />


        <title>Stories: <?= $category->name ?></title>
    </head>
    <body>
        <?php require_once "./etc/navbar.php"; ?>
        <?php require_once "./etc/flash_message.php"; ?>

            <div class = "display container">
            <h1>Stories: <?= $category->name ?></h1>
            </div>
            <div class = "cat container-no-padding">

                <?php foreach ($stories as $s) { ?>

                <a href="view_story.php?id=<?= $s->id ?>">
                <div class = "whole width-3">  
                    <div class = "first">
                        <?php
                            if ($s->status = 0){
                                echo(
                                    "<button class='label'>
                                        <span class='dot'></span>
                                        <div class='live'>
                                            <p>Live</p>
                                        </div>
                                    </button>"
                                );
                            }
                        ?>
                        <p class = "catImg"><img src="<?= $s->img_url ?>"></p>
                        <div class = "info">
                            <div class ="loc_head">
                                <p class = "catLocation"><?= Location::findById($s->location_id)->name ?></p>
                                <h2 class = "catHeadline"><?= $s->short_headline ?></h2>
                            </div>
                            <div class = "insider">
                                <p class = "catAuthor">Author: <?= Author::findById($s->author_id)->first_name . " " . Author::findById($s->author_id)->last_name ?></p>
                                <p class = "catCreate">Date created: <?= $s->created_at ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
                <?php } ?>
            </div>
    </body>
</html>