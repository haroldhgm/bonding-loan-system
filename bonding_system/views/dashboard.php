<?php 
require_once '../includes/auth.php'; 
require_once '../includes/functions.php'; 

if (!isStudentLoggedIn()) { 
    header("Location: login.php"); 
    exit; 
} 

$applications = getStudentApplications($_SESSION['student_id']); 
?> 

<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Student Dashboard</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head> 
<body> 
    <div class="container mt-5">
        <h2 class="mb-4">Welcome to Your Dashboard</h2> 

        <div class="mb-3">
            <a href="apply.php" class="btn btn-success me-2">New Application</a>  
            <a href="../logout.php" class="btn btn-danger">Logout</a>
        </div>

        <h4>Your Applications</h4> 
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-dark">
                <tr> 
                    <th>Program</th> 
                    <th>University</th> 
                    <th>Status</th> 
                    <th>MSCE</th> 
                    <th>ID</th> 
                </tr> 
            </thead>
            <tbody>
                <?php if (!empty($applications)): ?>
                    <?php foreach ($applications as $app): ?> 
                        <tr> 
                            <td><?= htmlspecialchars($app['program']) ?></td> 
                            <td><?= htmlspecialchars($app['university']) ?></td> 
                            <td><?= ucfirst($app['status']) ?></td> 
                            <td><a href="../uploads/msce/<?= urlencode($app['msce_file']) ?>" target="_blank">View</a></td> 
                            <td><a href="../uploads/ids/<?= urlencode($app['id_file']) ?>" target="_blank">View</a></td> 
                        </tr> 
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">No applications submitted yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body> 
</html>
