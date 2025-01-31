<?php
include(__DIR__ . '/../functions/myFunctions.php');
session_start();
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    header('Location: ../index.php');
}
