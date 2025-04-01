<?php
require_once "../../etc/config.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="./css/reset.css">
        <link rel="stylesheet" href="./css/grid.css">
        <link rel="stylesheet" href="./css/styles.css">


        <title>Authors</title>
    </head>
    <body>
        <!-- <p><a href= "edit_navbar.php">Go Back</a></p> -->
        <div class="container">
            <div class="width-12">
                <h1>Authors</h1>
            </div>
            <div class="width-8">
                <table id="table-authors">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Joel</td>
                            <td>Gunter</td>
                        </tr>
                        <tr>
                            <td>Jim</td>
                            <td>Thomas</td>
                            
                        </tr>
                        <tr>
                            <td>Kim</td>
                            <td>Coghill</td>
                        </tr>
                        <tr>
                            <td>Ailbhe</td>
                            <td>Conneely</td>
                        </tr>
                        <tr>
                            <td>Barry</td>
                            <td>Roche</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="width-4">
                <h2>Add Author</h2>
                <form id="form-author" action="author_store.php" method="POST">
                    <div class="form-group">
                        <label class="form-label">First Name: </label>
                        <input type="text" name="first_name" id="first_name" class="form-input" value="">
                        <div class="error" id="error-first_name"></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Last Name: </label>
                        <input type="text" name="last_name" id="last_name" class="form-input" value="">
                        <div class="error" id="error-last_name"></div>
                    </div>
                        <button type="submit" id="btn-submit">Submit</button>
                        <button type="button"><a href="<?=$js?>edit_navbar.php">Cancel</a></button>
                    </div>
                </form>
            </div>
        </div>
        <script src="./js/authors.js" type="module"></script>
    </body>
</html>