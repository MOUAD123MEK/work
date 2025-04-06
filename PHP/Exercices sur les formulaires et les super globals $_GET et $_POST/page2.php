<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title> 

</head>
<body>
  
     <ul>
      <li>Name : <?php echo isset($_GET["nom"]) && !empty($_GET["nom"]) ?$_GET["nom"]:"Default nom";  ?></li>
      <li>Age : <?php echo $_GET["age"];  ?></li>
      <li>Name : <?php echo $_GET["nom"];  ?></li>
      <li>Adresse : <?php echo isset($_GET["adresse"]) && !empty($_GET["adresse"]) ?$_GET["adresse"]:"Default adresse";  ?></li>
     </ul>







</body>
</html>