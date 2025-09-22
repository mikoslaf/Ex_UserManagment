<?php
require_once("../../src/controller/UserController.php");

$userController = new UserController();
$success = false;
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = [
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'age' => $_POST['age'] ?? 0
    ];
    $result = $userController->create($data);
    if ($result) {
        $success = true;
    } else {
        $errors = $userController->getErrors();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User - User Management System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <!-- Fixed header to match consistent navigation structure -->
    <header class="header">
        <div class="container">
            <h1 class="logo">User Management</h1>
            <nav class="nav">
                <a href="../index.php" class="nav-link">Home</a>
                <a href="../admin.php" class="nav-link">Admin</a>
                <a href="read.php" class="nav-link">View Users</a>
            </nav>
        </div>
    </header>

    <main class="main">
        <div class="container">
            <!-- Simplified to only show success or failure information -->
            <?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
                <?php if ($success): ?>
                    <div class="alert alert-success">
                        <div class="alert-icon">✓</div>
                        <div class="alert-content">
                            <h3>Success!</h3>
                            <p>User created successfully.</p>
                            <a href="../admin.php" class="btn btn-primary" style="margin-top: 1rem;">View All Users</a>
                            <a href="../index.php" class="btn btn-secondary" style="margin-top: 1rem;">Create Another</a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-error">
                        <div class="alert-icon">⚠</div>
                        <div class="alert-content">
                            <h3>Failed</h3>
                            <p>User creation failed. Please try again.</p>
                            <a href="../index.php" class="btn btn-primary" style="margin-top: 1rem;">Try Again</a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 User Management System. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
