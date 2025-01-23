<?php
// Assurez-vous que le contrôleur a été appelé et que $cards est défini
// Exemple : $cards = $cardController->getAllCards(); (si vous utilisez un contrôleur)

if (!isset($cards)) {
    $cards = []; // Initialiser $cards comme un tableau vide si non défini
}
?>

<head>
    <link rel="stylesheet" href="/ICO/css/custom-backoffice.css">
</head>
<div class="container">
    <div class="sidebar">
        <div class="sidebar-title">Back Office</div>
        <nav>
            <div class="nav-group">
                <div class="nav-group-title">Cartes</div>
                <a class="nav-link active" data-tab="cartes-bonus">Cartes Bonus</a>
                <a class="nav-link" data-tab="cartes-roles">Cartes Rôles</a>
                <a class="nav-link" data-tab="cartes-action">Cartes Action</a>
            </div>

            <div class="nav-group">
                <div class="nav-group-title">Gestion</div>
                <a class="nav-link" data-tab="distribution-cartes">Distribution des Cartes</a>
                <a class="nav-link" data-tab="materiel">Matériel</a>
            </div>

            <div class="nav-group">
                <div class="nav-group-title">Communication</div>
                <a class="nav-link" data-tab="evenements">Événements</a>
                <a class="nav-link" data-tab="jeux-extensions">Jeux et Extensions</a>
                <a class="nav-link" data-tab="articles">Articles</a>
            </div>
        </nav>
    </div>

    <div class="main-content">
        <!-- Cartes Bonus -->
        <div id="cartes-bonus" class="tab-content active">
            <div class="content-header">
                <h2>Cartes Bonus</h2>
                <button class="btn-create" data-modal="bonus-modal">+ Créer Carte Bonus</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="bonus-list">
                    <?php foreach ($cards as $card): ?>
                        <tr>
                            <td><?php echo isset($card['Id']) ? htmlspecialchars($card['Id']) : 'N/A'; ?></td>
                            <td><?php echo isset($card['title']) ? htmlspecialchars($card['title']) : 'N/A'; ?></td>
                            <td><?php echo isset($card['rules']) ? htmlspecialchars($card['rules']) : 'N/A'; ?></td>
                            <td>
                                <?php if (isset($card['image'])): ?>
                                    <img src="<?php echo htmlspecialchars($card['image']); ?>" alt="Image de la carte" style="width: 100px;">
                                <?php else: ?>
                                    <span>Aucune image</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <button class="btn-update" onclick="openUpdateModal(<?php echo htmlspecialchars($card['Id']); ?>, '<?php echo htmlspecialchars($card['title']); ?>', '<?php echo htmlspecialchars($card['rules']); ?>')">
                                    <i class="fas fa-edit"></i> <!-- Icône de mise à jour -->
                                </button>
                                <button class="btn-delete" onclick="confirmDelete(<?php echo htmlspecialchars($card['Id']); ?>)">
                                    <i class="fas fa-trash-alt"></i> <!-- Icône de suppression -->
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Cartes Action -->
        <div id="cartes-action" class="tab-content">
            <div class="content-header">
                <h2>Cartes Action</h2>
                <button class="btn-create" data-modal="action-modal">+ Créer Carte Action</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="action-list">
                    <!-- Liste des cartes action -->
                </tbody>
            </table>
        </div>

        <!-- Distribution des Cartes -->
        <div id="distribution-cartes" class="tab-content">
            <div class="content-header">
                <h2>Distribution des Cartes</h2>
                <button class="btn-create" data-modal="distribution-modal">+ Créer Distribution</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de joueurs</th>
                        <th>Pirates</th>
                        <th>Marins</th>
                        <th>Sirene</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="distribution-list">
                    <!-- Liste des distributions de cartes -->
                </tbody>
            </table>
        </div>

        <!-- Matériel -->
        <div id="materiel" class="tab-content">
            <div class="content-header">
                <h2>Matériel</h2>
                <button class="btn-create" data-modal="materiel-modal">+ Ajouter Matériel</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Quantité</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="materiel-list">
                    <!-- Liste du matériel -->
                </tbody>
            </table>
        </div>

        <!-- Événements -->
        <div id="evenements" class="tab-content">
            <div class="content-header">
                <h2>Événements</h2>
                <button class="btn-create" data-modal="evenement-modal">+ Créer Événement</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Crée le</th>
                        <th>Finis le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="evenement-list">
                    <!-- Liste des événements -->
                </tbody>
            </table>
        </div>

        <!-- Jeux et Extensions -->
        <div id="jeux-extensions" class="tab-content">
            <div class="content-header">
                <h2>Jeux et Extensions</h2>
                <button class="btn-create" data-modal="jeu-modal">+ Ajouter Jeu/Extension</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Prix</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="jeu-list">
                    <!-- Liste des jeux et extensions -->
                </tbody>
            </table>
        </div>

        <!-- Articles -->
        <div id="articles" class="tab-content">
            <div class="content-header">
                <h2>Articles</h2>
                <button class="btn-create" data-modal="article-modal">+ Créer Article</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Date de Publication</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="article-list">
                    <!-- Liste des articles -->
                </tbody>
            </table>
        </div>

        <!-- Modales pour chaque section -->
        <!-- Distribution des Cartes Modal -->
        <div id="distribution-modal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Créer/Modifier Distribution</h3>
                    <span class="modal-close">&times;</span>
                </div>
                <form id="distribution-form" class="modal-form">
                    <input type="hidden" id="distribution-id">

                    <div class="form-group">
                        <label for="distribution-name">Nom de la Distribution</label>
                        <input type="text" id="distribution-name" required>
                    </div>

                    <div class="form-group">
                        <label for="distribution-date">Date</label>
                        <input type="date" id="distribution-date" required>
                    </div>

                    <div class="form-group">
                        <label for="distribution-cards">Nombre de Cartes</label>
                        <input type="number" id="distribution-cards" required>
                    </div>

                    <div class="modal-actions">
                        <button type="button" class="btn-cancel">Annuler</button>
                        <button type="submit" class="btn-save">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modales similaires pour chaque section -->
        <div id="action-modal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Créer/Modifier Carte Action</h3>
                    <span class="modal-close">&times;</span>
                </div>
                <form id="action-form" class="modal-form">
                    <input type="hidden" id="action-id">

                    <div class="form-group">
                        <label for="action-name">Nom</label>
                        <input type="text" id="action-name" required>
                    </div>

                    <div class="form-group">
                        <label for="action-description">Description</label>
                        <textarea id="action-description"></textarea>
                    </div>

                    <div class="modal-actions">
                        <button type="button" class="btn-cancel">Annuler</button>
                        <button type="submit" class="btn-save">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Autres modales à ajouter de manière similaire -->

        <div id="cartes-roles" class="tab-content">
            <div class="content-header">
                <h2>Cartes Rôles</h2>
                <button class="btn-create" data-modal="roles-modal">+ Créer Carte Rôle</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="roles-list">
                    <!-- Liste des cartes rôles -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modales -->
<div id="bonus-modal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Créer Carte Bonus</h3>
            <span class="modal-close">&times;</span>
        </div>
        <form action="/ICO/cards/create" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="bonus">
            
            <label for="title">Nom de la carte:</label>
            <input type="text" id="title" name="title" required>

            <label for="rules">Règles:</label>
            <textarea id="rules" name="rules" required></textarea>

            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>

            <button type="submit">Créer la carte</button>
        </form>
    </div>
</div>

<div id="post-modal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Créer/Modifier Post</h3>
            <span class="modal-close">&times;</span>
        </div>
        <form id="post-form" class="modal-form" enctype="multipart/form-data">
            <input type="hidden" id="post-id">

            <div class="form-group">
                <label for="post-title">Titre</label>
                <input type="text" id="post-title" required>
            </div>

            <div class="form-group">
                <label for="post-description">Description</label>
                <textarea id="post-description"></textarea>
            </div>

            <div class="form-group">
                <label for="post-image">Image</label>
                <input type="file" id="post-image" name="image" accept="image/*">
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-cancel">Annuler</button>
                <button type="submit" class="btn-save">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<!-- Modale de mise à jour -->
<div id="update-modal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Mettre à jour la carte</h3>
            <span class="modal-close" onclick="closeUpdateModal()">&times;</span>
        </div>
        <form id="update-form" action="/ICO/cards/update/<?php echo htmlspecialchars($card['Id']); ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="update-card-id" name="id">
            <label for="update-title">Nom de la carte:</label>
            <input type="text" id="update-title" name="title" required>

            <label for="update-rules">Règles:</label>
            <textarea id="update-rules" name="rules" required></textarea>

            <label for="update-image">Image:</label>
            <input type="file" id="update-image" name="image" accept="image/*">

            <input type="hidden" name="type" value="bonus"> <!-- Ajustez selon vos besoins -->

            <button type="submit">Mettre à jour la carte</button>
        </form>
    </div>
</div>

<script src="js/backoffice.js"></script>
</body>

</html>

<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-success">
        <?php echo $_SESSION['message']; ?>
        <?php unset($_SESSION['message']); // Supprimer le message après l'affichage 
        ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?php echo $_SESSION['error']; ?>
        <?php unset($_SESSION['error']); // Supprimer le message après l'affichage 
        ?>
    </div>
<?php endif; ?>