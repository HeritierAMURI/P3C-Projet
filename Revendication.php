<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revendication des prix des produits fixés par l'Etat Congolais (RD.Congo)</title>
    <link rel="stylesheet" href="Style_Revendication.css">
</head>
<body>
    <div id="en_tete">
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
     
    <div class="Revendication">
        <h1 class = "rev-title flex"> <span class="title">REVENDICATION</span></h1>
        <div class="FormRevendication flex">
            <form action="Revendication.php" method="post" class = "flex">
                    <div class="informations">
                            <div class="info"> <input type="text" name="nom" id="Nom" placeholder="Entrer votre nom complet" required></div>
                        
                            <div class="info">
                                <select name="sexe">
                                    <option >Sexe</option>
                                    <option value="Masculin">Masculin</option>
                                    <option value="Féminin">Féminin</option>
                                </select>
                            </div>
                            <div class="info"><input type="number" name="age" id="Age" placeholder="Saisisez votre âge" required></div> 
                    
                        <div class="info"><input type="text" name="profession" id="Profession" placeholder = "Entrez votre profession" required></div>
                        <div class="info"> <input type="text" name="adresseResidance" id="AdresseResid" placeholder = "Entrez votre adresse de résidance" required></div>

                        <div class="info">
                            <textarea name="revendication" id="Revebdication" cols="60" rows="3" maxlength="700" required> Exprimez votre votre revendication</textarea>
                        </div>
                        <div class="action">
                        <input type="submit" name="envoyer" value="Envoyer"> 
            </div>
                    </div>
            </form>
        </div>
    </div>
    <?php
        if (isset($_POST["envoyer"])) {
            $nom = $_POST["nom"];
            $sexe = $_POST["sexe"];
            $profession = $_POST["profession"];
            $adresseResidance = $_POST["adresseResidance"];
            $age = $_POST["age"];
            $revendication = $_POST["revendication"];

            try{
                    // Ouverture de la connexion à la base de données.
                    $maVariable=new PDO('mysql:host=localhost;dbname=gestionprix',"root","");

                    // Paramètrage des erreurs et exceptions à la connexion. 
                    $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                    //Préparation de la requête de la lecture des données dans la base des données.
                    $req=$maVariable->prepare("INSERT INTO revendications(Nom, Sexe, Profession, AdresseResidance, Age, Revendication)
                    VALUES(:Nom, :Sexe, :Profession, :AdresseResidance, :Age, :Revendication)");

                    //Execution de la requête
                    $req->execute([
                    ':Nom'=> $nom,
                    ':Sexe' => $sexe ,
                    ':Profession' => $profession,
                    ':AdresseResidance' => $adresseResidance,
                    ':Age' => $age,
                    ':Revendication' => $revendication
                    ]);

                }catch( PDOException $e){
                    echo'ERROR:'.$e->getMessage();
                }
        }
        ?>

</body>
</html>