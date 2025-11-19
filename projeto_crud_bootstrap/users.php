<?php
session_start();
if (!isset($_SESSION['usuario'])) { header("Location: index.php"); exit; }
include "db.php";
// Garantir que exista coluna `role` na tabela `usuarios`
$check = $conn->query("SHOW COLUMNS FROM usuarios LIKE 'role'");
if ($check && $check->num_rows == 0) {
    $conn->query("ALTER TABLE usuarios ADD role ENUM('admin','user') NOT NULL DEFAULT 'user'");
    // Se existir usuário 'admin' definido no SQL inicial, promova-o
    $conn->query("UPDATE usuarios SET role='admin' WHERE usuario='admin'");
}

$result = $conn->query("SELECT id, usuario, role FROM usuarios ORDER BY id DESC");
// Obter role do usuário atual
$stmt = $conn->prepare("SELECT id, role FROM usuarios WHERE usuario = ? LIMIT 1");
$stmt->bind_param('s', $_SESSION['usuario']);
$stmt->execute();
$curRes = $stmt->get_result();
$currentUser = $curRes->fetch_assoc();
$currentRole = $currentUser['role'] ?? 'user';
// Capturar mensagens via query string
$msg = isset($_GET['msg']) ? urldecode($_GET['msg']) : null;
$error = isset($_GET['error']) ? urldecode($_GET['error']) : null;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2>Usuários cadastrados</h2>
            <p>Lista de contas do sistema (senhas não exibidas).</p>
        </div>
        <div>
            <a href="home.php" class="btn btn-secondary">Voltar</a>
            <a href="register.php" class="btn btn-success">Novo Usuário</a>
        </div>
    </div>

    <?php if ($msg) { ?>
        <div class="alert alert-success"><?= htmlspecialchars($msg) ?></div>
    <?php } ?>
    <?php if ($error) { ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php } ?>

    <table class="table table-striped table-hover">
        <thead>
            <tr><th>ID</th><th>Usuário</th><th>Role</th><th>Ações</th></tr>
        </thead>
        <tbody>
        <?php if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['usuario']) ?></td>
                    <td><?= htmlspecialchars($row['role'] ?? 'user') ?></td>
                    <td>
                        <?php if ($currentRole === 'admin') { ?>
                            <?php if ($row['id'] != ($currentUser['id'] ?? 0)) { ?>
                                <a href="delete_user.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir usuário <?= htmlspecialchars($row['usuario']) ?>?')">Excluir</a>
                                <!-- Formulário curto para alterar role -->
                                <form method="post" action="change_role.php" style="display:inline-block;margin-left:6px;">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <?php if (($row['role'] ?? 'user') === 'admin') { ?>
                                        <input type="hidden" name="role" value="user">
                                        <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Rebaixar <?= htmlspecialchars($row['usuario']) ?> para usuário padrão?')">Rebaixar</button>
                                    <?php } else { ?>
                                        <input type="hidden" name="role" value="admin">
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Promover <?= htmlspecialchars($row['usuario']) ?> a admin?')">Promover</button>
                                    <?php } ?>
                                </form>
                            <?php } else { ?>
                                <span class="text-muted">Seu usuário</span>
                            <?php } ?>
                        <?php } else { ?>
                            <span class="text-muted">Sem permissão</span>
                        <?php } ?>
                    </td>
                </tr>
        <?php }
        } else { ?>
            <tr><td colspan="4">Nenhum usuário encontrado.</td></tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
