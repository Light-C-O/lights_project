<?php

try {
    $categories = Category::findAll();
}
catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>
<ul class="navbar">
    <li><a href="index.php">Home</a></li>
    <?php foreach ($categories as $c) { ?>
        <li><a href="category.php?id=<?= $c->id ?>"><?= $c->name ?></a></li>
    <?php } ?>
    <li><a href="edit_navbar.php">Edit</a></li>
</ul>
