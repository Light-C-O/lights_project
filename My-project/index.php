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

    $cultureId = 2;
    $sportId = 1;
    // $stories = Story::findByCategory($categoryId);
    // $stories = Story::findByCategory($categoryId, $options = array('limit' => 3));
    $cultureStories = Story::findByCategory($cultureId, $options = array('limit' => 3, 'offset' => 0));
    $sportStories = Story::findByCategory($sportId, $options = array('limit' => 3, 'offset' => 0));

    $locationId = 2;
    // $stories = Story::findByLocation($locationId);
    // $stories = Story::findByLocation($locationId, $options = array('limit' => 3));
    $stories = Story::findByLocation($locationId, $options = array('limit' => 4, 'offset' => 0));
}
catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>
<html>
    <head>
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
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/grid.css" />
    <link rel="stylesheet" href="css/style.css" />

        <title>My stories</title>
    </head>
    <body>
        <?php require_once "./etc/navbar.php"; ?>
        <?php require_once "./etc/flash_message.php"; ?>

        <div class = "container">
            <?php foreach ($stories as $s) { ?>
                <div class="medium-port width-3">
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
                        <div><img src="<?= $s->img_url ?>" /></div>
                        <p class="imageDescription"><i>Image: Board of Director</i></p>
                        <h5 class="category"><?= Category::findById($s->category_id)->name ?></h5>
                        <h3 class="title">
                            <a href="view_story.php?id=<?= $s->id ?>"><?= $s->headline ?></a>
                        </h3>
                        <p>
                            <?= substr($s->article, 0, 500)?>...
                        </p>
                    </div>
                        
                    <div><p class="date"><?= $s->updated_at ?></p></div>
                   
                </div>        
               
          
                <!--
                <p>Author: <?= Author::findById($s->author_id)->first_name . " " . Author::findById($s->author_id)->last_name ?></p>
                <p>Category: <?= Category::findById($s->category_id)->name ?></p>
                <p>Location: <?= Location::findById($s->location_id)->name ?></p>
                <p>Date created: <?= $s->created_at ?></p>
                <p>Last modified: <?= $s->updated_at ?></p>
                </div-->
            <?php } ?>
        </div>
        
        
        
        <div class= "container">
            <?php foreach ($cultureStories as $s) { ?>
                    <div class="medium-port width-3" style="align-self: start">
                        <div class="content">
                            <button class="label">
                                <span class="dot"></span>
                                <div class="live">
                                    <p>Live</p>
                                </div>
                            </button>
                   
                            <img src="<?= $s->img_url ?>" />
                            <p class="imageDescription"><i>Image: Board of Director</i></p>
                            <h5 class="category"><?= Category::findById($s->category_id)->name ?></h5>
                            <h3 class="title">
                                <a href="view_story.php?id=<?= $s->id ?>"><?= $s->headline ?></a>
                            </h3>
                            <p>
                                <?= substr($s->article, 0, 500)?>...
                            </p>
                            <p class="date"><?= $s->updated_at ?></p>
                        </div>
                    </div>        
            <?php } ?>
        </div>


        <div class= "container">
            <?php foreach ($sportStories as $s) { ?>
                    <div class="medium-port width-3" style="align-self: start">
                        <div class="content">
                            <button class="label">
                                <span class="dot"></span>
                                <div class="live">
                                    <p>Live</p>
                                </div>
                            </button>
                   
                            <img src="<?= $s->img_url ?>" />
                            <p class="imageDescription"><i>Image: <?= $s->img_description ?></i></p>
                            <h5 class="category"><?= Category::findById($s->category_id)->name ?></h5>
                            <h3 class="title">
                                <a href="view_story.php?id=<?= $s->id ?>"><?= $s->headline ?></a>
                            </h3>
                            <p>
                                <?= substr($s->article, 0, 500)?>...
                            </p>
                            <p class="date"><?= $s->updated_at ?></p>
                        </div>
                    </div>        
            <?php } ?>

            <div class="width-3">
            <?php foreach ($sportStories as $s) { ?>
                    <div>
                        <div class="content">
                           
                   
                
                            <h5 class="category"><?= Category::findById($s->category_id)->name ?></h5>
                            <h3 class="title">
                                <a href="view_story.php?id=<?= $s->id ?>"><?= $s->headline ?></a>
                            </h3>
                         
                     
                        </div>
                    </div>        
            <?php } ?>

        
            </div>
        </div>
    </body>
</html>