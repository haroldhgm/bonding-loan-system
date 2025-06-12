<?php 
require_once 'includes/auth.php'; 
logout(); 
header('Location: views/login.php'); 
exit; 
?>
