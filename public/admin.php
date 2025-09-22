<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Exponet</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Fixed header to use consistent navigation structure -->
    <header class="header">
        <div class="container">
            <h1 class="logo"><i class="fas fa-shield-alt"></i> Admin Dashboard</h1>
            <nav class="nav">
                <a href="index.php" class="nav-link">Home</a>
                <a href="admin.php" class="nav-link active">Admin Panel</a>
                <a href="user/read.php" class="nav-link">View Users</a>
            </nav>
        </div>
    </header>

    <main class="main">
        <div class="container">
            <div class="page-header">
                <h2 class="page-title">User Management</h2>
                <p class="page-subtitle">Manage users and monitor system activity</p>
            </div>

            <?php
            require_once("../src/controller/UserController.php");
            $userController = new UserController();
            $users = $userController->readAll();
            $userCount = $users ? count($users) : 0;
            ?>

            <!-- Added statistics cards for better overview -->
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-number"><?php echo $userCount; ?></span>
                    <div class="stat-label">
                        <i class="fas fa-users"></i> Total Users
                    </div>
                </div>
                <div class="stat-card">
                    <span class="stat-number"><?php echo $userCount > 0 ? number_format(array_sum(array_map(function($user) { return $user->getAge(); }, $users)) / $userCount, 1) : '0'; ?></span>
                    <div class="stat-label">
                        <i class="fas fa-chart-line"></i> Average Age
                    </div>
                </div>
                <div class="stat-card">
                    <span class="stat-number"><?php echo date('M d'); ?></span>
                    <div class="stat-label">
                        <i class="fas fa-calendar"></i> Today
                    </div>
                </div>
            </div>

            <!-- Redesigned user display with modern card grid layout -->
            <div class="card">
                <?php if ($users): ?>
                    <div class="user-grid">
                        <?php foreach ($users as $user): ?>
                            <div class="user-card">
                                <div class="user-info">
                                    <h3><?php echo htmlspecialchars($user->getName()); ?></h3>
                                    <div class="user-detail">
                                        <i class="fas fa-envelope"></i>
                                        <span><?php echo htmlspecialchars($user->getEmail()); ?></span>
                                    </div>
                                    <div class="user-detail">
                                        <i class="fas fa-birthday-cake"></i>
                                        <span><?php echo htmlspecialchars($user->getAge()); ?> years old</span>
                                    </div>
                                    <div class="user-detail">
                                        <i class="fas fa-id-badge"></i>
                                        <span>ID: <?php echo htmlspecialchars($user->getId()); ?></span>
                                    </div>
                                </div>
                                <div class="user-actions">
                                    <button class="btn btn-secondary btn-sm" onclick="document.location='user/read.php?id=<?php echo htmlspecialchars($user->getId()); ?>'">
                                        <i class="fas fa-eye"></i>
                                        View
                                    </button>
                                    <button class="btn btn-primary btn-sm" onclick="document.location='user/update.php?id=<?php echo htmlspecialchars($user->getId()); ?>'">
                                        <i class="fas fa-edit"></i>
                                        Edit
                                    </button>
                                    <button class="btn btn-destructive btn-sm" onclick="if(confirm('Are you sure you want to delete this user?')) document.location='user/delete.php?id=<?php echo htmlspecialchars($user->getId()); ?>'">
                                        <i class="fas fa-trash"></i>
                                        Delete
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <!-- Added modern empty state design -->
                    <div class="empty-state">
                        <i class="fas fa-users" style="font-size: 4rem; color: var(--muted-foreground); margin-bottom: 1rem;"></i>
                        <h3>No Users Found</h3>
                        <p>Start by adding your first user through the user form.</p>
                        <button class="btn btn-primary" onclick="document.location='index.php'" style="margin-top: 1rem;">
                            <i class="fas fa-plus"></i>
                            Add First User
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <!-- Added footer with modern styling -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Exponet Admin Dashboard</p>
        </div>
    </footer>
</body>
</html>
