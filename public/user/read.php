<?php
require_once("../../src/controller/UserController.php");

$userController = new UserController();
$user = null;
$users = [];
$error = '';

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $user = $userController->read($id);
        if (!$user) {
            $error = "User not found.";
        }
    } else {
        $users = $userController->readAll();
        if (!$users) {
            $error = "No users found.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($_GET['id']) ? 'View User' : 'All Users'; ?> - User Management System</title>
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
                <a href="create.php" class="nav-link">Create User</a>
            </nav>
        </div>
    </header>

    <main class="main">
        <div class="container">
            <div class="page-header">
                <h2 class="page-title"><?php echo isset($_GET['id']) ? 'User Details' : 'All Users'; ?></h2>
                <p class="page-subtitle"><?php echo isset($_GET['id']) ? 'View individual user information' : 'Browse all registered users'; ?></p>
            </div>

            <!-- Added error message display -->
            <?php if ($error): ?>
                <div class="alert alert-error">
                    <div class="alert-icon">⚠</div>
                    <div class="alert-content">
                        <h3>Error</h3>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Display single user in card format -->
            <?php if ($user): ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">User Information</h3>
                        <div class="card-actions">
                            <a href="update.php?id=<?php echo $user->getId(); ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="delete.php?id=<?php echo $user->getId(); ?>" class="btn btn-danger btn-sm" 
                               onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="user-details">
                            <div class="detail-item">
                                <span class="detail-label">ID:</span>
                                <span class="detail-value"><?php echo htmlspecialchars($user->getId()); ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Name:</span>
                                <span class="detail-value"><?php echo htmlspecialchars($user->getName()); ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Email:</span>
                                <span class="detail-value"><?php echo htmlspecialchars($user->getEmail()); ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Age:</span>
                                <span class="detail-value"><?php echo htmlspecialchars($user->getAge()); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Display all users in grid format -->
            <?php if (!empty($users) && !isset($_GET['id'])): ?>
                <div class="users-grid">
                    <?php foreach ($users as $user): ?>
                        <div class="user-card">
                            <div class="user-card-header">
                                <h3 class="user-name"><?php echo htmlspecialchars($user->getName()); ?></h3>
                                <span class="user-id">#<?php echo htmlspecialchars($user->getId()); ?></span>
                            </div>
                            <div class="user-card-content">
                                <p class="user-email"><?php echo htmlspecialchars($user->getEmail()); ?></p>
                                <p class="user-age">Age: <?php echo htmlspecialchars($user->getAge()); ?></p>
                            </div>
                            <div class="user-card-actions">
                                <a href="read.php?id=<?php echo $user->getId(); ?>" class="btn btn-outline btn-sm">View</a>
                                <a href="update.php?id=<?php echo $user->getId(); ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="delete.php?id=<?php echo $user->getId(); ?>" class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Added action buttons -->
            <div class="page-actions">
                <a href="../index.php" class="btn btn-secondary">Back to Home</a>
                <?php if (isset($_GET['id'])): ?>
                    <a href="read.php" class="btn btn-outline">View All Users</a>
                <?php endif; ?>
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
