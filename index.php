<?php
session_start();

include_once('config/PDO.php');

try {
    $stmt = $conn->prepare(
        "SELECT id_annonce, cover, titre, auteur, description, editeur, categorie, pages, isbn, date, prix, id_user
        FROM annonces 
        ORDER BY date DESC"
    );

    $stmt->execute(); // Exécuter la requête SQL

    $annonces = $stmt->fetchAll(); // Récupérer les résultats
} catch (PDOException $e) {
    echo "Erreur de requête : " . $e->getMessage(); // Afficher le message d'erreur
    exit(); // Arrêter l'exécution du script en cas d'erreur
}

//FILTRE

$filtre = isset($_GET['filtre']) ? $_GET['filtre'] : '';

function comparePrixCroissant($a, $b)
{
    return $a['prix'] - $b['prix'];
}

function comparePrixDecroissant($a, $b)
{
    return $b['prix'] - $a['prix'];
}

function compareTitreAZ($a, $b)
{
    return strcmp($a['titre'], $b['titre']);
}

function compareTitreZA($a, $b)
{
    return strcmp($b['titre'], $a['titre']);
}

switch ($filtre) {
    case 'prixCroissant':
        usort($annonces, 'comparePrixCroissant');
        break;
    case 'prixDecroissant':
        usort($annonces, 'comparePrixDecroissant');
        break;
    case 'titreAZ':
        usort($annonces, 'compareTitreAZ');
        break;
    case 'titreZA':
        usort($annonces, 'compareTitreZA');
        break;
    default:
        break;
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
        <?php
        include('navbar.php')
        ?>
    </header>
    <section class="grid gap-20 grid-cols-4 mt-24">
        <?php
        include('aside.php');
        ?>
        <div class="col-span-4 mb-12 ml-80">
            <h1 class="my-6 text-4xl">Livres Disponibles</h1>
            <div class="text-end my-8 mx-6">
                <form action="" method="GET" class="text-end my-8 mx-6">
                    <label for="filtre">Trier par : </label>
                    <select name="filtre" id="filtre" class="border rounded-full" onchange="this.form.submit()">
                        <option value="" selected></option>
                        <option value="prixCroissant">Prix croissant</option>
                        <option value="prixDecroissant">Prix décroissant</option>
                        <option value="titreAZ">De A à Z</option>
                        <option value="titreZA">De Z à A</option>
                    </select>
                </form>

            </div>
            <div class="flex flex-wrap ">
                <?php foreach ($annonces as $annonce) : ?>
                    <a href="annonce_page.php?id_annonce=<?= $annonce['id_annonce'] ?>" class="w-1/4 px-3 mb-4">
                        <div class="cursor-pointer rounded-lg bg-white p-2 shadow duration-150 hover:scale-105 hover:shadow-md">
                            <img class="w-full rounded-lg object-cover object-center" style="height: 300px;" src="<?= $annonce['cover'] ?>" alt="product" />
                            <p class="mt-4 pl-4 font-bold text-center"><?= $annonce['titre'] ?></p>
                            <p class="mb-2 font-bold text-gray-500 text-center"><?= $annonce['auteur'] ?></p>
                            <p class="mb-4 ml-4 text-xl font-semibold text-gray-800"><?= $annonce['prix'] ?> €</p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>

        </div>
    </section>
    <hr class="mb-10 ml-80 border-1 rounded">
    <?php include("footer.php") ?>
</body>

</html>