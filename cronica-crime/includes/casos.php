<?php
// includes/casos.php
// Definição dos 3 casos com suas 9 cartas/passos cada

session_start();

// Inicializa progresso do jogador
if (!isset($_SESSION['progresso'])) {
    $_SESSION['progresso'] = [
        'caso1' => false,
        'caso2' => false,
        'caso3' => false
    ];
}

$CASOS = [
    1 => [
        'id' => 1,
        'nome' => 'O Silêncio das Ruas de Ferro',
        'dificuldade' => 'Difícil',
        'local' => 'Centro da Cidade',
        'descricao' => 'Um empresário foi encontrado morto em seu escritório no 12º andar. Ninguém viu nada. Ninguém ouviu nada. Mas as ruas de Ferro sempre sussurram a verdade.',
        'imagem' => 'assets/img/caso1.jpg',
        'cor' => '#8B0000',
        // 9 cartas / pistas em ordem correta
        'cartas' => [
            ['id' => 1, 'titulo' => 'Cena do Crime',   'pista' => 'Encontre o corpo do empresário no escritório do 12º andar.', 'x' => 55, 'y' => 30],
            ['id' => 2, 'titulo' => 'Janela Aberta',   'pista' => 'Observe a janela entreaberta — foi por ali que o assassino escapou.', 'x' => 62, 'y' => 28],
            ['id' => 3, 'titulo' => 'Cabo de Aço',     'pista' => 'Siga o cabo de aço até o prédio vizinho. Alguém desceu por ele.', 'x' => 70, 'y' => 40],
            ['id' => 4, 'titulo' => 'Pegadas no Telhado','pista' => 'Pegadas frescas levam até a caixa d\'água do prédio ao lado.', 'x' => 74, 'y' => 35],
            ['id' => 5, 'titulo' => 'Bilhete Rasgado', 'pista' => 'Um bilhete rasgado no telhado revela uma reunião marcada.', 'x' => 78, 'y' => 33],
            ['id' => 6, 'titulo' => 'Câmera de Trânsito','pista' => 'A câmera da esquina filmou um carro preto fugindo às 23h47.', 'x' => 45, 'y' => 55],
            ['id' => 7, 'titulo' => 'Placa Falsa',     'pista' => 'A placa do carro pertence a um ferro-velho abandonado.', 'x' => 30, 'y' => 65],
            ['id' => 8, 'titulo' => 'O Ferro-Velho',   'pista' => 'No ferro-velho, encontre a arma do crime escondida.', 'x' => 22, 'y' => 72],
            ['id' => 9, 'titulo' => 'O Assassino',     'pista' => 'O dono do ferro-velho é o sócio traído do empresário. Caso resolvido!', 'x' => 18, 'y' => 78],
        ],
        'solucao' => 'O assassino era o sócio do empresário, que usou o ferro-velho como esconderijo.'
    ],
    2 => [
        'id' => 2,
        'nome' => 'Sombras na Maré Alta',
        'dificuldade' => 'Médio',
        'local' => 'Praia de Coral + Cidade Baixa',
        'descricao' => 'Um turista desapareceu durante o pôr do sol na Praia de Coral. Sua bolsa foi encontrada na areia — vazia. A maré pode ter levado mais que segredos.',
        'imagem' => 'assets/img/caso2.jpg',
        'cor' => '#FF8C00',
        'cartas' => [
            ['id' => 1, 'titulo' => 'Bolsa na Areia',    'pista' => 'Encontre a bolsa abandonada perto do quiosque amarelo.', 'x' => 25, 'y' => 60],
            ['id' => 2, 'titulo' => 'Pegadas',           'pista' => 'Pegadas molhadas levam da bolsa até o calçadão.', 'x' => 35, 'y' => 55],
            ['id' => 3, 'titulo' => 'Sorvete Derretido', 'pista' => 'Um sorvete derretido indica que o turista parou ali.', 'x' => 42, 'y' => 58],
            ['id' => 4, 'titulo' => 'Testemunha',        'pista' => 'Um vendedor de coco viu um homem de boné levar a turista.', 'x' => 50, 'y' => 62],
            ['id' => 5, 'titulo' => 'Van Suspeita',      'pista' => 'Uma van branca sem placa foi vista saindo da praia.', 'x' => 60, 'y' => 50],
            ['id' => 6, 'titulo' => 'Pedágio',           'pista' => 'A van passou no pedágio da cidade baixa às 19h30.', 'x' => 70, 'y' => 45],
            ['id' => 7, 'titulo' => 'Galpão',            'pista' => 'A van entrou num galpão abandonado no porto.', 'x' => 78, 'y' => 38],
            ['id' => 8, 'titulo' => 'Cativeiro',         'pista' => 'A turista está amarrada dentro do galpão. Chame a polícia!', 'x' => 82, 'y' => 32],
            ['id' => 9, 'titulo' => 'O Cúmplice',        'pista' => 'O sequestrador era o ex-namorado dela. Caso resolvido!', 'x' => 85, 'y' => 28],
        ],
        'solucao' => 'O ex-namorado sequestrou a turista por vingança.'
    ],
    3 => [
        'id' => 3,
        'nome' => 'O Segredo do Quadro Negro',
        'dificuldade' => 'Fácil',
        'local' => 'Escola Municipal',
        'descricao' => 'O troféu de ouro da escola desapareceu da sala dos professores. Todos são suspeitos. Alguém deixou pistas — cabe a você encontrá-las.',
        'imagem' => 'assets/img/caso3.jpg',
        'cor' => '#2E8B57',
        'cartas' => [
            ['id' => 1, 'titulo' => 'Vitrine Vazia',   'pista' => 'A vitrine do troféu está aberta na sala dos professores.', 'x' => 30, 'y' => 40],
            ['id' => 2, 'titulo' => 'Chave Esquecida', 'pista' => 'Uma chave caída no chão pertence ao armário do zelador.', 'x' => 38, 'y' => 45],
            ['id' => 3, 'titulo' => 'Pegada de Tênis','pista' => 'Uma pegada de tênis novo segue pelo corredor.', 'x' => 45, 'y' => 52],
            ['id' => 4, 'titulo' => 'Bilhete',         'pista' => 'Um bilhete no lixo: "Hoje à noite, no ginásio".', 'x' => 52, 'y' => 58],
            ['id' => 5, 'titulo' => 'Ginásio',         'pista' => 'O ginásio está com a porta entreaberta.', 'x' => 60, 'y' => 65],
            ['id' => 6, 'titulo' => 'Mochila',         'pista' => 'Uma mochila escolar escondida atrás das arquibancadas.', 'x' => 68, 'y' => 70],
            ['id' => 7, 'titulo' => 'Troféu',          'pista' => 'O troféu está dentro da mochila. Mas de quem é?', 'x' => 75, 'y' => 75],
            ['id' => 8, 'titulo' => 'Crachá',          'pista' => 'O crachá no bolso da mochila tem um nome: "Lucas, 9º ano".', 'x' => 80, 'y' => 80],
            ['id' => 9, 'titulo' => 'Confissão',       'pista' => 'Lucas queria ganhar o prêmio de melhor aluno. Caso resolvido!', 'x' => 85, 'y' => 85],
        ],
        'solucao' => 'O aluno Lucas roubou o troféu para impressionar os pais.'
    ]
];
?>