<?php 
require_once '../includes/auth.php'; 
require_once '../includes/functions.php'; 

if (!isStudentLoggedIn()) { 
    header("Location: login.php"); 
    exit; 
} 

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $program = trim($_POST['program'] ?? '');
    $university = trim($_POST['university'] ?? '');

    $msce = uploadFile($_FILES['msce'], 'msce'); 
    $id_file = uploadFile($_FILES['id'], 'ids'); 

    if ($msce && $id_file) { 
        submitApplication($_SESSION['student_id'], [
            'program' => $program,
            'university' => $university
        ], $msce, $id_file); 
        $msg = "Application submitted successfully."; 
    } else { 
        $error = "File upload failed. Ensure both files are valid format and below size limits."; 
    } 
} 
?> 

<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Apply for Bond</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head> 
<body> 
    <div class="container mt-5" style="max-width: 600px;">
        <h2>Bond Application</h2> 

        <?php if (isset($msg)): ?> 
            <div class="alert alert-success"><?= htmlspecialchars($msg) ?></div> 
        <?php endif; ?> 

        <?php if (isset($error)): ?> 
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div> 
        <?php endif; ?> 

        <form method="post" enctype="multipart/form-data"> 
            <div class="mb-3">
                <label>Program of Study</label>
                <input type="text" name="program" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>University Name</label>
                <input type="text" name="university" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>MSCE Certificate (PDF/JPG)</label>
                <input type="file" name="msce" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
            </div>

            <div class="mb-3">
                <label>National ID (PDF/JPG)</label>
                <input type="file" name="id" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Submit Application</button> 
        </form> 
    </div>
</body> 
</html>
