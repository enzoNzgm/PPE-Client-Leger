<?php
session_start();
include_once('config/PDO.php');

if (isset($_POST['connexion'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $stmt->execute([$email]);

    $data = $stmt->fetch();

    $id_user = $data['id_user'];
    $username = $data['username'];
    $password_hash = $data['password'];

    if (password_verify($password, $password_hash)) {
        $_SESSION['user_id-logged'] = $id_user;
        $_SESSION['email-logged'] = $email;
        $_SESSION['username-logged'] = $username;
        header("location: index.php");
    } else {
        $error = "Identifiant ou mot de passe incorrect";
    }
}

if (isset($_SESSION['email-logged'])) {
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - LivreD'occaz</title>
    <link rel="stylesheet" href="dist/style.css">
</head>

<body>
    <section class="h-screen flex flex-col items-center justify-center bg-slate-100">
        <div class="flex items-center mb-4">
            <img src="./images/notebook.png" alt="logo du site" class="w-10">
            <span class="self-center text-2xl">LivreD'occaz</span>
        </div>
        <div class="rounded-lg shadow py-4 px-6 bg-white">
            <h1 class="text-xl font-semibold mb-4">Connectez-vous à votre compte</h1>
            <form action="login.php" method="POST">
                <div class="flex flex-col mb-4">
                    <label for="email" class="mb-2">Votre email</label>
                    <input type="email" name="email" id="email" placeholder="prenom@mail.fr" class="rounded-lg bg-gray-50 border h-10 w-96 placeholder:ml-4" required>
                </div>
                <div class="flex flex-col">
                    <label for="password" class="mb-2">Votre mot de passe</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="rounded-lg bg-gray-50 border h-10 w-96 placeholder:ml-4" required>
                </div>
                <input type="submit" name="connexion" value="connexion" class="w-full h-9 bg-emerald-400 my-4 rounded-lg text-white font-semibold cursor-pointer">
            </form>
            <p class="text-red-700 text-lg my-2"><?php if (isset($error)) {
                                                        echo $error;
                                                    } ?></p>
            <p>Vous n'avez pas de compte? <a href="signUp.php" class="text-emerald-400 font-bold hover:scale-110 transition-transform">Inscris-toi</a></p>

        </div>
    </section>
</body>

</html>