<?php

require_once("../../src/controller/UserController.php");

$userController = new UserController();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $user = $userController->read($id);
        if ($user) {
            echo $user->__toString();
        } else {
            echo "User not found.";
        }
    } else {
        $users = $userController->readAll();
        if ($users) {
            foreach ($users as $user) {
                echo $user->__toString() . "<br>";
            }
        } else {
            echo "No users found.";
        }
    }
}