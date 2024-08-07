<!-- navbar pour les pages du site -->
<nav class="flex justify-around items-center outline py-4 fixed top-0 w-full bg-white z-10">
    <div class="flex ">
        <a href="index.php" class="flex items-center">
            <img src="images/notebook.png" alt="logo site" class="w-112">
            <h1 class="text-3xl font-bold mx-2">Livre<span class="text-emerald-400">D'occaz</span></h1>
        </a>
    </div>
    <div class="flex">
        <form action="index.php" method="GET" class="flex">
            <input type="search" placeholder="Entrez le titre du livre..." name="search" id="search" value="<?php if (isset($search)) echo htmlspecialchars($search); ?>" class="py-2 px-4 mr-8 w-96 rounded-full border-2 border-emerald-400 lg:py-0 lg:px-2">
            <button type="submit" class="bg-emerald-400 px-6 py-2 rounded-full text-white font-bold border-2 border-emerald-800 transform transition-transform duration-300 hover:bg-white hover:text-emerald-400 hover:scale-105 inline-block">Rechercher</button>
        </form>
        <div class="ml-2 mr-6">
            <!-- <a href="about-us.php" class="text-[#4F4F4F] text-lg px-4 hover:text-black-900 inline-block transform transition-transform duration-300 hover:scale-110">Qui
                sommes-nous ?</a> -->
            <a href="create_annonce.php" class="bg-emerald-400 px-6 py-2 rounded-full text-white font-bold border-2 border-emerald-800 transform transition-transform duration-300 hover:bg-white hover:text-emerald-400 hover:scale-105 inline-block">Déposer
                une annonce</a>
            <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == "1") : ?>
                <a href="adminMessage.php" class="bg-emerald-400 px-6 py-2 rounded-full text-white font-bold border-2 border-emerald-800 transform transition-transform duration-300 hover:bg-white hover:text-emerald-400 hover:scale-105 inline-block">Afficher messages</a>
            <?php endif ?>
        </div>
    </div>
    <div class="flex">
        <!-- Si l'utilisateur est connecté, afficher le panier et le bouton de déconnexion -->
        <?php if (isset($_SESSION['email-logged'])) : ?>
            <a href="panier.php" class="flex items-center flex-col mx-4">
                <img src="images/shopping-bag.png" alt="panier d'achat">
                <span>Panier</span>
            </a>
            <a href="logout.php" class="flex items-center flex-col mx-4">
                <img src="images/logout.png" alt="déconnexion">
                <span>Déconnexion</span>
            </a>
            <!-- Sinon afficher le bouton de connexion -->
        <?php else : ?>
            <a href="login.php" class="flex items-center flex-col mx-4">
                <img src="images/user.png" alt="connexion">
                <span>Se connecter</span>
            </a>

        <?php endif ?>
    </div>
</nav>