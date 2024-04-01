<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once('config/PDO.php');

// Récupérer les catégories distinctes de la base de données
try {
    $stmt = $conn->prepare("SELECT DISTINCT categorie FROM annonces");
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    echo "Erreur de requête : " . $e->getMessage();
    exit();
}

if (isset($_GET['categorie'])) {
    $categorie = $_GET['categorie'];
    // Requête SQL pour récupérer les livres de la catégorie sélectionnée
    $stmt = $conn->prepare("SELECT * FROM annonces WHERE categorie = :categorie");
    $stmt->bindParam(':categorie', $categorie);
    $stmt->execute();
    $annonces = $stmt->fetchAll();
} else {
    // Requête SQL pour récupérer tous les livres
    $stmt = $conn->prepare("SELECT * FROM annonces");
    $stmt->execute();
    $annonces = $stmt->fetchAll();
}
?>

<aside class="col-span-1 mt-24 text-center border border-r-2 fixed top-0 h-screen w-72">
    <ul class="flex flex-col">
        <a href="index.php" class="my-3 inline-block">Tous les produits</a>
        <hr>
        <!-- Afficher les liens vers chaque catégorie -->
        <?php foreach ($categories as $categorie) : ?>
            <a href="index.php?categorie=<?= urlencode($categorie) ?>" class="my-3 inline-block"><?= $categorie ?></a>
            <hr>
        <?php endforeach; ?>
        <a href="create_annonce.php" class="my-3 mx-auto bg-emerald-400 px-6 py-2 w-5/6 rounded-full  text-white font-bold border-2 border-emerald-800 transform transition-transform duration-300 hover:bg-white hover:text-emerald-400 hover:scale-105 inline-block">Déposer
            une annonce</a>
    </ul>
</aside>