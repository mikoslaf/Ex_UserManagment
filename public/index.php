<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exponet User Management</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Fixed header to use consistent navigation structure -->
    <header class="header">
        <div class="container">
            <h1 class="logo"><i class="fas fa-users"></i> Exponet User Management</h1>
            <nav class="nav">
                <a href="index.php" class="nav-link active">Home</a>
                <a href="admin.php" class="nav-link">Admin Panel</a>
                <a href="user/read.php" class="nav-link">View Users</a>
            </nav>
        </div>
    </header>

    <main class="main">
        <div class="container">
            <div class="page-header">
                <h2 class="page-title">Create New User</h2>
                <p class="page-subtitle">Add a new user to the system</p>
            </div>

            <!-- Wrapped form in modern card layout -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-user-plus"></i> User Information</h3>
                </div>
                <div class="card-content">
                    <form method="POST" action="user/create.php" class="form">
                        <div class="form-group">
                            <label for="name" class="form-label">
                                <i class="fas fa-user"></i> Full Name
                            </label>
                            <input type="text" id="name" name="name" class="form-input" required placeholder="Enter full name">
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope"></i> Email Address
                            </label>
                            <input type="email" id="email" name="email" class="form-input" required placeholder="Enter email address">
                        </div>

                        <div class="form-group">
                            <label for="age" class="form-label">
                                <i class="fas fa-calendar-alt"></i> Age
                            </label>
                            <input type="number" id="age" name="age" class="form-input" required placeholder="Enter age" min="1" max="120">
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                                Create User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- Added footer with modern styling -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Exponet User Management System</p>
        </div>
    </footer>
</body>
</html>
