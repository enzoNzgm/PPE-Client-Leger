<?php
session_start();
include_once('config/PDO.php');

// Afficher tous les messages de la table "messages" dans une liste
$stmt = $conn->prepare("SELECT * FROM commentaires");
$stmt->execute();
$commentaires = $stmt->fetchAll();

echo "<ul>";
foreach ($commentaires as $commentaire) {
    echo "<li>" . $commentaire['commentaire'] . "</li>";
}
echo "</ul>";

if (isset($_POST['delete'])) {
    $id_commentaire = $_POST['id_commentaire'];
    $stmt = $conn->prepare("DELETE FROM commentaires WHERE id_commentaire = ?");
    $stmt->execute([$id_commentaire]);
    header('location: adminMessage.php');
}
if (isset($_POST['delete'])) {
    $id_commentaire = $_POST['id_commentaire'];
    $stmt = $conn->prepare("DELETE FROM commentaires WHERE id_commentaire = ?");
    $stmt->execute([$id_commentaire]);
    header('location: adminMessage.php');
}

// Afficher tous les messages de la table "messages" dans une liste
$stmt = $conn->prepare("SELECT * FROM commentaires");
$stmt->execute();
$commentaires = $stmt->fetchAll();

echo "<ul>";
foreach ($commentaires as $commentaire) {
    echo "<li>" . $commentaire['commentaire'] . " <form method='POST' action='adminMessage.php'><input type='hidden' name='id_commentaire' value='" . $commentaire['id_commentaire'] . "'><input type='submit' name='delete' value='Supprimer'></form></li>";
}
echo "</ul>";
