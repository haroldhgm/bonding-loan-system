<?php 
require_once '../includes/db.php'; 
require_once '../includes/auth.php'; 
require_once '../includes/functions.php'; 

require_login(); 

$id = intval($_GET['id'] ?? 0); 
$user_id = $_SESSION['user_id']; 

$stmt = $pdo->prepare("SELECT * FROM applications WHERE id = ? AND user_id = ?"); 
$stmt->execute([$id, $user_id]); 
$app = $stmt->fetch(PDO::FETCH_ASSOC); 

if (!$app) { 
    die("Application not found or access denied."); 
} 

// Prepare data for PDF 
$data = [ 
    'Full Name' => $app['fullname'], 
    'Email' => $app['email'], 
    'Phone' => $app['phone'], 
    'Submitted At' => $app['submitted_at'] 
]; 

// Generate PDF 
$file_path = generate_pdf($data); 

// Send PDF for download 
header('Content-Type: application/pdf'); 
header('Content-Disposition: attachment; filename="application_' . $app['id'] . '.pdf"'); 
readfile($file_path); 
unlink($file_path); // delete temp file after download 
exit; 
?>
