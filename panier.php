<?php
session_start();
include_once("config/PDO.php");

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

if (!empty($_GET['id_annonce'])) {
    $id_annonce = $_GET['id_annonce'];

    $stmt = $conn->prepare("SELECT * FROM annonces WHERE id_annonce = ?");
    $stmt->execute([$id_annonce]);

    if ($stmt->rowCount() == 1) {
        $annonce = $stmt->fetch();
        $article = [
            'id_annonce' => $id_annonce,
            'titre' => $annonce['titre'],
            'prix' => $annonce['prix']
        ];
        array_push($_SESSION['panier'], $article);
    } else {
        $error = "Cette annonce n'existe pas ou a été supprimée";
    }
}

$total = 0;
foreach ($_SESSION['panier'] as $article) {
    $total += $article['prix'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" href="dist/style.css">
</head>

<body>
    <header>
        <?php include('navbar.php'); ?>
    </header>
    <section id="panier" class="grid gap-20 grid-cols-4 mt-24">
        <div class="col-span-4">
            <h1 class="text-2xl font-bold">Panier</h1>
            <ul>
                <?php foreach ($_SESSION['panier'] as $key => $article) : ?>
                    <li><?= $article['titre'] ?> - <?= $article['prix'] ?>€ <a href="supprimer-article_panier.php?id=<?= $key ?>">Supprimer</a></li>
                <?php endforeach; ?>
            </ul>
            <p>Total: <?= $total ?>€</p>
        </div>
    </section>
</body>

</html>