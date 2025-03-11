<?php
require_once "./etc/config.php";

try {
    // $stories = Story::findAll();
    // $stories = Story::findAll($options = array('limit' => 2));
    // $stories = Story::findAll($options = array('limit' => 2, 'offset' => 2));

    // $authorId = 7;
    // $stories = Story::findByAuthor($authorId);
    // $stories = Story::findByAuthor($authorId, $options = array('limit' => 3));
    // $stories = Story::findByAuthor($authorId, $options = array('limit' => 3, 'offset' => 2));

    $politicsId = 3;
    $politicsStories = Story::findByCategory($politicsId, $options = array('limit' => 3, 'offset' => 0));
    $cultureId = 2;
    $cultureStories = Story::findByCategory($cultureId, $options = array('limit' => 1, 'offset' => 0));
    $sportId = 1;
    $sportStories = Story::findByCategory($sportId, $options = array('limit' => 2, 'offset' => 0));

    // $stories = Story::findByCategory($categoryId);
    // $stories = Story::findByCategory($categoryId, $options = array('limit' => 3));
    $generalId = 4;
    $generalStories = Story::findByCategory($generalId, $options = array('limit' => 3, 'offset' => 1 ));


    $locationId = 1;

    // $stories = Story::findByLocation($locationId);
    // $stories = Story::findByLocation($locationId, $options = array('limit' => 3));
    $stories = Story::findByLocation($locationId, $options = array('limit' => 2, 'offset' => 1 ));
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

        <title>My stories</title>
    </head>
    <body>
        <?php require_once "./etc/navbar.php"; ?>
        <?php require_once "./etc/flash_message.php"; ?>

        <div class ="topTier container">
            
            <div class="section1 width-9">
                <?php foreach ($sportStories as $s) { ?>
                    <div class="main">
                        <img src="<?= $s->img_url ?>"/>
                        <!--Strange, but fixed it-->
                        <div class="context">
                        <div class="header">
                            <h3 class="title">
                                <a href="view_story.php?id=<?= $s->id ?>"><?= $s->short_headline ?></a>
                            </h3>
                        </div>
                        <h5 class="category"><?= Category::findById($s->category_id)->name ?></h5>
                        </div>

                        <div class="imageDescription">
                            <h4><i>Image: <?= $s->img_description?></i></h4>
                        </div>
                    </div>
                <?php }?>
            </div>
            
            
                <!-- Done -->
            
                <div class="section2 width-3">
                    <?php foreach ($cultureStories as $s) { ?>
                        <div class="medium-port">
                            <div class="content">
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
                                <img src="<?= $s->img_url?>" />
                                <p class="imageDescription"><i>Image: <?= $s->img_description?></i></p>
                                <h5 class="category"><?= Category::findById($s->category_id)->name ?></h5>
                                <h3 class="title">
                                    <a href="view_story.php?id=<?= $s->id ?>"><?= $s->headline ?></a>
                                </h3>
                                <p>
                                    <?= substr($s->article, 0, 100)?>...
                                </p>
                            </div>
                            <p class="date"><?= $s->updated_at ?></p>
                        </div>
                    <?php }?>
        
                    <div class="bottom">
                        <?php foreach ($politicsStories as $s) { ?> 
                            <div class="only-title">
                                <h4><a href="view_story.php?id=<?= $s->id ?>"><?= $s->headline ?></h4>
                                <h5 class="category"><?= Category::findById($s->category_id)->name ?></h5>
                            </div>
                        <?php }?>
                    </div>
                </div>
        </div>
        
        <div class="secTier container-no-padding">
            <div class="section3 width-6">
                <?php foreach ($stories as $s) { ?>
                    <div class="medium-land">
                        <!-- <div class="content"> -->
                            <div class="image">
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
                            <img src="<?= $s->img_url ?>" />
                            </div>
                        <!-- </div> -->
                        <div class="context">
                            <div class="text">
                            <div class="first">
                                <h3>
                                    <a href="view_story.php?id=<?= $s->id ?>"><?= $s->headline ?></a>
                                </h3>
                                <p class="category"><?= Category::findById($s->category_id)->name ?></p>
                            </div>
                            <div class="second">
                                <h3><a href="view_story.php?id=<?= $s->id ?>"><?= $s->short_headline ?></a></h3>
                            </div>
                            </div>
                            <div class="author_time">
                            <p class="author"><?= Author::findById($s->author_id)->first_name . " " . Author::findById($s->author_id)->last_name ?></p>
                            <p class="time">5 mins</p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="section4 width-6">
                <div class="top">
                    <?php foreach ($sportStories as $s) { ?>
                        <div class="medium-port">
                            <div class="content">
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
                                <img src="<?= $s->img_url?>" />
                                <p class="imageDescription"><i>Image: <?= $s->img_description?></i></p>
                                <h5 class="category"><?= Category::findById($s->category_id)->name ?></h5>
                                <h3 class="title">
                                    <a href="view_story.php?id=<?= $s->id ?>"><?= $s->headline ?></a>
                                </h3>
                                <p>
                                    <?= substr($s->article, 0, 100)?>...
                                </p>
                            </div>
                            <p class="date"><?= $s->updated_at ?></p>
                        </div>
                    <?php } ?>
                </div>

                <?php foreach ($cultureStories as $s) { ?>
                    <div class="medium-land">
                        <div class="content">
                            <div class="image">
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
                            <img src="<?= $s->img_url ?>" />
                            </div>
                        </div>
                        <div class="context">
                            <div class="text">
                            <div class="first">
                                <h3>
                                    <a href="view_story.php?id=<?= $s->id ?>"><?= $s->headline ?></a>
                                </h3>
                                <p class="category"><?= Category::findById($s->category_id)->name ?></p>
                            </div>
                            <div class="second">
                                <h3><a href="view_story.php?id=<?= $s->id ?>"><?= $s->short_headline ?></a></h3>
                            </div>
                            </div>
                            <div class="author_time">
                            <p class="author"><?= Author::findById($s->author_id)->first_name . " " . Author::findById($s->author_id)->last_name ?></p>
                            <p class="time">5 mins</p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </body>
</html>