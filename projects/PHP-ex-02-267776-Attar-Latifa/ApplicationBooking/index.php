<?php
require_once ('Database.php');
require_once ('config_menu.php');
$database = new Database();
$dbh = $database->getConnection();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<!--IE navigateur-->
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!--responsive-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--CDN Bootstrap.css-->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" >
<link rel="stylesheet" href="css/style.css">
    
<!-- Attar Latifa  01/10/2023 PHP expert - Devoir n°2 : Application booking-->
      
<title>Accueil</title>
       
</head>
<body>  
<!--Appel menu-->
<?php
generateMenu('index.php', '', './Acces/Reservations.php');
?>
<div>
    <h1 class="heading fig p-3 m-4">Application Booking</h1>
</div>

<div class="container-fluid h-100 p-3 my-5">
<div class="card w-50 text-center">
        <img src="./Image/appli.jpg" class="card-img img-fluid" alt="hotel">
        <div class="card-body-1 p-3">
            <a href="./Acces/ListesDesHotels.php" class="btn btn-success m-2">Listes des hotels</a>
        </div>
    </div>
</div> 
</body>
</html>