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

    // $stories = Story::findByCategory($categoryId);
    // $stories = Story::findByCategory($categoryId, $options = array('limit' => 3));


    $locationId = 1;

    // $stories = Story::findByLocation($locationId);
    // $stories = Story::findByLocation($locationId, $options = array('limit' => 3));
    $stories = Story::findByLocation($locationId, $options = array('limit' => 2, 'offset' => 1 ));


//categories
    $sportId = 1;
    $sportStories = Story::findByCategory($sportId, $options = array('limit' => 3, 'offset' => 0));
    //array position
    $sportStory1 = $sportStories[0];
    $sportStory2 = $sportStories[1];
    $sportStory3 = $sportStories[2];
    
    $cultureId = 2;
    $cultureStories = Story::findByCategory($cultureId, $options = array('limit' => 3, 'offset' => 0));
    //array position
    $cultureStory1 = $cultureStories[0];
    $cultureStory2 = $cultureStories[1];
    $cultureStory3 = $cultureStories[2];

    $politicsId = 3;
    $politicsStories = Story::findByCategory($politicsId, $options = array('limit' => 8, 'offset' => 3));

    // $politicsStory1 = $politicsStories[0];
    // $politicsStory2 = $politicsStories[1];
    // $politicsStory3 = $politicsStories[2];
    $politicsStory4 = $politicsStories[3];
    // $politicsStory5 = $politicsStories[4];
    // $politicsStory6 = $politicsStories[5];
    // $politicsStory7 = $politicsStories[6];
    // $politicsStory8 = $politicsStories[7];

    $obituaryId = 4;
    $obituaryStories = Story::findByCategory($obituaryId, $options = array('limit' => 2, 'offset' => 0 ));
    //array position
    $obituaryStory1 = $obituaryStories[0];
    $obituaryStory2 = $obituaryStories[1];

    $crimeId = 5;
    $crimeStories = Story::findByCategory($crimeId, $options = array('limit' => 2, 'offset' => 0 ));
    //array position
    // $crimeStory1 = $crimeStories[0];
    // $crimeStory2 = $crimeStories[1];
    // $crimeStory3 = $crimeStories[2];


}
catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
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

        <title>THE OUTLET</title>
    </head>
    <body>
        <div class = "newsTitle container-no-padding"><h1>THE OUTLET</h1></div>
        <?php require_once "./etc/navbar.php"; ?>

        <div class ="topTier container">
            <!--Big Top Sport Story-->
            <div class="section1 width-9">  
                <a href="view_story.php?id=<?= $sportStory1->id ?>">
                    <div class="main">
                        <img src="<?= $sportStory1->img_url ?>"/>
                        <!--Strange, but fixed it-->
                        <div class="context">
                        <div class="header">
                            <h3 class="title"><?= $sportStory1->short_headline ?></h3>
                        </div>
                        <h5 class="category"><?= Category::findById($sportStory1->category_id)->name ?></h5>
                        </div>

                        <div class="imageDescription">
                            <h4><i>Image: <?= $sportStory1->img_description?></i></h4>
                        </div>
                    </div>
                </a>
            </div>
            
            
                <!-- Done -->
            <div class="section2 width-3">
                <a href="view_story.php?id=<?= $cultureStory1->id ?>">
                    <div class="medium-port">
                        <div class="content">
                            <?php
                                if ($cultureStory1->status === 0){
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
                            <img src="<?= $cultureStory1->img_url?>" />
                            <p class="imageDescription"><i>Image: <?= $cultureStory1->img_description?></i></p>
                            <h5 class="category"><?= Category::findById($cultureStory1->category_id)->name ?></h5>
                            <h3 class="title"><?= $cultureStory1->headline ?></h3>
                            <div class = "art"><?= substr($cultureStory1->article, 0, 100)?>...</div>
                        </div>
                        <p class="date">Modified: <?php
                            $date = new DateTimeImmutable($cultureStory1->updated_at );
                            echo $date->format('Y-m-d');
                            ?></p>
                    </div>
                </a>


                <div class="bottom">
                    <?php foreach ($obituaryStories as $s) { ?> 
                        <a href="view_story.php?id=<?= $s->id ?>">
                            <div class="only-title">
                                <h4><?= $s->short_headline ?></h4>
                                <h5 class="category"><?= Category::findById($s->category_id)->name ?></h5>
                            </div>
                        </a>
                    <?php }?>
                </div>
            </div>
        </div>
        <!-- Second Row-->

        <div class="secTier container-no-padding">
            <div class="section3 width-6">
                <?php foreach ($politicsStories as $s) { ?>
                    <a href="view_story.php?id=<?= $s->id ?>">
                        <div class="medium-land">
                            <div class="content">
                                <div class="image">
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
                                <img src="<?= $s->img_url ?>" />
                                </div>
                            </div>
                            <div class="context">
                                <div class="text">
                                <div class="first">
                                    <h3><?= $s->headline ?></h3>
                                    <p class="category"><?= Category::findById($s->category_id)->name ?></p>
                                </div>
                                <div class="second">
                                    <?= substr($s->article, 0, 100) ?>...
                                </div>
                                </div>
                                <div class="author_time">
                                <p class="author"><?= Author::findById($s->author_id)->first_name . " " . Author::findById($s->author_id)->last_name ?></p>
                                <p class="time">5 mins</p>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>

            <div class="section4 width-6">
                <div class="above">
                    <!-- Small sport story 2-->               
                    <a href="view_story.php?id=<?= $sportStory2->id ?>">
                        <div class="medium-port">
                            <div class="content">
                                <?php
                                    if ($sportStory2->status === 0){
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
                                <img src="<?= $sportStory2->img_url?>" />
                                <p class="imageDescription"><i>Image: <?= $sportStory2->img_description?></i></p>
                                <h5 class="category"><?= Category::findById($sportStory2->category_id)->name ?></h5>
                                <h3 class="title"><?= $sportStory2->headline?></h3>
                                <div class = "art">
                                    <?= substr($sportStory2->article, 0, 185)?>...
                                </div>
                            </div>
                            <p class="date"><?= $sportStory2->updated_at ?></p>
                        </div>
                    </a>
                    
                </div>

                <div class = "under" >
                    <?php foreach ($crimeStories as $s) { ?>
                        <a href="view_story.php?id=<?= $s->id ?>">
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
                                        <h3><?= $s->short_headline ?></h3>
                                        <p class="category"><?= Category::findById($s->category_id)->name ?></p>
                                    </div>
                                    <div class="second">
                                        <?= substr($s->article, 0, 100) ?>...
                                    </div>
                                    </div>
                                    <div class="author_time">
                                    <p class="author"><?= Author::findById($s->author_id)->first_name . " " . Author::findById($s->author_id)->last_name ?></p>
                                    <p class="time">5 mins</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                    <a href="view_story.php?id=<?= $cultureStory3->id ?>">
                        <div class="only-title">
                            <h4><?= $cultureStory3->short_headline ?></h4>
                            <h5 class="category"><?= Category::findById($cultureStory3->category_id)->name ?></h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>