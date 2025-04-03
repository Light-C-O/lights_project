<?php
require_once "./etc/config.php";

try {
    if (!isset($_GET["id"])) {
        throw new Exception("Story ID not provided.");
    }
    $id = $_GET["id"];
    $s = Story::findById($id);
    if ($s == null) {
        throw new Exception("Story not found.");
    }
    $category = Category::findById($s->category_id);
    $related_stories = Story::findByCategory($category->id, $options = array('limit' => 3, 'order_by' => 'updated_at', 'order' => 'DESC'));
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
        <link href="https://fonts.googleapis.com/css2?
        family=Noto+Sans+JP:wght@100..900&
        family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100..900;1,100..900&
        family=Sahitya:wght@400;700&display=swap"
        rel="stylesheet"/>
        <!-- end of fonts -->
        <link rel="stylesheet" href="css/all.min.css" />
        <link rel="stylesheet" href="css/reset.css" />
        <link rel="stylesheet" href="css/grid.css" />
        <link rel="stylesheet" href="css/style.css" />
        <title>Story</title>
    </head>
    <body>
        <div class = "newsTitle container-no-padding"><h1>THE OUTLET</h1></div>
        <?php require_once "./etc/navbar.php"; ?>
        <?php require_once "./etc/flash_message.php"; ?>
        <div class = "seeStory container">
            <div class = "focusPoint width-12">
                <h1><?= $s->headline ?></h1>
                <p><img src="<?= $s->img_url ?>" /></p>
                <div>
                    <p class="imageDescription"><i>Image: <?= $s->img_description?></i></p>
                    <p class = "author">By: <?= Author::findById($s->author_id)->first_name . " " . Author::findById($s->author_id)->last_name ?></p>
                    <p class ="fullArticle"><?= $s->article ?></p>
                </div>

                <div class = "bottom_info">
                    <div class = "viewCat_Loc">
                    <p>Category: <?= Category::findById($s->category_id)->name ?></p>
                    <p>Location: <?= Location::findById($s->location_id)->name ?></p>
                    </div>
                    <div class = "view_Dates">
                        <p>Created: <?php
                                $date = new DateTimeImmutable($s->created_at );
                                echo $date->format('Y-m-d H:i');
                                ?></p>
                        <p>Modified: <?php
                                $date = new DateTimeImmutable($s->updated_at );
                                echo $date->format('Y-m-d H:i');
                                ?></p>
                    </div>
                </div>
            </div>
        </div>

    
        <div class = "related container-no-padding">
            <div class = "width-12">
                <h2>Related Stories</h2>
            </div>
                <?php foreach ($related_stories as $rs) { ?>
                    <?php if ($rs->id == $s->id) { continue; } ?>
                    <a class="width-3" href="view_story.php?id=<?= $rs->id ?>">
                    <div class="medium-port ">
                        <div class="content">
                            <?php
                                if ($s->status === 0){
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
                            <img src="<?= $rs->img_url ?>">
                            <p class="imageDescription"><i><?= $rs->img_description?></i></p>
                            <h3 class="title"><?= $rs->short_headline ?></h3>
                            <p class = "author">Author: <?= Author::findById($rs->author_id)->first_name . " " . Author::findById($rs->author_id)->last_name ?></p>
                        </div>
                    </div> 
                    </a>
                <?php } ?>
        </div>
    </body>
</html>