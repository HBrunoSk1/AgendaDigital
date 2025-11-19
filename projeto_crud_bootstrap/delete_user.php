<?php
session_start();
if (!isset($_SESSION['usuario'])) { header('Location: index.php'); exit; }
include 'db.php';

// Obter usuário atual
$stmt = $conn->prepare("SELECT id, role FROM usuarios WHERE usuario = ? LIMIT 1");
$stmt->bind_param('s', $_SESSION['usuario']);
$stmt->execute();
$res = $stmt->get_result();
$cur = $res->fetch_assoc();
if (!$cur) { header('Location: users.php?error=Usuário+inválido'); exit; }
if ($cur['role'] !== 'admin') { header('Location: users.php?error=Sem+permissão'); exit; }

$currentId = (int)$cur['id'];

// Validar id alvo
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) { header('Location: users.php?error=ID+inválido'); exit; }
$targetId = (int)$_GET['id'];
if ($targetId === $currentId) { header('Location: users.php?error=Não+é+possível+excluir+seu+próprio+usuário'); exit; }

// Verificar se usuário alvo é admin
$stmt2 = $conn->prepare("SELECT role FROM usuarios WHERE id = ? LIMIT 1");
$stmt2->bind_param('i', $targetId);
$stmt2->execute();
$res2 = $stmt2->get_result();
$target = $res2->fetch_assoc();
if (!$target) { header('Location: users.php?error=Usuário+não+encontrado'); exit; }

if ($target['role'] === 'admin') {
    // Contar admins
    $r = $conn->query("SELECT COUNT(*) as cnt FROM usuarios WHERE role='admin'");
    $c = $r->fetch_assoc();
    if ($c['cnt'] <= 1) { header('Location: users.php?error=Não+é+possível+excluir+o+último+admin'); exit; }
}

// Executar exclusão
$del = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
$del->bind_param('i', $targetId);
if ($del->execute()) {
    header('Location: users.php?msg=Usuário+excluído+com+sucesso');
    exit;
} else {
    header('Location: users.php?error=Erro+ao+excluir+usuário');
    exit;
}
