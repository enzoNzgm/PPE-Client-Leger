<?php
session_start();
include_once("config/PDO.php");

if (!empty($_GET['id_annonce'])) {
    $id_annonce = $_GET['id_annonce'];

    $stmt = $conn->prepare("SELECT * FROM annonces a
    INNER JOIN users u ON u.id_user = a.id_user
    WHERE id_annonce = ?");

    $stmt->execute([$id_annonce]);

    if ($stmt->rowCount() == 1) {
        $data = $stmt->fetch();

        $cover = $data['cover'];
        $titre = $data['titre'];
        $auteur = $data['auteur'];
        $description = $data['description'];
        $editeur = $data['editeur'];
        $categorie = $data['categorie'];
        $pages = $data['pages'];
        $isbn = $data['isbn'];
        $date = $data['date'];
        $prix = $data['prix'];
    } else {
        $error = "Cette annonce n'existe pas ou a été supprimée";
    }
} else {
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="dist/style.css">
</head>

<body>
    <header>
        <?php
        include('navbar.php')
        ?>
    </header>
    <section id="annonce" class="grid gap-20 grid-cols-4 mt-24">
        <?php
        include('aside.php');
        ?>
        <section class="flex justify-center col-span-4 mx-80 mt-24">
            <div class=" mr-4">
                <?php
                if (!empty($cover)) {
                    echo '<img class="shadow " src="' . $cover . '" style="width: 500px;" alt="product" />';
                } else {
                    echo '<img src="images/test.jpg" alt="couverture du livre" class="shadow w-96">';
                }
                ?>
            </div>
            <div>
                <h1 class="text-2xl font-bold"><?= $titre ?></h1>
                <h2 class="text-lg text-emerald-400 mb-2"><?= $auteur ?></h2>
                <h2 class="font-semibold text-xl">Résumé</h2>
                <p class=" mb-4"><?= $description ?></p>
                <h2 class="font-semibold text-xl mb-2">Caractéristiques</h2>
                <div class="flex">
                    <table class="mr-1 ">
                        <tbody>
                            <tr class="bg-slate-200">
                                <td class="pr-32">Edition</td>
                                <td class="mr-32"><?= $editeur ?></td>
                            </tr>
                            <tr>
                                <td class="pr-32">Auteur</td>
                                <td class="mr-32"><?= $auteur ?></td>
                            </tr>
                            <tr class="bg-slate-200">
                                <td class="pr-32">Pages</td>
                                <td class="mr-32"><?= $pages ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <tbody>
                            <tr class="bg-slate-200">
                                <td class="pr-32">ISBN</td>
                                <td class="mr-32"><?= $isbn ?></td>
                            </tr>
                            <tr>
                                <td clas="pr-32">Date</td>
                                <td class="mr-32"><?= $date ?></td>
                            </tr>
                            <tr class="bg-slate-200">
                                <td class="pr-32">Dimension</td>
                                <td class="mr-32">20x32</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a href="panier.php?id_annonce=<?= $id_annonce ?>" class="cursor-pointer my-6 bg-emerald-400 px-3 py-2  rounded-full  text-white font-bold border-2 border-emerald-800 transform transition-transform duration-300 hover:bg-white hover:text-emerald-400 hover:scale-105 inline-block">Ajouter au panier (<?= $prix ?>€)</a>
            </div>
        </section>
    </section>
</body>

</html>