<?php
// index.php - Tela inicial pedindo o nickname
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (isset($_SESSION['nickname'])) {
    header('Location: casos.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Crônicas do Crime - Início</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="tela-inicial">
    <div class="container-inicial">
        <h1>🕵️ CRÔNICAS DO CRIME</h1>
        <p class="subtitulo">Três casos. Nove pistas cada. Você consegue desvendar?</p>

        <form action="casos.php" method="POST" class="form-nickname">
            <label for="nickname">Digite seu nickname de detetive:</label>
            <input type="text" id="nickname" name="nickname" required
                   maxlength="20" placeholder="Ex: Detetive_Sombra" autofocus>
            <button type="submit">INICIAR INVESTIGAÇÃO 🔍</button>
        </form>

        <div class="aviso">
            <p>⚠️ Você só desbloqueará o próximo caso ao resolver o anterior.</p>
        </div>
    </div>
</body>
</html>