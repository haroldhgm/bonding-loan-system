<?php 
require_once '../includes/admin_auth.php'; 
require_once '../includes/functions.php'; 

if (!isAdminLoggedIn()) { 
    header("Location: admin_login.php"); 
    exit; 
} 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['app_id'])) { 
    $status = $_POST['action'] === 'approve' ? 'approved' : 'rejected'; 
    updateApplicationStatus($_POST['app_id'], $status); 
} 

$applications = getAllApplications(); 
?> 

<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Admin Dashboard</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head> 
<body> 
<div class="container mt-5"> 
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Admin Dashboard</h2>
        <div>
            <a href="export.php" class="btn btn-success btn-sm">Export Applications</a>
            <a href="../includes/admin_auth.php?logout=true" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>

    <h4 class="mb-3">All Applications</h4> 
    <table class="table table-bordered table-striped table-hover"> 
        <thead class="table-dark">
            <tr> 
                <th>Student</th> 
                <th>Email</th> 
                <th>Program</th> 
                <th>University</th> 
                <th>MSCE</th> 
                <th>ID</th> 
                <th>Status</th> 
                <th>Action</th> 
            </tr> 
        </thead>
        <tbody>
            <?php foreach ($applications as $app): ?> 
            <tr> 
                <td><?= htmlspecialchars($app['name']) ?></td> 
                <td><?= htmlspecialchars($app['email']) ?></td> 
                <td><?= htmlspecialchars($app['program']) ?></td> 
                <td><?= htmlspecialchars($app['university']) ?></td> 
                <td><a href="../uploads/msce/<?= $app['msce_file'] ?>" target="_blank" class="btn btn-sm btn-outline-primary">View</a></td> 
                <td><a href="../uploads/ids/<?= $app['id_file'] ?>" target="_blank" class="btn btn-sm btn-outline-primary">View</a></td> 
                <td>
                    <span class="badge bg-<?= 
                        $app['status'] === 'approved' ? 'success' : 
                        ($app['status'] === 'rejected' ? 'danger' : 'secondary') 
                    ?>">
                        <?= ucfirst($app['status']) ?>
                    </span>
                </td> 
                <td> 
                    <form method="post" onsubmit="return confirm('Are you sure?');" class="d-flex gap-1">
                        <input type="hidden" name="app_id" value="<?= $app['id'] ?>"> 
                        <button type="submit" name="action" value="approve" class="btn btn-sm btn-success">Approve</button> 
                        <button type="submit" name="action" value="reject" class="btn btn-sm btn-danger">Reject</button> 
                    </form> 
                </td> 
            </tr> 
            <?php endforeach; ?> 
        </tbody>
    </table> 
</div> 
</body> 
</html>
