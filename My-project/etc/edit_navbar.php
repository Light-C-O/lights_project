<?php
require_once 'config.php';
?>
<style>
    .edit_navbar{
        display: flex;
        gap: 20px;
    }
    li{
        font-size: 20px;
        font-weight:bold;
        display: flex;
        align-items: center;
        list-style: none;
    }

    /* Set the list image as background image*/
    /li::before {
        /* content: '';
        display: inline-block;
        margin-right: 10px; */

        /* Height of the list image*/
        /* height: 20px; */

        /* Width of the list image*/
        /* width: 20px;
        background-image: url('../spiral.gif');
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center; */
    }
</style>
<ul class="edit_navbar">
    <li><a href="/intProj/lights_project/My-project/index.php">Home Page</a></li>
    <li><a href="/intProj/lights_project/My-project/story/sstory_table.php">Story</a></li>
    <li><a href="/intProj/lights_project/My-project/category/category_table.php">Category</a></li>
    <li><a href="/intProj/lights_project/My-project/author/author_table.php">Author</a></li>
    <li><a href="/intProj/lights_project/My-project/location/location_table.php">Location</a></li>
</ul>

<!-- 
    <li><a href="<?= $home?>/index.php">Home</a></li>
    <li><a href="<?=$home?>/course/index.php">Courses</a></li>
    <li><a href="<?=$home?>/department/index.php">Departments</a></li>
    <li><a href="<?=$home?>/module/index.php">Modules</a></li> -->
