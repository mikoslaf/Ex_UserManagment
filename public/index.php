<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exponet Form</title>
</head>
<body>
    <button onclick="document.location='admin.php'">Admin panel</button>
    <h1>User Form</h1>
    <form method="POST" action="user/create.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required>
        <br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>