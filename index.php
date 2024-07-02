<?php
session_start();
include_once('config/PDO.php');

// Si le paramètre filtre est présent dans la requete GET, on l'assigne à la variable $filtre, sinon on assigne une chaine vide
if (isset($_GET['filtre'])) {
    $filtre = $_GET['filtre'];
} else {
    $filtre = "";
}

// Si le paramètre search est présent dans la requete GET, on l'assigne à la variable $search
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

// Requête SQL qui récupère les annonces en fonction du filtre et de la recherche, si il n'y a pas de search toute les annonces sont récupérées
$req =
    "SELECT id_annonce, cover, titre, auteur, description, editeur, categorie, pages, isbn, date, prix, id_user
    FROM annonces
    WHERE titre LIKE :search";

// Si le filtre est présent dans la requete GET, on ajoute un ORDER BY  a la requete en fonction du filtre
if ($filtre == "titreZA") {
    $req .= " ORDER BY titre DESC";
} else if ($filtre == "prixCroissant") {
    $req .= " ORDER BY prix";
} else if ($filtre == "prixDecroissant") {
    $req .= " ORDER BY prix DESC";
} else {
    $req .= " ORDER BY titre";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre D'occaz</title>
    <link rel="stylesheet" href="dist/style.css">
</head>

<body>
    <header>
        <?php include('navbar.php'); ?>
    </header>
    <section class="grid gap-20 grid-cols-4 mt-24">
        <?php include('aside.php'); ?>
        <div class="col-span-4 mb-12 ml-80">
            <h1 class="my-6 text-4xl">Livres Disponibles</h1>
            <div class="text-end my-8 mx-6">
                <form action="index.php" method="GET" class="text-end my-8 mx-6">
                    <label for="filtre">Trier par : </label>
                    <select name="filtre" id="filtre" class="border rounded-full" onchange="this.form.submit()">
                        <option value="">Par défault</option>
                        <option value="prixCroissant" <?= $filtre == 'prixCroissant' ? 'selected' : '' ?>>Prix croissant</option>
                        <option value="prixDecroissant" <?= $filtre == 'prixDecroissant' ? 'selected' : '' ?>>Prix décroissant</option>
                        <option value="titreAZ" <?= $filtre == 'titreAZ' ? 'selected' : '' ?>>De A à Z</option>
                        <option value="titreZA" <?= $filtre == 'titreZA' ? 'selected' : '' ?>>De Z à A</option>
                    </select>
                </form>
            </div>
            <div class="flex flex-wrap">
                <?php
                //REQUETE QUI GERE LES FILTRES ET LES RECHERCHES
                $stmt = $conn->prepare($req);
                if (isset($search))
                    $searchPattern = "%$search%";
                else $searchPattern = "%%";
                $stmt->bindParam(':search', $searchPattern);
                $stmt->execute();
                $annonces = $stmt->fetchAll();

                //AFFICHAGE DES ANNONCES
                foreach ($annonces as $annonce) : ?>
                    <a href="annonce_page.php?id_annonce=<?= $annonce['id_annonce'] ?>" class="w-1/4 px-3 mb-4">
                        <div class="cursor-pointer rounded-lg bg-white p-2 shadow duration-150 hover:scale-105 hover:shadow-md">
                            <img class="w-full rounded-lg object-cover object-center" style="height: 300px;" src="<?= $annonce['cover'] ?>" alt="couverture" />
                            <p class="mt-4 pl-4 font-bold text-center"><?= htmlspecialchars($annonce['titre']) ?></p>
                            <p class="mb-2 font-bold text-gray-500 text-center"><?= htmlspecialchars($annonce['auteur']) ?></p>
                            <p class="mb-4 ml-4 text-xl font-semibold text-gray-800"><?= htmlspecialchars($annonce['prix']) ?> €</p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <hr class="mb-10 ml-80 border-1 rounded">
    <?php
    include("footer.php") ?>
</body>

</html>