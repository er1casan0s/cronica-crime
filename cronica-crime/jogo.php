<?php
// jogo.php - Mapa interativo com as 9 pistas
session_start();
require 'includes/casos.php';

if (!isset($_SESSION['nickname'])) {
    header('Location: index.php');
    exit;
}

$num = (int)($_GET['caso'] ?? 1);
if (!isset($CASOS[$num])) $num = 1;

// Verifica se está liberado
function liberado($n, $p) {
    if ($n == 1) return true;
    if ($n == 2) return $p['caso1'];
    if ($n == 3) return $p['caso2'];
    return false;
}
if (!liberado($num, $_SESSION['progresso'])) {
    header('Location: casos.php');
    exit;
}

$caso = $CASOS[$num];

// Se já concluiu, pode revisitar livremente
$concluido = $_SESSION['progresso']["caso$num"] ?? false;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= $caso['nome'] ?> - Crônicas do Crime</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="tela-jogo">
    <header class="topo-jogo">
        <a href="casos.php" class="btn-voltar">← Voltar</a>
        <h1>Caso <?= $num ?>: <?= $caso['nome'] ?></h1>
        <div class="progresso-jogo">
            Pistas: <span id="contador">0</span> / 9
        </div>
    </header>

    <main class="area-jogo">
        <!-- Mapa com hotspots -->
        <div class="mapa-container" id="mapa">
            <img src="<?= $caso['imagem'] ?>" alt="Mapa do caso" class="mapa-img"
                 onerror="this.style.display='none';document.getElementById('fallback').style.display='flex'">
            <div id="fallback" class="fallback-mapa">
                🗺️ [ Substitua por <?= $caso['imagem'] ?> — mapa em preto e branco ]
            </div>

            <!-- Hotspots gerados dinamicamente -->
            <?php foreach ($caso['cartas'] as $carta): ?>
                <button class="hotspot" 
                        data-id="<?= $carta['id'] ?>"
                        style="left: <?= $carta['x'] ?>%; top: <?= $carta['y'] ?>%;"
                        title="Pista <?= $carta['id'] ?>">
                    ?
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Painel lateral -->
        <aside class="painel">
            <h2>📋 Caderno de Pistas</h2>
            <ul id="lista-pistas" class="lista-pistas"></ul>

            <div class="painel-acoes">
                <button id="btn-verificar" class="btn btn-verificar" disabled>
                    ✅ ACUSAR
                </button>
                <button id="btn-reiniciar" class="btn btn-reiniciar">
                    🔄 Reiniciar
                </button>
            </div>

            <div id="feedback" class="feedback"></div>
        </aside>
    </main>

    <!-- Modal de pista -->
    <div id="modal" class="modal">
        <div class="modal-conteudo">
            <h3 id="modal-titulo"></h3>
            <p id="modal-pista"></p>
            <button class="btn" onclick="fecharModal()">Entendi</button>
        </div>
    </div>

    <script>
        // Dados do caso atual (enviados pelo PHP)
        const CASO = <?= json_encode($caso, JSON_UNESCAPED_UNICODE) ?>;
        const CASO_NUM = <?= $num ?>;
        const CONCLUIDO = <?= $concluido ? 'true' : 'false' ?>;
    </script>
    <script src="assets/js/jogo.js"></script>
</body>
</html>