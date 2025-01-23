<?php

namespace App\Controller;

class CartController extends Controller
{
    private array $products = [
        [
            "id" => 1,
            "name" => "Produit #1",
            "image" => "http://localhost/ICO/img/img_cartes/Carte-dos-bonus.png",
            "description" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit.",
            "price" => 2.85
        ],
        [
            "id" => 2,
            "name" => "Produit #2",
            "image" => "http://localhost/ICO/img/img_cartes/Carte-dos-action.png",
            "description" => "Consectetur adipisicing elit provident, quam?",
            "price" => 10.85
        ],
        [
            "id" => 3,
            "name" => "Produit #3",
            "image" => "http://localhost/ICO/img/img_cartes/Carte-dos-role.png",
            "description" => "Provident quam consectetur adipisicing elit.",
            "price" => 5.50
        ],
        [
            "id" => 4,
            "name" => "Produit #4",
            "image" => "http://localhost/ICO/img/img_cartes/Carte-dos-bonus.png",
            "description" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit.",
            "price" => 2.85
        ]
    ];

    public function index()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->initializeCart();

        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'remove':
                    $this->removeFromCart((int)$_POST['product_id']);
                    break;
                case 'update':
                    $this->updateCartQuantity((int)$_POST['product_id'], (int)$_POST['quantity']);
                    break;
            }
        }

        $cartProducts = $this->getCartProducts();
        $cartTotal = $this->calculateCartTotal($cartProducts);

        $data = [
            'products' => $this->products,
            'cartProducts' => $cartProducts,
            'cartTotal' => $cartTotal
        ];

        $content = $this->render('panier', $data, true);
        $this->renderLayout($content, 'Mon panier');
    }

    private function initializeCart()
    {
        // Si le panier est vide ou non défini, on l'initialise avec une quantité par défaut de 1 pour chaque produit
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
            foreach ($this->products as $product) {
                $_SESSION['cart'][$product['id']] = 1;
            }
        }
    }

    private function removeFromCart(int $productId)
    {
        unset($_SESSION['cart'][$productId]);
    }

    private function updateCartQuantity(int $productId, int $quantity)
    {
        if ($quantity <= 0) {
            $this->removeFromCart($productId);
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }
    }

    private function getCartProducts(): array
    {
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            return [];
        }

        $cartProducts = [];
        foreach ($_SESSION['cart'] as $productId => $quantity) {
            $product = $this->findProductById($productId);

            if ($product !== null) {
                $product['quantity'] = $quantity;
                $cartProducts[] = $product;
            }
        }

        return $cartProducts;
    }

    private function findProductById(int $productId)
    {
        foreach ($this->products as $product) {
            if ($product['id'] === $productId) {
                return $product;
            }
        }
        return null;
    }

    private function calculateCartTotal(array $cartProducts): float
    {
        return array_reduce($cartProducts, function ($total, $product) {
            return $total + (($product['price'] ?? 0) * ($product['quantity'] ?? 0));
        }, 0.0);
    }
}
