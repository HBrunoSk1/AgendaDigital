<?php
include "db.php";
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$conn->query("DELETE FROM contatos WHERE id=$id");

header("Location: home.php");
exit;
?>
