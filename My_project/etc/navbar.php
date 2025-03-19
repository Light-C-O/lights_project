<?php

try {
    $categories = Category::findAll();
}
catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>
<style>
    .navbar{
        display: flex;
        gap: 6%;
        justify-content: center;
    }
    li{
        font-size: 20px;
        font-weight:bold;
        display: flex;
        align-items: center;
        list-style: none;
    }
    li a:hover{
        color: blue;
        text-decoration: underline;
    }
</style>
<ul class="navbar">
    <li><a href="index.php">Home Page</a></li>
    <?php foreach ($categories as $c) { ?>
        <li><a href="category.php?id=<?= $c->id ?>"><?= $c->name ?></a></li>
    <?php } ?>
    <li><a href="/intProj/lights_project/My_project/etc/edit_navbar.php">Edit</a></li>
</ul>
