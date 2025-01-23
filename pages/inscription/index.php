
    <div class="wrapper">
        <h1>Inscription</h1>
        
        <?php if (!empty($error)): ?>
            <div class="alert error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <?php if (!empty($success)): ?>
            <div class="alert success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <section class="login-container">
            <form action="/ICO/inscription" method="post">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" name="username" id="username" required>
                
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
                
                <label for="phone">Numéro de téléphone</label>
                <input type="tel" name="phone" id="phone" required>

                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
                
                <label for="confirm_password">Confirmer le mot de passe</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
                
                <button type="submit">S'inscrire</button>
            </form>
        </section>
    </div>

