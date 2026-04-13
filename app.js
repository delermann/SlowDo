// AJOUTER UNE TÂCHE
async function addTask() {
    const title = prompt("Quelle est ta prochaine étape douce ?");
    if (!title) return;

    // Petite sélection d'ambiances prédéfinies
    const ambiances = [
        { emoji: '🍵', color: '#94a3b8' }, // Gris bleu (Calme)
        { emoji: '🌸', color: '#fbcfe8' }, // Rose (Douceur)
        { emoji: '🌳', color: '#86efac' }, // Vert (Nature)
        { emoji: '☀️', color: '#fef08a' }  // Jaune (Énergie)
    ];
    
    // On en choisit une au hasard pour le côté "surprise chill"
    const randomAmbiance = ambiances[Math.floor(Math.random() * ambiances.length)];

    const response = await fetch('api.php?action=add', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ 
            title: title,
            emoji: randomAmbiance.emoji,
            color: randomAmbiance.color
        })
    });

    const result = await response.json();
    if (result.status === 'success') {
        window.location.reload(); 
    }
}

// TERMINER UNE TÂCHE (AVEC ANIMATION)
async function completeTask(id) {
    const element = document.getElementById('task-' + id);
    
    // Animation de sortie
    element.classList.add('task-out');
    
    // Attente du délai CSS
    setTimeout(async () => {
        try {
            const response = await fetch('api.php?action=delete', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: id })
            });

            const result = await response.json();
            if (result.status === 'success') {
                element.remove();
            }
        } catch (error) {
            element.classList.remove('task-out');
            console.error("Erreur de suppression");
        }
    }, 500);
}