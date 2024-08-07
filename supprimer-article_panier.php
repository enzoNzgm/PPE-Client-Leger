<?php
session_start();

// Vérification que la session panier existe sinon on la crée
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Vérification de l'ID de l'article à supprimer
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Suppression de l'article du panier
    unset($_SESSION['panier'][$id]);
}

// Redirection vers la page du panier
header('Location: panier.php');
exit();
