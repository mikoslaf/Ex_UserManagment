<?php
require_once("../../src/controller/UserController.php");

$userController = new UserController();
$user = null;
$success = false;
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = $userController->read($id);
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = [
        'id' => $_POST['id'] ?? '',
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'age' => $_POST['age'] ?? 0
    ];
    $result = $userController->update($data);
    if ($result) {
        $success = true;
        // Reload user data to show updated information
        $user = $userController->read($data['id']);
    } else {
        $errors = $userController->getErrors();
        // Keep user data for form repopulation
        $user = $userController->read($data['id']);
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
    <title>Update User - User Management System</title>
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
                <h2 class="page-title">Update User</h2>
                <p class="page-subtitle">Modify user information</p>
            </div>

            <!-- Added success and error message cards -->
            <?php if ($success): ?>
                <div class="alert alert-success">
                    <div class="alert-icon">✓</div>
                    <div class="alert-content">
                        <h3>Success!</h3>
                        <p>User updated successfully.</p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-error">
                    <div class="alert-icon">⚠</div>
                    <div class="alert-content">
                        <h3>Error</h3>
                        <p>Failed to update user:</p>
                        <?php foreach ($errors as $field => $error): ?>
                            <p class="error-detail">• <?php echo htmlspecialchars($field); ?>: <?php echo htmlspecialchars($error); ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="alert alert-error">
                    <div class="alert-icon">⚠</div>
                    <div class="alert-content">
                        <h3>Error</h3>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Wrapped form in modern card design -->
            <?php if ($user): ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">User Information</h3>
                        <span class="user-id">ID: <?php echo htmlspecialchars($user->getId()); ?></span>
                    </div>
                    <div class="card-content">
                        <form method="POST" action="update.php" class="form">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($user->getId()); ?>">
                            
                            <div class="form-group">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" id="name" name="name" class="form-input" 
                                       value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : htmlspecialchars($user->getName()); ?>" 
                                       required placeholder="Enter full name">
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" id="email" name="email" class="form-input" 
                                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : htmlspecialchars($user->getEmail()); ?>" 
                                       required placeholder="Enter email address">
                            </div>

                            <div class="form-group">
                                <label for="age" class="form-label">Age</label>
                                <input type="number" id="age" name="age" class="form-input" 
                                       value="<?php echo isset($_POST['age']) ? htmlspecialchars($_POST['age']) : htmlspecialchars($user->getAge()); ?>" 
                                       required placeholder="Enter age" min="1" max="120">
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Update User</button>
                                <a href="read.php?id=<?php echo $user->getId(); ?>" class="btn btn-outline">View User</a>
                                <a href="read.php" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-error">
                    <div class="alert-icon">⚠</div>
                    <div class="alert-content">
                        <h3>User Not Found</h3>
                        <p>The requested user could not be found.</p>
                    </div>
                </div>
                <div class="page-actions">
                    <a href="read.php" class="btn btn-primary">View All Users</a>
                    <a href="../index.php" class="btn btn-secondary">Back to Home</a>
                </div>
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
