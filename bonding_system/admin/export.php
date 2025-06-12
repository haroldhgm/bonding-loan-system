<?php 
require_once '../includes/admin_auth.php'; 
require_once '../includes/functions.php'; 

if (!isAdminLoggedIn()) { 
    header("Location: admin_login.php"); 
    exit; 
} 

$apps = getAllApplications();

// Set headers to prompt download
header('Content-Type: text/csv; charset=UTF-8'); 
header('Content-Disposition: attachment; filename="bond_applications.csv"'); 
header('Pragma: no-cache'); 
header('Expires: 0');

// Open output buffer
$output = fopen('php://output', 'w');

// UTF-8 BOM for Excel
fwrite($output, "\xEF\xBB\xBF");

// Header row
fputcsv($output, ['Student', 'Email', 'Program', 'University', 'Status']);

// Rows
if (!empty($apps)) {
    foreach ($apps as $app) {
        fputcsv($output, [ 
            $app['name'], 
            $app['email'], 
            $app['program'], 
            $app['university'], 
            ucfirst($app['status']) 
        ]);
    }
} else {
    fputcsv($output, ['No data available']);
}

fclose($output); 
exit;
