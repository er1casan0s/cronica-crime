/* ============================================
   CRÔNICAS DO CRIME - Lógica do Jogo
   ============================================ */

let pistasEncontradas = [];
let ordemEsperada = CASO.cartas.map(c => c.id); // [1,2,...,9]

const modal       = document.getElementById('modal');
const modalTitulo = document.getElementById('modal-titulo');
const modalPista  = document.getElementById('modal-pista');
const lista       = document.getElementById('lista-pistas');
const contador    = document.getElementById('contador');
const btnVerificar = document.getElementById('btn-verificar');
const btnReiniciar = document.getElementById('btn-reiniciar');
const feedback    = document.getElementById('feedback');

/* ---------- Clique num hotspot ---------- */
document.querySelectorAll('.hotspot').forEach(hs => {
    hs.addEventListener('click', () => {
        const id = parseInt(hs.dataset.id);
        if (hs.classList.contains('encontrado')) return;

        const carta = CASO.cartas.find(c => c.id === id);
        if (!carta) return;

        // Se a ordem anterior já foi descoberta?
        const anteriorOk = id === 1 || pistasEncontradas.includes(id - 1);
        if (!anteriorOk) {
            mostrarFeedback('❌ Você ainda não tem contexto para esta pista. Procure a anterior!', 'erro');
            return;
        }

        // Revela pista
        hs.classList.add('encontrado');
        hs.textContent = '✓';
        pistasEncontradas.push(id);
        adicionarPistaNaLista(carta);
        contador.textContent = pistasEncontradas.length;

        abrirModal(carta);

        if (pistasEncontradas.length === 9) {
            btnVerificar.disabled = false;
            mostrarFeedback('✅ Todas as pistas coletadas! Hora de acusar.', 'ok');
        }
    });
});

/* ---------- Mostrar pista no painel ---------- */
function adicionarPistaNaLista(carta) {
    const li = document.createElement('li');
    li.innerHTML = `<strong>Pista #${carta.id} — ${carta.titulo}</strong>${carta.pista}`;
    lista.appendChild(li);
}

/* ---------- Modal ---------- */
function abrirModal(carta) {
    modalTitulo.textContent = `🔍 Pista ${carta.id}: ${carta.titulo}`;
    modalPista.textContent  = carta.pista;
    modal.classList.add('ativo');
}
function fecharModal() { modal.classList.remove('ativo'); }
window.fecharModal = fecharModal;

/* Fecha modal clicando fora */
modal.addEventListener('click', e => { if (e.target === modal) fecharModal(); });

/* ---------- Feedback ---------- */
function mostrarFeedback(msg, tipo) {
    feedback.textContent = msg;
    feedback.className = 'feedback ' + (tipo || '');
    setTimeout(() => { feedback.className = 'feedback'; }, 5000);
}

/* ---------- Acusar / Verificar ---------- */
btnVerificar.addEventListener('click', () => {
    // Verifica se coletou todas na ordem correta
    const ok = pistasEncontradas.length === 9 &&
               pistasEncontradas.every((v, i) => v === ordemEsperada[i]);

    if (ok) {
        // Salva progresso no servidor via fetch
        fetch('salvar_progresso.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ caso: CASO_NUM })
        }).then(() => {
            alert(`🎉 CASO ${CASO_NUM} RESOLVIDO!\n\n${CASO.solucao}`);
            window.location.href = 'casos.php';
        });
    } else {
        mostrarFeedback('❌ Ainda faltam pistas ou a ordem está errada.', 'erro');
    }
});

/* ---------- Reiniciar caso ---------- */
btnReiniciar.addEventListener('click', () => {
    if (!confirm('Reiniciar este caso? As pistas coletadas serão perdidas.')) return;
    pistasEncontradas = [];
    lista.innerHTML = '';
    contador.textContent = '0';
    btnVerificar.disabled = true;
    document.querySelectorAll('.hotspot').forEach(hs => {
        hs.classList.remove('encontrado');
        hs.textContent = '?';
    });
    mostrarFeedback('🔄 Caso reiniciado.', '');
});