<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
    <h1>Home</h1>
    <button onclick="document.location='index.php'">Back to User Form</button>
    <hr>

    <?php

    require_once("../src/controller/UserController.php");

    $userController = new UserController();

    $users = $userController->readAll();
    if ($users) {
        foreach ($users as $user) {
            echo "<p>";
            echo "<b>Name:</b> " . htmlspecialchars($user->getName()) . ", ";
            echo "<b>Email:</b> " . htmlspecialchars($user->getEmail()) . ", ";
            echo "<b>Age:</b> " . htmlspecialchars($user->getAge()) . " | ";
            echo "<button onclick=\"document.location='user/read.php?id=" . htmlspecialchars($user->getId()) . "'\">Show</button>";
            echo "<button onclick=\"document.location='user/update.php?id=" . htmlspecialchars($user->getId()) . "'\">Edit</button>";
            echo "<button onclick=\"document.location='user/delete.php?id=" . htmlspecialchars($user->getId()) . "'\">Delete</button>";
            echo "</p>";
        }
    } else {
        echo "No users found.";
    }
    
    ?>
</body>
</html>