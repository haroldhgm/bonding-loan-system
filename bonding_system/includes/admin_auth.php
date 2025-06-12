<?php 
session_start(); 
require_once 'db.php'; 

function loginAdmin($username, $password) { 
    global $pdo; 
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?"); 
    $stmt->execute([$username]); 
    $admin = $stmt->fetch(); 
    if ($admin && password_verify($password, $admin['password'])) { 
        $_SESSION['admin_id'] = $admin['id']; 
        return true; 
    } 
    return false; 
} 

function isAdminLoggedIn() { 
    return isset($_SESSION['admin_id']); 
} 

function logoutAdmin() { 
    session_destroy(); 
    header("Location: admin_login.php"); 
    exit; 
} 
?>
