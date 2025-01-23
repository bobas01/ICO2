document.addEventListener('DOMContentLoaded', () => {
    // Gestion des onglets
    const navLinks = document.querySelectorAll('.nav-link');
    const tabContents = document.querySelectorAll('.tab-content');

    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            // Désactiver tous les onglets
            navLinks.forEach(l => l.classList.remove('active'));
            tabContents.forEach(tab => tab.classList.remove('active'));
            
            // Activer l'onglet cliqué
            this.classList.add('active');
            document.getElementById(this.dataset.tab).classList.add('active');
        });
    });

    // Gestion des modales
    const createButtons = document.querySelectorAll('.btn-create');
    const modals = document.querySelectorAll('.modal');
    const closeButtons = document.querySelectorAll('.close');

    createButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const modalId = btn.dataset.modal;
            document.getElementById(modalId).style.display = 'block';
        });
    });

    closeButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            btn.closest('.modal').style.display = 'none';
        });
    });

    // Fermer la modale en cliquant en dehors
    window.addEventListener('click', (event) => {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = 'none';
        }
    });

    // Gestion du formulaire de création/modification
    const bonusForm = document.getElementById('bonus-form');
    bonusForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const formData = new FormData(bonusForm);

        fetch(bonusForm.action, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            console.log('Response:', response); // Log de la réponse brute
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text(); // Récupérer la réponse en tant que texte
        })
        .then(text => {
            if (!text) {
                throw new Error('Empty response');
            }
            const data = JSON.parse(text); // Convertir le texte en JSON
            const messageDiv = document.getElementById('modal-message');
            messageDiv.style.display = 'block';
            messageDiv.textContent = data.message;

            if (data.success) {
                // Afficher un toast de succès
                setTimeout(() => {
                    messageDiv.style.display = 'none';
                    bonusForm.reset(); // Réinitialiser le formulaire
                    document.getElementById('bonus-modal').style.display = 'none'; // Fermer la modale
                }, 2000);
            } else {
                // Afficher le message d'erreur dans la modale
                setTimeout(() => {
                    messageDiv.style.display = 'none';
                }, 5000); // Masquer le message après 5 secondes
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
        });
    });

    // Fonction pour charger les données (à implémenter avec votre backend)
    


    // Charger les données de la première section par défaut
    
});

function openUpdateModal(cardId, title, rules) {
    document.getElementById('update-title').value = title;
    document.getElementById('update-rules').value = rules;
    document.getElementById('update-modal').style.display = 'block'; // Ouvrir la modale
}

function closeUpdateModal() {
    document.getElementById('update-modal').style.display = 'none'; // Fermer la modale
}
