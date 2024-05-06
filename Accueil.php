<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration du site de publication des prix des produits fixés par l'Etat Congolais (DRC)</title>
    <link rel="stylesheet" href="Style_Accueil_Admin.css">
</head>
<body>
    <div class="containere">
        <h3>APPLICATION DE GESTON DES PRIX DES PRODUITS</h3>
            <form action="ACcueil.php" method ='post' class=""login-form>
                <div class="form-group">
                    <label for="Identifiant">Entrez votre identifiant : </label>
                    <input type="text" name="identifiant" id="Identifiant" placeholder="Entrer votre identifiant" required>
                </div>
                <div class="form-group">
                    <label for="MotDePasse">Entrez votre mot de passe</label>
                    <input type="password" name="motDePasse" id="MotDePasse" placeholder="Entrer votre mot de passe" required>
                </div>
                <input type="submit" name="seConnecter" value="Se Connecter">
                <?php
        if (isset($_POST["seConnecter"])) {
            $identifiant = $_POST["identifiant"];
            $motDePasse = $_POST["motDePasse"];

            try{
                    // Ouverture de la connexion à la base de données.
                    $maVariable=new PDO('mysql:host=localhost;dbname=gestionprix',"root","");// Paramètrage des erreurs et exceptions à la connexion. 
                    $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                    //Préparer de la requête de la lecture des données dans la base des données.
                    $req=$maVariable->prepare("SELECT * FROM login_admin;");
                    //Execution de la requête
                    $req->execute();

                    //Recupération des les lignes de la base de données
                    $data=$req->fetchAll(PDO::FETCH_ASSOC);
                    //Parcourir les résultats de la recherche et afficher ligne par lugne.
                    foreach($data as $row) {
                        

                        if ($identifiant==$row['Identifiant'] && $motDePasse==$row['MotDePasse']) {
                            header('location:ListeProduit.php');
                            exit();
                        }
                        
                    }
                    echo "<p style=\"text-align: center;font-size:1.5em; color: red;\">Vos identifiants sont incorrect !</p>";
                }catch( PDOException $e){
                    echo'ERROR:'.$e->getMessage();
                }
        }
        ?>
            </form>
    </div>
    
</body>
</html>