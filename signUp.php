<?php
session_start();
include_once('config/PDO.php');

if (isset($_POST['inscription'])) {

    $username = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $verifPassword = $_POST['password2'];
    //password hash
    $emailcheck = $conn->prepare('SELECT * FROM users WHERE email = ?');
    $emailcheck->execute([$email]);

    if ($emailcheck->rowCount() == 0) {
        if ($password == $verifPassword) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare('INSERT INTO `users`(`username`, `email`, `password`) VALUES (?, ?, ?)');
            $stmt->execute([$username, $email, $password]);

            header('location: login.php');
        } else {
            $error = "Mots de passe non similaire";
        }
    } else {
        $error = "L'email éxiste déja";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscris-toi - LivreD'occaz</title>
    <link rel="stylesheet" href="dist/style.css">
</head>

<body>
    <section class="h-screen flex flex-col items-center justify-center bg-slate-100">
        <div class="flex items-center mb-4">
            <img src="./images/notebook.png" alt="logo du site" class="w-10">
            <span class="self-center text-2xl">LivreD'occaz</span>
        </div>
        <div class="rounded-lg shadow py-4 px-6 bg-white">
            <h1 class="text-xl font-semibold mb-4">Créez votre compte</h1>
            <form action="" method="POST">
                <div class="flex flex-col mb-4">
                    <label for="email" class="mb-2">Votre Nom</label>
                    <input type="text" name="nom" id="nom" placeholder="Nom" class="rounded-lg bg-gray-50 border h-10 w-96" required>
                </div>
                <div class="flex flex-col mb-4">
                    <label for="email" class="mb-2">Votre email</label>
                    <input type="email" name="email" id="email" placeholder="prenom@mail.fr" class="rounded-lg bg-gray-50 border h-10 w-96" required>
                </div>
                <div class="flex flex-col mb-4">
                    <label for="password" class="mb-2">Votre mot de passe</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="rounded-lg bg-gray-50 border h-10 w-96" required>
                </div>
                <div class="flex flex-col">
                    <label for="password" class="mb-2">Confirmez votre mot de passe</label>
                    <input type="password" name="password2" id="password2" placeholder="••••••••" class="rounded-lg bg-gray-50 border h-10 w-96" required>
                </div>
                <input type="submit" name="inscription" value="Inscription" class="w-full h-9 bg-emerald-400 my-4 rounded-lg text-white font-semibold cursor-pointer">
            </form>
            <p class="text-red-700 text-lg my-2"><?php if (isset($error)) {
                                                        echo $error;
                                                    } ?></p>
            <p>Vous étes déja inscrit? <a href="login.php" class="text-emerald-400 font-bold hover:scale-110 transition-transform">Connectez-vous</a></p>

        </div>
    </section>
</body>

</html>