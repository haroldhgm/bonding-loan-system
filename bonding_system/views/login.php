<?php 
require_once '../includes/auth.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (loginStudent($email, $password)) { 
        header("Location: dashboard.php"); 
        exit; 
    } else { 
        $error = "Invalid credentials."; 
    } 
} 
?> 

<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Student Login</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
</head> 
<body> 
    <div class="container mt-5" style="max-width: 400px;">
        <h2 class="mb-4">Student Login</h2> 

        <?php if (isset($error)): ?> 
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div> 
        <?php endif; ?> 

        <form method="post"> 
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button> 
        </form> 
    </div>
</body> 
</html>
