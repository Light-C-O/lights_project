<?php
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .wel{
            text-align: center;
        }
        .cho{
            text-align: center;
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
</head>
<body>
    <h1 class= "wel">Welcome to Edit Section</h1>
    <h3 class="cho">Choose what to change</h3>
    <ul class="edit_navbar">
        <li><a href="<?=$import?>index.php">Home Page</a></li>
        <li><a href="<?=$import?>story/story_tab.php">Story</a></li>
        <li><a href="<?=$import?>category/category_tab.php">Category</a></li>
        <li><a href="<?=$import?>author/author_tab.php">Author</a></li>
        <li><a href="<?=$import?>location/location_tab.php">Location</a></li>
        <li><a href="<?=$import?>js-form-validation/js_author_demo.php">Js Demo</a></li>
    </ul>
</body>
</html>
