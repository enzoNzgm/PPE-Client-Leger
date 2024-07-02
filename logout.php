<?php
// déconection de l'utilisateur
session_start();
session_destroy();

echo "Déconnexion...";

header('refresh:1; url=index.php');
