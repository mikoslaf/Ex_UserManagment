<?php 

require_once("../../src/controller/UserController.php");

$userController = new UserController();

# This should be a POST request
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $userController->delete($id);
    if ($result) {
        echo "User deleted successfully.";
    } else {
        echo "Failed to delete user.";
    }
} else {
    echo "Something went wrong.";
}