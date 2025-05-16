<?php
session_start();

if (!isset($_SESSION['user_id']) || 
    !isset($_SESSION['user_role']) || 
    $_SESSION['user_role'] !== 'Administrateur') {
    http_response_code(403);
    exit();
}

http_response_code(200);
?>