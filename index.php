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
    <!-- NAVBAR -->
    <header>
        <?php
        include('navbar.php')
        ?>
    </header>
    <!-- FIN NAVBAR  -->
    <!-- MAIN SECTION -->
    <section class="grid gap-20 grid-cols-4 mt-24">
        <!-- ASIDE  -->
        <?php
        include('aside.php');
        ?>
        <!-- MAIN PAGE -->
        <div class="col-span-4 mb-12 ml-80">
            <h1 class="my-6 text-4xl">Livres Disponibles</h1>
            <div class="text-end my-8 mx-6">
                <label for="filtre">Trier par : </label>
                <select name="filtre" id="filtre" class="border rounded-full">
                    <option value="" selected></option>
                    <option value="">Prix croissant</option>
                    <option value="">Prix décroissant</option>
                    <option value="">De A à Z</option>
                    <option value="">De Z à A</option>
                </select>
            </div>
            <div class="flex flex-wrap ">
                <?php foreach ($annonces as $annonce) : ?>
                    <a href="annonce_page.php?id_annonce=<?= $annonce['id_annonce'] ?>" class="w-1/4 px-3 mb-4">
                        <div class="cursor-pointer rounded-lg bg-white p-2 shadow duration-150 hover:scale-105 hover:shadow-md">
                            <img class="w-full rounded-lg object-cover object-center" style="height: 300px;" src="<?= $annonce['cover'] ?>" alt="product" />
                            <p class="mt-4 pl-4 font-bold text-center"><?= $annonce['titre'] ?></p>
                            <p class="mb-2 font-bold text-gray-500 text-center"><?= $annonce['auteur'] ?></p>
                            <p class="mb-4 ml-4 text-xl font-semibold text-gray-800"><?= $annonce['prix'] ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>

        </div>
    </section>
    <!-- FOOTER  -->
    <footer class="ml-80 mr-6">
        <hr class="mb-10 border-1 rounded">
        <div class="my-2 mx-auto p-4">
            <div class="mb-4">
                <a href="#" class=" flex items-center">
                    <img src="./images/notebook.png" alt="logo site" class="h-8 me-3 w-10">
                    <span class="self-center text-2xl">LivreD'occaz</span>
                </a>
            </div>
            <div class="grid grid-cols-3 gap-8">
                <div class="">
                    <h2 class="mb-6 text-lg font-semibold text-gray-900 uppercase ">RESSOURCES</h2>
                    <ul class="text-gray-500">
                        <li class="mb-4">
                            <a href="#" class="text-base hover:underline">Link 1</a>
                        </li>
                        <li>
                            <a href="#" class="text-base hover:underline">Link 2</a>
                        </li>
                    </ul>
                </div>
                <div class="">
                    <h2 class="mb-6 text-lg font-semibold text-gray-900 uppercase ">FOLLOW US</h2>
                    <ul class="text-gray-500">
                        <li class="mb-4">
                            <a href="#" class="text-base hover:underline">Link 1</a>
                        </li>
                        <li>
                            <a href="#" class="text-base hover:underline">Link 2</a>
                        </li>
                    </ul>
                </div>
                <div class="">
                    <h2 class="mb-6 text-lg font-semibold text-gray-900 uppercase ">LEGAL</h2>
                    <ul class="text-gray-500">
                        <li class="mb-4">
                            <a href="#" class="text-base hover:underline">Link 1</a>
                        </li>
                        <li>
                            <a href="#" class="text-base hover:underline">Link 2</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>