<?php
// final.php - Mostra tempo total e nickname
session_start();

if (!isset($_SESSION['nickname'])) {
    header('Location: index.php');
    exit;
}

$nickname = $_SESSION['nickname'];
$inicio   = $_SESSION['inicio_tempo'] ?? time();
$fim      = time();
$tempo    = $fim - $inicio;

// Formata mm:ss
$min = floor($tempo / 60);
$seg = $tempo % 60;
$tempo_formatado = sprintf('%02d:%02d', $min, $seg);

$prog = $_SESSION['progresso'] ?? [];
$total = count(array_filter($prog));

// Salva no banco (opcional)
require 'includes/db.php';
if ($pdo) {
    try {
        $stmt = $pdo->prepare("INSERT INTO recordes (nickname, tempo_total, casos_resolvidos) VALUES (?, ?, ?)");
        $stmt->execute([$nickname, $tempo, $total]);
    } catch (Exception $e) { /* silencioso */ }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultado Final - Crônicas do Crime</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="tela-final">
    <div class="container-final">
        <h1>🎉 PARABÉNS, <?= strtoupper($nickname) ?>!</h1>
        <p class="subtitulo">Você concluiu a investigação!</p>

        <div class="resultado">
            <div class="bloco">
                <span class="label">Casos Resolvidos</span>
                <span class="valor"><?= $total ?> / 3</span>
            </div>
            <div class="bloco destaque">
                <span class="label">⏱️ Tempo Total</span>
                <span class="valor" id="tempo"><?= $tempo_formatado ?></span>
            </div>
            <div class="bloco">
                <span class="label">Detetive</span>
                <span class="valor"><?= $nickname ?></span>
            </div>
        </div>

        <div class="acoes">
            <a href="casos.php" class="btn">Voltar aos Casos</a>
            <a href="index.php?reiniciar=1" class="btn btn-secundario">Novo Jogo</a>
        </div>
    </div>
</body>
</html>