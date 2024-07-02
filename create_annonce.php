<?php
session_start();
include_once('config/PDO.php');

// Si l'utilisateur n'est pas connecté, le rediriger vers la page de connexion
if (!isset($_SESSION['email-logged'])) {
    header('location: login.php');
}

//si la méthode de requête est POST alors : 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //récupérer les données du formulaire
    $isbn = htmlspecialchars($_POST['isbn']);
    $prix = htmlspecialchars($_POST['prix']);
    $id_user = $_SESSION['user_id-logged'];

    //si les champs ne sont pas vides alors :
    if (empty($isbn) || empty($prix)) {
        echo "Veuillez remplir tous les champs.";
    } else {
        //fonction pour récupérer les informations du livre grace à l'API Google Books
        function getBookInfo($isbn)
        {
            $apiUrl = 'https://www.googleapis.com/books/v1/volumes?q=isbn:' . $isbn;
            $response = file_get_contents($apiUrl);
            $data = json_decode($response, true);

            if (isset($data['items'][0]['volumeInfo'])) {
                $bookInfo['title'] = isset($data['items'][0]['volumeInfo']['title']) ? $data['items'][0]['volumeInfo']['title'] : 'Titre non disponible';
                $bookInfo['author'] = isset($data['items'][0]['volumeInfo']['authors']) ? implode(", ", $data['items'][0]['volumeInfo']['authors']) : 'Auteur non disponible';
                $bookInfo['publisher'] = isset($data['items'][0]['volumeInfo']['publisher']) ? $data['items'][0]['volumeInfo']['publisher'] : 'Éditeur non disponible';
                $bookInfo['category'] = isset($data['items'][0]['volumeInfo']['categories']) ? $data['items'][0]['volumeInfo']['categories'][0] : 'Catégorie non disponible';
                $bookInfo['pageCount'] = isset($data['items'][0]['volumeInfo']['pageCount']) ? $data['items'][0]['volumeInfo']['pageCount'] : 'Nombre de pages non disponible';
                $bookInfo['publishedDate'] = isset($data['items'][0]['volumeInfo']['publishedDate']) ? $data['items'][0]['volumeInfo']['publishedDate'] : 'Date de publication non disponible';
                $bookInfo['coverUrl'] = isset($data['items'][0]['volumeInfo']['imageLinks']['smallThumbnail']) ? $data['items'][0]['volumeInfo']['imageLinks']['smallThumbnail'] : null;
                $bookInfo['description'] = isset($data['items'][0]['volumeInfo']['description']) ? $data['items'][0]['volumeInfo']['description'] : 'Aucune description disponible';
                return $bookInfo;
            } else {
                return null;
            }

            // fonction utilisée pour récupérer le contenu de l'API Google Books
            $response = file_get_contents($apiUrl);

            // si la réponse est fausse alors :
            if ($response === false) {
                $error = "Erreur lors de la requête vers l'API Google Books.";
            } else {
                //décoder la réponse en JSON
                $data = json_decode($response, true);

                if (isset($data['items'][0]['volumeInfo'])) {
                } else {
                    $error = "Aucune information disponible pour cet ISBN.";
                }
            }
        }

        $bookInfo = getBookInfo($isbn);

        if ($bookInfo) {
            // Requête SQL avec des paramètres nommés
            $req = "INSERT INTO `annonces` (`cover`, `titre`, `auteur`, `description`, `editeur`, `categorie`, `pages`, `isbn`, `date`,  `prix`, `id_user`) 
                    VALUES (:cover, :titre, :auteur, :description, :editeur, :categorie, :pages, :isbn, :date, :prix, :id_user)";

            // Préparation de la requête
            $stmt = $conn->prepare($req);

            // Remplacement des paramètres par les valeurs
            $stmt->bindParam(':cover', $bookInfo['coverUrl']);
            $stmt->bindParam(':titre', $bookInfo['title']);
            $stmt->bindParam(':auteur', $bookInfo['author']);
            $stmt->bindParam(':description', $bookInfo['description']);
            $stmt->bindParam(':editeur', $bookInfo['publisher']);
            $stmt->bindParam(':categorie', $bookInfo['category']);
            $stmt->bindParam(':pages', $bookInfo['pageCount']);
            $stmt->bindParam(':isbn', $isbn);
            $stmt->bindParam(':date', $bookInfo['publishedDate']);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':id_user', $id_user);

            // Exécution de la requête
            try {
                $stmt->execute();
                header("location:index.php");
            } catch (PDOException $e) {
                $error =  'Erreur lors de l\'exécution de la requête SQL : ' . $e->getMessage();
            }
        } else {
            $error =  'Aucune information disponible pour cet ISBN.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LivreD'occaz - création d'annonce</title>
    <link rel="stylesheet" href="dist/style.css">
</head>

<body>
    <?php include 'navbar.php' ?>
    <section class="flex justify-center">
        <div class="mb-12 mt-32 text-center">
            <form method="post" action="" class="w-96 bg-white p-8 shadow-lg rounded-lg">
                <div class="mb-4">
                    <label for="isbn">Quel est l'ISBN de votre livre ?</label>
                    <input type="text" name="isbn" id="isbn" class="mt-1 w-full border border-emerald-400 shadow-sm">
                </div>
                <div class="mb-4">
                    <label for="prix">Prix de vente de votre livre :</label>
                    <input type="number" name="prix" id="prix" class="mt-1 w-full border border-emerald-400 shadow-sm">
                </div>
                <div class="mt-6">
                    <input type="submit" name="create_annonce" value="Créer l'annonce" class="bg-emerald-400 p-4 cursor-pointer">
                </div>
            </form>
            <p class="text-red-700 text-lg my-2"><?php if (isset($error)) {
                                                        echo $error;
                                                    } ?></p>
        </div>
    </section>
    <hr class="mb-10 mx-6 border-1 rounded">
    <?php include("footer.php") ?>
</body>

</html>