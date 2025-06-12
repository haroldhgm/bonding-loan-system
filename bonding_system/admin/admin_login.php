<?php 
require_once '../includes/admin_auth.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    if (loginAdmin($_POST['username'], $_POST['password'])) { 
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
    <title>Admin Login</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head> 
<body> 
    <div class="container mt-5" style="max-width: 400px;">
        <h2 class="mb-4 text-center">Admin Login</h2> 

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</body> 
</html>
