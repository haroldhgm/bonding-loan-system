<?php 
require_once 'db.php'; 

function uploadFile($file, $path) { 
    $filename = uniqid() . '_' . basename($file['name']); 
    $target = "../uploads/$path/" . $filename; 

    if (move_uploaded_file($file['tmp_name'], $target)) { 
        return $filename; 
    } 
    return false; 
} 

function getApplications($status = null) { 
    global $pdo; 
    $query = "SELECT * FROM applications"; 

    if ($status !== null) { 
        $query .= " WHERE status = ?"; 
        $stmt = $pdo->prepare($query); 
        $stmt->execute([$status]); 
    } else { 
        $stmt = $pdo->query($query); 
    } 

    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
}
