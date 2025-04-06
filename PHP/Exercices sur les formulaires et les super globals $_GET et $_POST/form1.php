<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>
      <div class="container w-75 mx-4 my-4 p-3">

            <form action="page2.php" method="GET">
                <p><label for="nom">Nom</label><input type="text" name="nom" id="nom" class="form-control"/></p>


                <p><label for="age">Age</label><input type="text" name="age" id="age" class="form-control"/></p>
                <p><button type="submit" class="btn btn-info">Envoyer</button></p>


            </form>

          <!-- cliquer sur submit ==> enregitrer les données du formulaire dans un associatif array predefini $_GET (method est GET)
              sous forme de key:value pairs =>key (name) et value (valeur de l'input)
              cet associatif array est accessible au niveau de page2.php-->
      </div>    


</body>
</html>