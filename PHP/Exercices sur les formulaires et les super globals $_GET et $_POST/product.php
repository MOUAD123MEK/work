<?php
   $products=[];
    if(isset($_POST["intitule"]) && !empty($_POST["intitule"])&&isset($_POST["prix"]) && !empty($_POST["prix"])&&isset($_POST["cat"]) && !empty($_POST["cat"])){
         $newProduct=["intitule"=>$_POST["intitule"],"prix"=>$_POST["prix"],"cat"=>$_POST["cat"]];
          array_push($products,$newProduct);
          print_r($products);
    }



?>