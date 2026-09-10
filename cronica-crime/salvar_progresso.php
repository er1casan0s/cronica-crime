<?php
// salvar_progresso.php - Marca caso como resolvido
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['nickname'])) {
    echo json_encode(['ok' => false, 'msg' => 'Não autenticado']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$caso  = (int)($input['caso'] ?? 0);

if ($caso < 1 || $caso > 3) {
    echo json_encode(['ok' => false, 'msg' => 'Caso inválido']);
    exit;
}

$_SESSION['progresso']["caso$caso"] = true;

// Se completou os 3, guarda tempo final
$todosOk = $_SESSION['progresso']['caso1']
        && $_SESSION['progresso']['caso2']
        && $_SESSION['progresso']['caso3'];

if ($todosOk) {
    $_SESSION['fim_tempo'] = time();
}

echo json_encode(['ok' => true, 'todos' => $todosOk]);