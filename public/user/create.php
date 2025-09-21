<?php

require_once("../../src/controller/UserController.php");

$userController = new UserController();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = [
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'age' => $_POST['age'] ?? 0
    ];
    $result = $userController->create($data);
    if ($result) {
        echo "User created successfully.";
    } else {
        echo "Failed to create user.";

        foreach ($userController->getErrors() as $field => $error) {
            echo "<p>Error in $field: $error</p>";
        }
    }
}
?>
<p><button onclick="window.location.href='../index.php'">Back to home</button></p>
