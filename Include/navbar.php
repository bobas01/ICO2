<nav>
    <div class="container">
        <div class="logo-container">
            <img src="img/logo/logo.png" alt="Logo" class="logo">
        </div>
        <ul>
            <li>
                <a href="/ICO/">
                    <img src="./img/home.png" alt="" class="nav-icon">
                    Accueil
                </a>
            </li>
            <li>
                <a href="/ICO/regles_du_jeu">
                    <img src="./img/regle.png" alt="" class="nav-icon">
                    Règles des jeux
                </a>
            </li>
            <li>
                <a href="/ICO/contact">
                    <img src="./img/contact.png" alt="" class="nav-icon">
                    Contact
                </a>
            </li>
        </ul>
      
        <div class="icons">
            <a href="index.php">
                <img src="./img/tresor.png" alt="" class="icon">
            </a>
            <div class="dropdown">
                <img src="./img/perroquet.png" alt="" class="icon dropbtn">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <span class="notification-dot"></span>
                <?php endif; ?>
                <div class="dropdown-content">
                    <?php
                    var_dump($_SESSION);
                    if (isset($_SESSION['user_id'])) {
                        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                            echo '<a href="/ICO/backoffice">Back Office</a>';
                        }
                        echo '<a href="profil.php">Mon Profil</a>';
                        echo '<a href="logout.php">Déconnexion</a>';
                    } else {
                        echo '<a href="/ICO/inscription">Inscription</a>';
echo '<a href="/ICO/login">Connexion</a>';

                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</nav>

