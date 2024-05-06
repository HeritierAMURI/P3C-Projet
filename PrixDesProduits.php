<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prix des produits fixés par l'Etat Congolais (RDC)</title>
    <link rel="stylesheet" href="Style_PrixDesProduits.css">
</head>
<body>
<div class="en_tete">
            <header class ="flex">
                <div id="titre_principal flex">           
                    <div class="classe flex">
                        <div class="logo-pic flex"><img  src="image\Logo_Du_Site.jpg" class="img" alt="Logo du site de publication des prix des produits fixés par l'Etat Congolais" id="Logo"></div>
                        <div class="principal-title flex"><h1 >Publication De Prix Des Produits Au Congo</h1></div>
                    </div>
                    <h2 class="h2">Site de publication des prix des produits fixés par l'Etat Congolais (RD.Congo)</h2>
                </div>
            
                <nav class="flex" >
                        <a href="Accueil.php">ACCUEIL</a>
                        <a href="PrixDesProduits.php" class="gauche aaa">PRIX DES PRODUITS</a>
                        <a href="Revendication.php" class="gauche">REVENDICATION</a>
                </nav>
            </header>
    </div>
    <div class="contenu">
        <h1 id="titre">
            <span class="titre">LISTE DES PRODUITS ET LEURS PRIX</span>
        </h1>
        <table class="tableau">
            <thead>
                <th class="td1">Nom du Produit</th>
                <th class="td1">Type du Produit</th>
                <th>Prix du Produit</th>
                <th>Symbole Monétaire</th>
            </thead>
            <tbody>
                <?php
                    try{
                    // Ouverture de la connexion à la base de données.
                    $maVariable=new PDO('mysql:host=localhost;dbname=gestionprix',"root","");

                    // Paramètreage des erreurs et exceptions à la connexion. 
                    $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                    //Préparation de la requête de lecture des données dans la base de données.
                    $req=$maVariable->prepare("SELECT * FROM listeproduits ORDER BY NomProduit");

                    // Execution de la requête
                    $req->execute();

                    //Recupération des lignes de la base de données
                    $data=$req->fetchAll(PDO::FETCH_ASSOC);

                    //Nous parcourons les résultats de requêtes et nous les affichons ligne par ligne.
                    foreach($data as $row) {

                        echo '<tr>
                        <td class="td1">'.$row['NomProduit'].'</td>
                        <td class="td1">'.$row['TypeProduit'].'</td>
                        <td class="td2">'.$row['PrixProduit'].'</td>
                        <td class="td2">'.$row['SymboleMonetaire'].'</td>
                        </tr>';
                    }

                    }catch( PDOException $e){
                     echo'ERROR:'.$e->getMessage();
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>