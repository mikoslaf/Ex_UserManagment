<?php

require_once("../../src/controller/UserController.php");

$userController = new UserController();

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = $userController->read($id);
    if ($user) {

        ?>
        <form method="POST" action="update.php">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($user->getId()); ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user->getName()); ?>" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user->getEmail()); ?>" required><br>
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($user->getAge()); ?>" required><br>
            <input type="submit" value="Update User">
        </form>
        <?php

    } else {
        echo "User not found.";
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = [
        'id' => $_POST['id'] ?? '',
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'age' => $_POST['age'] ?? 0
    ];
    $result = $userController->update($data);
    if ($result) {
        echo "User updated successfully.";
    } else {
        echo "Failed to update user.";
        foreach ($userController->getErrors() as $field => $error) {
            echo "<p>Error in $field: $error</p>";
        }
    }
} else {
    echo "Something went wrong.";
}