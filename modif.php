<?php 

$maVariable=new PDO('mysql:host=localhost;dbname=gestionprix',"root","");

// Paramètrage des erreurs et exceptions à la connexion. 
$maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 if (isset($_POST["modifier"])) {
                         
         $nomProduit = $_POST["nomProduit"];
         $typeProduit = $_POST["typeProduit"];
         $prixProduit = $_POST["prixProduit"];
         $symboleMonetaire = $_POST["symboleMonetaire"];
         $idProduit = $_POST["id"];
     
         $maj=$maVariable->prepare("UPDATE listeproduits SET NomProduit=:nomProduit, TypeProduit=:typeProduit, PrixProduit=:prixProduit, SymboleMonetaire=:symboleMonaie WHERE IdProduit=:idProduit");
         $execution =  $maj->execute([
             "nomProduit"=> $nomProduit,
             "typeProduit"=> $typeProduit,
             "prixProduit"=> $prixProduit,
             "symboleMonaie"=> $symboleMonetaire,
             "idProduit"=> $idProduit
         ]);
 

     if ($execution) {
        header('location:ListeProduit.php');
     }
 }