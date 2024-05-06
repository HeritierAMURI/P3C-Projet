<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="modifierStyle.css">
</head>
<body>
    <?php
        
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $id= isset($_GET['id']) ? $_GET['id'] : "";
            try{
                // Ouverture de la connexion à la base de données.
                $maVariable=new PDO('mysql:host=localhost;dbname=gestionprix',"root","");

                // Paramètrage des erreurs et exceptions à la connexion. 
                $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                

                //Préparation de la requête de lecture des données dans la base de données.
                $req=$maVariable->prepare("SELECT * FROM listeproduits WHERE IdProduit=$id");

                //Executer la requête
                $req->execute();

                //Recupérer les lignes
                $data=$req->fetchAll(PDO::FETCH_ASSOC);
                }catch(PDOException $e){
                    echo " ".$e->getMessage();
                }
                
                //Parcourir les résultats de la recherche et afficher ligne par lugne.
                foreach($data as $row) {

                    echo '<div class="container">
                        <h3>MODIFICATION DES PROPRIETES D\'UN PRODUIT</h3>
                        <form action="modif.php" method="post">
                            <div class="form-group">
                                <label for="nomProduit">Nom du produit à modifier : </label>
                                <input type="text" id="nomProduit"  name="nomProduit" value="'.$row["NomProduit"].'">
                            </div>

                            <div class="form-group">
                                <label for="typeProduit">Type du produit à modifier : </label>
                                <input type="text" id="typeProduit" name="typeProduit" value="'.$row["TypeProduit"].'">
                            </div>

                            <div class="form-group">
                                <label for="prixProduit">Prix du produit à modifier : </label>
                                <input type="number" id="prixProduit" name="prixProduit" value="'.$row["PrixProduit"].'">
                            </div><br>

                            <div class="form-group">
                            <label for="symboleMonaie">Symbole monétaire du produit à modifier : </label>
                            <input type="text" id="symboleMonaie" name="symboleMonetaire" value="'.$row["SymboleMonetaire"].'">
                            </div><br>
                             <div class="form-group">
                            <input type="number" id ="id" name="id" value="'.$row["IdProduit"].'">
                            </div><br>
                            <button type="submit" class="button" name="modifier">Modifier</button>
                        </form>
                    </div>';
                    }
           
        }
        
        ?>    
</body>
</html>