<?php
require_once 'config.php';
?>
<style>
    .wel{
        justify-self: center;
    }
    .cho{
        justify-self: center;
    }
    
    .edit_navbar{
        display: flex;
        gap: 40px;
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
        color: red;
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
<title>Edit Section</title>
<h1 class= "wel">Welcome to Edit Section</h1>
<h3 class="cho">Choose what to change</h3>
<ul class="edit_navbar">
    <li><a href="/intProj/lights_project/My_project/index.php">Home Page</a></li>
    <li><a href="/intProj/lights_project/My_project/story/story_tab.php">Story</a></li>
    <li><a href="/intProj/lights_project/My_project/category/category_tab.php">Category</a></li>
    <li><a href="/intProj/lights_project/My_project/author/author_tab.php">Author</a></li>
    <li><a href="/intProj/lights_project/My_project/location/location_tab.php">Location</a></li>
</ul>

<!-- 
    <li><a href="<?= $home?>/index.php">Home</a></li>
    <li><a href="<?=$home?>/course/index.php">Courses</a></li>
    <li><a href="<?=$home?>/department/index.php">Departments</a></li>
    <li><a href="<?=$home?>/module/index.php">Modules</a></li> -->
