<?php
session_start();
include "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = md5($_POST['senha']);
    $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND senha='$senha'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $_SESSION['usuario'] = $usuario;
        header("Location: home.php");
        exit;
    } else { $erro = "Usuário ou senha inválidos!"; }
}
?>
<!DOCTYPE html><html lang="pt-br"><head>
<meta charset="UTF-8"><title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css"></head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
<div class="card shadow p-4" style="width:25rem;">
<h3 class="text-center mb-3">Acesso ao Sistema</h3>
<?php if(isset($erro)) echo "<div class='alert alert-danger'>$erro</div>"; ?>
<form method="post">
<div class="mb-3"><label class="form-label">Usuário</label><input type="text" name="usuario" class="form-control" required></div>
<div class="mb-3"><label class="form-label">Senha</label><input type="password" name="senha" class="form-control" required></div>
<button type="submit" class="btn btn-primary w-100">Entrar</button></form>
<p class="mt-3 text-center">Ainda não tem conta? <a href="register.php">Cadastre-se</a></p>
</div></body></html>