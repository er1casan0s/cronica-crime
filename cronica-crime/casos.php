<?php
// casos.php - Seleção de casos com bloqueio progressivo
session_start();
require 'includes/casos.php';

// Recebe o nickname
if (isset($_POST['nickname'])) {
    $_SESSION['nickname'] = htmlspecialchars(trim($_POST['nickname']));
    $_SESSION['inicio_tempo'] = time();
    $_SESSION['progresso'] = ['caso1' => false, 'caso2' => false, 'caso3' => false];
} elseif (!isset($_SESSION['nickname'])) {
    header('Location: index.php');
    exit;
}

$nickname = $_SESSION['nickname'];
$progresso = $_SESSION['progresso'];

// Função auxiliar: caso está liberado?
function liberado($num, $prog) {
    if ($num == 1) return true;
    if ($num == 2) return $prog['caso1'];
    if ($num == 3) return $prog['caso2'];
    return false;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Casos - Crônicas do Crime</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="tela-casos">
    <header class="topo">
        <h1>🔎 Casos Disponíveis</h1>
        <div class="info-det">
            <span>Detetive: <strong><?= $nickname ?></strong></span>
            <a href="final.php?forcar=1" class="btn-sair">Encerrar</a>
        </div>
    </header>

    <main class="grid-casos">
        <?php foreach ($CASOS as $num => $caso):
            $aberto = liberado($num, $progresso);
            $concluido = $progresso["caso$num"] ?? false;
        ?>
            <div class="card-caso <?= $aberto ? '' : 'bloqueado' ?>"
                 style="--cor-caso: <?= $caso['cor'] ?>">
                <div class="card-img" style="background-image:url('<?= $caso['imagem'] ?>');">
                    <span class="badge-dificuldade"><?= $caso['dificuldade'] ?></span>
                </div>
                <div class="card-body">
                    <h2>Caso <?= $num ?>: <?= $caso['nome'] ?></h2>
                    <p class="local">📍 <?= $caso['local'] ?></p>
                    <p class="desc"><?= $caso['descricao'] ?></p>

                    <?php if ($concluido): ?>
                        <a href="jogo.php?caso=<?= $num ?>" class="btn btn-concluido">✔ Jogar novamente</a>
                    <?php elseif ($aberto): ?>
                        <a href="jogo.php?caso=<?= $num ?>" class="btn btn-jogar">INVESTIGAR</a>
                    <?php else: ?>
                        <button class="btn btn-bloqueado" disabled>🔒 Resolva o caso anterior</button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </main>

    <footer class="rodape">
        <p>🕐 Tempo começou quando você entrou. Boa sorte, <?= $nickname ?>!</p>
    </footer>
</body>
</html>