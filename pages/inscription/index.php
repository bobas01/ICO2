
    <div class="wrapper">
        <h1>Inscription</h1>
        
        <?php if (!empty($error)): ?>
            <div class="alert error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <?php if (!empty($success)): ?>
            <div class="alert success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <section class="login-container">
            <form action="" method="post">
                <input type="text" name="username" placeholder="Nom d'utilisateur" required>
                
                <label for="emailAddress">Email</label>
                <input id="emailAddress" type="email" name="email" placeholder="Votre email" required>
                
                <label for="phone">Numéro de téléphone</label>
                <input type="tel" id="phone" name="phone" placeholder="Votre numéro de téléphone" required>

                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="Votre mot de passe" required>
                
                <label for="confirm_password">Confirmer le mot de passe</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirmez votre mot de passe" required>
                
                <button type="submit">S'inscrire</button>
            </form>
        </section>
    </div>

