<?php
include "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = md5($_POST['senha']);
    $check = $conn->query("SELECT * FROM usuarios WHERE usuario='$usuario'");
    if ($check->num_rows > 0) { $erro = "Usuário já existe!"; }
    else {
        $sql = "INSERT INTO usuarios (usuario, senha) VALUES ('$usuario', '$senha')";
        if ($conn->query($sql)) { $sucesso = "Usuário criado com sucesso! <a href='index.php'>Fazer login</a>"; }
        else { $erro = "Erro ao cadastrar usuário."; }
    }
}
?>
<!DOCTYPE html><html lang="pt-br"><head>
<meta charset="UTF-8"><title>Cadastro de Usuário</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css"></head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
<div class="card shadow p-4" style="width:25rem;">
<h3 class="text-center mb-3">Criar Novo Usuário</h3>
<?php if(isset($erro)) echo "<div class='alert alert-danger'>$erro</div>"; ?>
<?php if(isset($sucesso)) echo "<div class='alert alert-success'>$sucesso</div>"; ?>
<form method="post">
<div class="mb-3"><label class="form-label">Usuário</label><input type="text" name="usuario" class="form-control" required></div>
<div class="mb-3"><label class="form-label">Senha</label><input type="password" name="senha" class="form-control" required></div>
<button type="submit" class="btn btn-success w-100">Cadastrar</button>
<a href="index.php" class="btn btn-secondary w-100 mt-2">Voltar</a></form>
</div></body></html>