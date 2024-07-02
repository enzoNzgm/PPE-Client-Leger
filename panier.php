<?php
session_start();
include_once("config/PDO.php");
$total = 0; // Initialisation du prix total

// Si le panier n'existe pas, on le crée vide
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// vérifie si le paramètre "id_annonce" est présent dans la requête GET
if (!empty($_GET['id_annonce'])) {
    $id_annonce = $_GET['id_annonce'];

    $stmt = $conn->prepare("SELECT * FROM annonces WHERE id_annonce = ?");
    $stmt->execute([$id_annonce]);

    // vérifie si le résultat de la requête est égal à 1, si oui cela signifie que l'annonce existe
    if ($stmt->rowCount() == 1) {
        // récupère les données de l'annonce
        $annonce = $stmt->fetch();
        $article = [
            'id_annonce' => $id_annonce,
            'cover' => $annonce['cover'],
            'titre' => $annonce['titre'],
            'prix' => $annonce['prix']
        ];
        // Ajout de l'article dans la session panier
        array_push($_SESSION['panier'], $article);
    } else {
        $error = "Cette annonce n'existe pas ou a été supprimée";
    }
}

if (isset($_POST['codePromo'])) {
    $codePromo = $_POST['codePromo'];

    $stmt = $conn->prepare("SELECT * FROM promo WHERE code_promo = ?");
    $stmt->execute([$codePromo]);

    if ($stmt->rowCount() > 0) {
        $promo = $stmt->fetch();
        $promoValue = $promo['valeur'];

        $total = $total - $promoValue;
    } else {
        $error = "Code promo invalide";
    }
}

// Calcul du prix total
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
        <div class="col-span-4 mx-auto">
            <h1 class="text-2xl text-center my-6 font-bold ">Votre panier</h1>
            <hr>
            <ul>
                <!-- Pour chaque annonces dans la variable de session panier, on affiche l'image, le titre et le prix de l'annonce -->
                <?php foreach ($_SESSION['panier'] as $key => $article) : ?>
                    <div class="flex items-center space-x-4 py-2">
                        <img src="<?= htmlspecialchars($article['cover']) ?>" alt="Image de l'annonce" class="w-20 h-20 object-cover rounded">
                        <li class="flex-grow">
                            <?= htmlspecialchars($article['titre']) ?> - <?= htmlspecialchars($article['prix']) ?>€
                            <!-- fait appel a fonction supprimer-article_panier.php pour supprimer un article du panier -->
                            <a href="supprimer-article_panier.php?id=<?= $key ?>" class="text-red-500 hover:text-red-700 ml-4 inline-block"><img src="images/supprimer.png" alt=""></a>
                        </li>
                    </div>
                    <hr>
                <?php endforeach; ?>
            </ul>
            <p>Total: <?= $total ?>€</p>
        </div>
        <div class="w-full flex justify-center py-6">
            <a href="index.php" class="bg-emerald-400 py-2 px-6 rounded-full text-white text-center font-bold border-2 border-emerald-800 hover:bg-emerald-500 transition-colors duration-300">Continuer achat</a>
        </div>
        <form action="" method="post">
            <input type="text" name="codePromo" id="codePromo" placeholder="Code promotion..." class="rounded-full border-2 border-emerald-400">
            <input type="submit" value="Appliquer" class="bg-emerald-400 px-6 py-2 rounded-full text-white font-bold border-2 border-emerald-800">
        </form>
        <?php if (isset($error)) : ?>
            <p class="text-red-500"><?= $error ?></p>
        <?php endif; ?>
    </section>
</body>

</html>