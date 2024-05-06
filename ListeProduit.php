<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de produits et leurs prix</title>
    <link rel="stylesheet" href="Style_ListeProduit_Admin.css">
</head>
<body>
    <div class="dash">
        
            <h1>Dash Board</h1>
            <nav>
                <a href="ListeProduit.php"  ><h3 class="ok">LISTE DES PRODUITS</h3></a>
                <a href="VoirLesRevendications.php"><h3>REVANDICATION</h3></a>
            </nav>
    </div>
    <div class="tableau">
        <h1 class="titre">LISTE DES PRODUITS ET LEURS PRIX</h1>
        <table>
            <thead>
                <th>Nom du Produit</th>
                <th>Type du Produit</th>
                <th>Prix</th>
                <th>Symbole Monétaire</th>
                <th class="action">Actions</th>  
            </thead>
            
            <tbody>
                <tr class="ligne-form">
                    <form action="ListeProduit.php"  method="post">
                        <td class="td-form">
                            <div class="info"> <input type="text" name="nomProduit" placeholder="Entrez le nom du produit à ajouter"></div>
                        </td>
                        <td class="td-form">
                            <div class="info"> <input type="text" name="typeProduit" placeholder="Entrez le type du du produit à ajouter"></div>
                        </td>
                        <td class="td-form">
                            <div class="info"><input type="number" name="prixProduit" placeholder="Entrez le prix du produit"></div> 
                        </td>
                        </td class="td-form">
                        <td class="td-form">
                            <select name="symboleMonaie">
                                <option >Symbole monétaire</option>
                                <option value="FC">FC</option>
                                <option value="$">$</option>
                                <option value="£">£</option>
                            </select>
                            <td class="td-form">
                                <div class="ajouter action"><button name="ajouter">Ajouter</button></div>
                            </td>
                        </td>
                    </form>
                        <?php
                            if (isset($_POST["ajouter"])) {
                                $nomProduit = $_POST["nomProduit"];
                                $typeProduit = $_POST["typeProduit"];
                                $prixProduit = $_POST["prixProduit"];
                                $syboleMonaie = $_POST["symboleMonaie"];

                                try{
                                        // Ouverture de la connexion à la base de données.
                                        $maVariable=new PDO('mysql:host=localhost;dbname=gestionprix',"root","");

                                        // Paramètrage des erreurs et exceptions à la connexion. 
                                        $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                                        //Préparation de la requête de la lecture des données dans la base des données.
                                        $req=$maVariable->prepare("INSERT INTO listeproduits(NomProduit, TypeProduit, PrixProduit,SymboleMonetaire )
                                        VALUES(:NomProduit, :TypeProduit, :PrixProduit, :SymboleMonetaire)");

                                        //Execution de la requête
                                        $req->execute([
                                        ':NomProduit'=> $nomProduit,
                                        ':TypeProduit' => $typeProduit ,
                                        ':PrixProduit' => $prixProduit,
                                        ':SymboleMonetaire' => $syboleMonaie
                                        ]);

                                        header('location:ListeProduit.php');

                                    }catch( PDOException $e){
                                        echo'ERROR:'.$e->getMessage();
                                    }
                                }
                        ?>
                </tr>
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
                        $numero = $row['IdProduit'];
                        echo '<tr>
                        <td class="nonCentrer">'.$row['NomProduit'] .'</td>
                        <td class="nonCentrer">'.$row['TypeProduit'] .'</td>
                        <td class="centrer">'.$row['PrixProduit'].'</td>
                        <td class="centrer">'.$row['SymboleMonetaire'].'</td>
                        <td class="nonCentrer action">
                        <a href="suprimer.php?id='.$numero.'"><img src="./icones/icons8-delete-30.png" alt="Icone delete"></a>
                        <a href="modifier.php?id='.$numero.'"><img src="./icones/icons8-edit-property-50.png" alt="Icone modifier" style="width: 32px; height: 32px; padding-top: 5px;"></a>
                        </td>
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