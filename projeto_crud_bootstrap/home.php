<?php
session_start();
if (!isset($_SESSION['usuario'])) { header("Location: index.php"); exit; }
include "db.php";
$result = $conn->query("SELECT * FROM contatos");
?>
<!DOCTYPE html><html lang="pt-br"><head>
<meta charset="UTF-8"><title>Painel</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css"></head>
<body>
<div class="container mt-5">
<div class="d-flex justify-content-between align-items-center mb-3">
<div>
<h2 class="welcome">Bem-vindo(a), <?php echo $_SESSION['usuario']; ?> 🎉</h2>
<p>Você entrou no sistema com sucesso.</p>
</div>
<div>
<a href="add.php" class="btn btn-success">+ Novo Contato</a>
<a href="users.php" class="btn btn-info text-white">Usuários</a>
<a href="logout.php" class="btn btn-outline-danger">Sair</a>
</div></div>
<table class="table table-striped table-hover">
<thead><tr><th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Ações</th></tr></thead>
<tbody>
<?php while ($row = $result->fetch_assoc()) { ?>
<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['nome'] ?></td>
<td><?= $row['email'] ?></td>
<td><?= $row['telefone'] ?></td>
<td>
<a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
<a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir este contato?')">Excluir</a>
</td></tr>
<?php } ?>
</tbody></table></div></body></html>