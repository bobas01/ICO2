<?php

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>ICO</title>
    <link rel="stylesheet" href="/ICO/css/style.css">
    <!-- <link rel="stylesheet" href="/ICO/css/custom-backoffice.css"> -->
</head>

<body>

    <?php include('Include/navbar.php'); ?>

    <?php if ($currentPage === 'home'): ?>

        <section class="heroTop"></section>

    <?php endif; ?>

    <?php
    if ($currentPage === 'rules'):
        include('Include/rules-nav.php');
    endif;
    ?>


    <div class="content-container"><?= $content ?? '' ?></div>

    <?php include('Include/footer.php'); ?>
    <script src="/ICO/js/script.js"></script>
    <script src="/ICO/js/hamburger.js"></script>
</body>

</html>