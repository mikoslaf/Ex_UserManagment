<?php 
require_once("../../src/controller/UserController.php");

$userController = new UserController();

$success = false;
$error = '';
$user = null;

# This should be a POST request
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = $userController->read($id);
    $result = $userController->delete($id);
    if ($result) {
        $success = true;
    } else {
        $error = "Failed to delete user.";
    }
} else {
    $error = "Something went wrong.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User - User Management System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <!-- Added modern layout with header and navigation -->
    <header class="header">
        <div class="container">
            <h1 class="logo">User Management</h1>
            <nav class="nav">
                <a href="../index.php" class="nav-link">Home</a>
                <a href="../admin.php" class="nav-link">Admin</a>
                <a href="read.php" class="nav-link">View Users</a>
                <a href="create.php" class="nav-link">Create User</a>
            </nav>
        </div>
    </header>

    <main class="main">
        <div class="container">
            <div class="page-header">
                <h2 class="page-title">Delete User</h2>
                <p class="page-subtitle">User deletion result</p>
            </div>

            <!-- Added success and error message cards -->
            <?php if ($success): ?>
                <div class="alert alert-success">
                    <div class="alert-icon">✓</div>
                    <div class="alert-content">
                        <h3>Success!</h3>
                        <p>User deleted successfully.</p>
                        <?php if ($user): ?>
                            <p class="deleted-user-info">Deleted user: <strong><?php echo htmlspecialchars($user->getName()); ?></strong> (<?php echo htmlspecialchars($user->getEmail()); ?>)</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="alert alert-error">
                    <div class="alert-icon">⚠</div>
                    <div class="alert-content">
                        <h3>Error</h3>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Added action buttons -->
            <div class="page-actions">
                <a href="read.php" class="btn btn-primary">View All Users</a>
                <a href="create.php" class="btn btn-outline">Create New User</a>
                <a href="../index.php" class="btn btn-secondary">Back to Home</a>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 User Management System. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
