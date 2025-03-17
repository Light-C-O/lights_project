<?php
require_once "../etc/config.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//input the findAll function into $locations
$locations = Location::findAll();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>All Locations</title>
        <link rel="stylesheet" href="location.css">
    </head>
    <body>
        <h1>Locations</h1>
        <!-- the navbar file and the flash_messsage file -->
        <?php require_once "../etc/edit_navbar.php";?>
        <?php require_once "../etc/flash_message.php";?>
        <!-- link to the location of creating a new location -->
        <p><a href="location_create.php">Make New Location</a></p>
        <!-- check the number of locations, if more than 0, display all, using the findAll function above that is in $locations-->
        <?php if (count($locations) > 0 ): ?>
            <table>
                <thead>
                    <tr>
                        <th class= "ti">Name</th>
                        <th class= "act">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- a loop to push out each location with their info displayed  -->
                    <?php foreach($locations as $location): ?>
                        <tr>
                            <td class = "te"><?= $location->name ?></td>
                            <td class = "an">
                                <a href="location_edit.php?id=<?= $location->id?>">Edit</a>
                                <form class="form-delete"action="location_delete.php" method="post">
                                    <input type="hidden" name="id" value="<?= $location->id?>">
                                    <input type="submit" value="Delete">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        <?php else: ?>
            <!-- if $locations is less than 0, meaning no locations, display the statement below -->
            <p>No locations found</p>
        <?php endif; ?>
    </body>
</html>