<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les révandications des Gens qui visite le site de P3C en RDC</title>
    <link rel="stylesheet" href="Style_VoirLesRevendications.css">
</head>
<body>
    <div class="dash">
            
            <h1>Dash Board</h1>
            <nav>
                <a href="ListeProduit.php" ><h3>LISTE DES PRODUITS</h3></a>
                <a href="VoirLesRevendications.php" ><h3 class="ok">REVANDICATION</h3></a>
            </nav>
    </div>  
    <div class="contenu">
        <h2 class="titre">LES REVENDICATIONS DES VISITEURS DU SITE P3C (CONGO-DR)</h1>
        <?php
            try{
                // Ouverture de la connexion à la base de données.
                $maVariable=new PDO('mysql:host=localhost;dbname=gestionprix',"root","");

                // Paramètreage des erreurs et exceptions à la connexion. 
                $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                //Préparation de la requête de lecture des données dans la base de données.
                $req=$maVariable->prepare("SELECT * FROM revendications ORDER BY Nom");

                // Execution de la requête
                $req->execute();

                //Recupération des lignes de la base de données
                $data=$req->fetchAll(PDO::FETCH_ASSOC);

                //Nous parcourons les résultats de requêtes et nous les affichons ligne par ligne.
                foreach($data as $row) {
        
            echo '<div class="revendication">
                        <div class="en-tete-revendication">
                                <label for="Nom" class="en-tete-revendication-label">Nom : '.$row["Nom"].'</label>
                                <label for="Sexe" class="en-tete-revendication-label">Sexe : '.$row["Sexe"].'</label>
                                <label for="Profession" class="en-tete-revendication-label">Proféssion : '.$row["Profession"].'</label>
                                <label for="Age" class="en-tete-revendication-label">Age : '.$row["Age"].' ans</label>
                                <label class="en-tete-revendication-label" for="AdresseResid">Adresse de résidance : '.$row["AdresseResidance"].'</label>
                        </div>
                        <div class="contenu-revendication">
                            <label for="Revandication">Revendication</label>
                            <p>'
                            .$row["Revendication"].
                            '</p>
                        </div class="contenu-revendication">
                    </div>';
         }
         }
            catch( PDOException $e){
                     echo'ERROR:'.$e->getMessage();
            }
                ?>
    </div>
    </body>
    </html>
</body>
</html>