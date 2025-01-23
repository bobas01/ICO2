<style>
    :root {
        --violet-principal: rgb(67, 37, 103);
        --violet-clair: rgb(97, 67, 133);
        --violet-tres-clair: rgb(127, 97, 163);
    }

    .btn-violet {
        background-color: var(--violet-principal) !important;
        color: white !important;
        border-color: var(--violet-principal) !important;
    }

    .btn-violet:hover {
        background-color: var(--violet-clair) !important;
    }

    .table-violet thead {
        background-color: var(--violet-principal) !important;
        color: white !important;
    }

    .badge-violet {
        background-color: var(--violet-tres-clair) !important;
        color: white !important;
    }

    .table-violet th,
    .table-violet td {
        vertical-align: middle !important;
        padding: 12px !important;
    }

    .cart-total-card {
        background-color: var(--violet-tres-clair) !important;
        color: white !important;
    }
</style>

<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-header btn-violet d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Mon Panier</h3>
            <span class="badge badge-violet"><?= count($cartProducts) ?> article(s)</span>
        </div>
        <div class="card-body">
            <?php if (empty($cartProducts)): ?>
                <div class="alert btn-violet text-center" role="alert">
                    Votre panier est vide
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle table-violet">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Prix unitaire</th>
                                <th>Quantité</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cartProducts as $product): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img
                                                src="<?= htmlspecialchars($product['image']) ?>"
                                                alt="<?= htmlspecialchars($product['name']) ?>"
                                                class="img-thumbnail me-3 rounded"
                                                style="width: 70px; height: 70px; object-fit: cover;">
                                            <span class="fw-bold"><?= htmlspecialchars($product['name']) ?></span>
                                        </div>
                                    </td>
                                    <td class="text-muted"><?= number_format($product['price'], 2, ',', ' ') ?> €</td>
                                    <td>
                                        <form method="post" action="" class="d-flex">
                                            <input type="hidden" name="action" value="update">
                                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                            <input
                                                type="number"
                                                name="quantity"
                                                value="<?= $product['quantity'] ?>"
                                                min="1"
                                                class="form-control form-control-sm w-auto text-center"
                                                onchange="this.form.submit()">
                                        </form>
                                    </td>
                                    <td class="fw-bold" style="color: var(--violet-principal)">
                                        <?= number_format($product['price'] * $product['quantity'], 2, ',', ' ') ?> €
                                    </td>
                                    <td>
                                        <form method="post" action="" class="d-inline">
                                            <input type="hidden" name="action" value="remove">
                                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-danger py-0 px-2">
                                                Suppr.
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="card mt-4 border-0 shadow-sm">
                    <div class="card-body cart-total-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Total de la commande</h4>
                            <h3 class="mb-0">
                                <?= number_format($cartTotal, 2, ',', ' ') ?> €
                            </h3>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-violet btn-lg w-100">
                                Passer la commande
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>