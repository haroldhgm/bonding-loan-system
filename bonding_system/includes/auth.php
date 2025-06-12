<?php 
session_start(); 
require_once 'db.php'; 

function loginStudent($email, $password) { 
    global $pdo; 
    $stmt = $pdo->prepare("SELECT * FROM students WHERE email = ?"); 
    $stmt->execute([$email]); 
    $user = $stmt->fetch(); 
    if ($user && password_verify($password, $user['password'])) { 
        $_SESSION['student_id'] = $user['id']; 
        return true; 
    } 
    return false; 
} 

function isStudentLoggedIn() { 
    return isset($_SESSION['student_id']); 
} 

function logoutStudent() { 
    session_destroy(); 
    header("Location: ../views/login.php"); 
    exit; 
} 
?>
