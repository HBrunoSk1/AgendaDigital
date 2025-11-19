<?php
session_start();
if (!isset($_SESSION['usuario'])) { header('Location: index.php'); exit; }
include 'db.php';

// Obter usuário atual e checar admin
$stmt = $conn->prepare("SELECT id, role FROM usuarios WHERE usuario = ? LIMIT 1");
$stmt->bind_param('s', $_SESSION['usuario']);
$stmt->execute();
$res = $stmt->get_result();
$cur = $res->fetch_assoc();
if (!$cur) { header('Location: users.php?error=' . urlencode('Usuário inválido')); exit; }
if ($cur['role'] !== 'admin') { header('Location: users.php?error=' . urlencode('Sem permissão')); exit; }

$currentId = (int)$cur['id'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: users.php'); exit; }

if (!isset($_POST['id']) || !is_numeric($_POST['id'])) { header('Location: users.php?error=' . urlencode('ID inválido')); exit; }
$targetId = (int)$_POST['id'];
if ($targetId === $currentId) { header('Location: users.php?error=' . urlencode('Não é possível alterar sua própria permissão')); exit; }

if (!isset($_POST['role']) || !in_array($_POST['role'], ['admin','user'])) { header('Location: users.php?error=' . urlencode('Role inválida')); exit; }
$newRole = $_POST['role'];

// Se rebaixando um admin, garantir que não será o último admin
$stmt2 = $conn->prepare("SELECT role FROM usuarios WHERE id = ? LIMIT 1");
$stmt2->bind_param('i', $targetId);
$stmt2->execute();
$r2 = $stmt2->get_result();
$t = $r2->fetch_assoc();
if (!$t) { header('Location: users.php?error=' . urlencode('Usuário não encontrado')); exit; }

if ($t['role'] === 'admin' && $newRole !== 'admin') {
    $r = $conn->query("SELECT COUNT(*) as cnt FROM usuarios WHERE role='admin'");
    $c = $r->fetch_assoc();
    if ($c['cnt'] <= 1) { header('Location: users.php?error=' . urlencode('Não é possível rebaixar o último admin')); exit; }
}

// Aplicar alteração
$upd = $conn->prepare("UPDATE usuarios SET role = ? WHERE id = ?");
$upd->bind_param('si', $newRole, $targetId);
if ($upd->execute()) {
    header('Location: users.php?msg=' . urlencode('Permissão alterada com sucesso'));
    exit;
} else {
    header('Location: users.php?error=' . urlencode('Erro ao alterar permissão'));
    exit;
}
