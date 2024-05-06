<?php 
if (isset($_GET ['id'])) {
    $id =  $_GET ['id'];
    echo $id;  
    try {
        $maVariable=new PDO('mysql:host=localhost;dbname=gestionprix',"root","");
        $req=$maVariable->prepare("DELETE FROM listeproduits WHERE IdProduit = $id;");
        $req->execute();
        header('location:ListeProduit.php');
    } catch( PDOException $e){
        echo'ERROR:'.$e->getMessage();
}

    
}
 