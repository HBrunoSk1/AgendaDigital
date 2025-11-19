<?php
include "db.php";
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $sql = "INSERT INTO contatos (nome, email, telefone) VALUES ('$nome','$email','$telefone')";
    $conn->query($sql);

    header("Location: home.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Novo Contato</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
<div class="container mt-5">
<h2>Novo Contato</h2>
<form method="post" class="card p-4 shadow-sm">
    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Telefone</label>
        <input type="text" name="telefone" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="home.php" class="btn btn-secondary">Cancelar</a>
</form>
</div>
</body>
</html>
