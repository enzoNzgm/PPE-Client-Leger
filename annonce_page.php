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
    <section class="grid gap-20 grid-cols-4 mt-24">
        <?php
        include('aside.php');
        ?>
        <section class="flex col-span-4 mx-80 mt-24">
            <div class="mr-4">
                <img src="images/test.jpg" alt="couverture du livre" class="shadow w-96">
            </div>
            <div>
                <h1 class="text-2xl font-bold">Titre du livre</h1>
                <h2 class="text-lg text-emerald-400 mb-2">Auteur</h2>
                <h2 class="font-semibold text-xl">Résumé</h2>
                <p class="w-1/2 mb-4">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Neque, numquam. Aliquid
                    rem
                    facere dolorem
                    veritatis repellat omnis molestias odit possimus, cum dicta labore, velit excepturi ullam voluptatum
                    minima accusantium ut doloribus, atque quia id animi quo sunt at! Unde, recusandae.</p>
                <h2 class="font-semibold text-xl mb-2">Caractéristiques</h2>
                <div class="flex">
                    <table class="mr-1 ">
                        <tbody>
                            <tr class="bg-slate-200">
                                <td class="pr-32">Edition</td>
                                <td class="pr-32">Pocket</td>
                            </tr>
                            <tr>
                                <td clas="pr-32">Auteur</td>
                                <td class="pr-32">nom</td>
                            </tr>
                            <tr class="bg-slate-200">
                                <td class="pr-32">Page</td>
                                <td class="pr-32">nb</td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <tbody>
                            <tr class="bg-slate-200">
                                <td class="pr-32">ISBN</td>
                                <td class="pr-32">Numero</td>
                            </tr>
                            <tr>
                                <td clas="pr-32">Date</td>
                                <td class="pr-32">Date</td>
                            </tr>
                            <tr class="bg-slate-200">
                                <td class="pr-32">Dimension</td>
                                <td class="pr-32">20x32</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </section>
    </section>
</body>

</html>