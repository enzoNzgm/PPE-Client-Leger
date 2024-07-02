<?php
session_start();
include_once("config/PDO.php");

// Si l'ID de l'annonce est présent dans l'URL et existe dans la base de données
if (!empty($_GET['id_annonce'])) {
    $id_annonce = $_GET['id_annonce'];

    // requête pour récupérer les informations de l'annonce
    $stmt = $conn->prepare("SELECT * FROM annonces a
    INNER JOIN users u ON u.id_user = a.id_user
    WHERE id_annonce = ?");

    $stmt->execute([$id_annonce]); // exécution de la requête

    // Si l'annonce existe
    if ($stmt->rowCount() == 1) {
        $data = $stmt->fetch();

        // Récupération des données de l'annonce
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

//Ajout d'un commentaire
if (isset($_POST['commentaire'])) {
    $commentaire = $_POST['commentaire'];
    $id_annonce = $_GET['id_annonce'];
    $id_user = $_SESSION['user_id-logged'];
    $stmt = $conn->prepare("INSERT INTO commentaires (id_annonce, id_user, commentaire) VALUES (?, ?, ?)");
    $stmt->execute([$id_annonce, $id_user, $commentaire]);
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
                // si l'annonce a une couverture on l'affiche sinon on affiche une image par défaut
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

        <!-- Affichage des commentaires -->
        <section class="col-span-4 mx-80 mt-24">
            <h2 class="text-2xl font-bold">Commentaires</h2>
            <hr>
            <?php
            // requête pour récupérer les commentaires de l'annonce
            $stmt = $conn->prepare("SELECT * FROM commentaires c
                INNER JOIN users u ON u.id_user = c.id_user
                WHERE id_annonce = ?");

            $stmt->execute([$id_annonce]); // exécution de la requête

            // Si l'annonce a des commentaires
            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetchAll();

                // Pour chaque commentaire, on affiche le nom de l'utilisateur et le commentaire
                foreach ($data as $commentaire) {
                    echo '
                            <p>' . $commentaire['commentaire'] . '</p>
                        </div>
                    </div>
                    <hr>';
                }
            } else {
                echo '<p>Aucun commentaire pour le moment</p>';
            }
            ?>
            <!-- Formulaire pour ajouter un commentaire -->
            <?php
            if (isset($_SESSION['email-logged'])) : ?>
                <form action="" method="post" class="mt-6">
                    <input type="hidden" name="id_annonce" value="<?= $id_annonce ?>">
                    <textarea name="commentaire" id="commentaire" cols="30" rows="10" class="w-full p-2 border-2 border-slate-200 rounded" placeholder="Ajouter un commentaire"></textarea>
                    <button type="submit" class="bg-emerald-400 px-3 py-2 rounded-full text-white font-bold border-2 border-emerald-800 hover:bg-emerald-500 transition-colors duration-300 mt-2">Ajouter</button>
                <?php endif ?>
        </section>

</body>

</html>