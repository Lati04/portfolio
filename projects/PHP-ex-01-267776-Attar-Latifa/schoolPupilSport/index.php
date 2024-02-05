<?php
require_once ('database.php');
require_once('Class.php');
require_once ('ClassManager.php');
// Création d'un objet PDO
$database = new Database();
$dbh = $database->getConnection();

////////////////////////////////////////////////////
//////////////////// SCHOOL ////////////////////////
///////////////////////////////////////////////////
// Création d'un objet school
$school_data = array( 
    'name'=> ['School A', 'School B', 'School C']
);
$school = new School($school_data);
// Instanciation de la classe schoollManager
$schoolManager = new SchoolManager($dbh);
// Appel de la méthode addData
$schoolId = $schoolManager-> addData('school', $school_data);

/////////////////////////////////////////////////////
//////////////////// PUPIL /////////////////////////
////////////////////////////////////////////////////
// Création d'un objet pupil
$pupil_data = array(    
    'name'=> ['Sofia', 'Eylul', 'Abi', 'Jason', 'Denzel', 'Hassan', 'Georgia', 'Mickael', 'Angelina', 'Lewann',
              'Adam', 'Nelson', 'Gokhan', 'Eymeric', 'Maylon', 'Zaineb', 'Kawter', 'Nawel', 'Tiago'],
    'id_school' => (int) $schoolId
);
$pupil = new Pupil($pupil_data);
// Instanciation de la classe pupilManager 
$pupilManager = new PupilManager($dbh, $schoolId);
// Appel de la méthode addData avec objet pupil
$pupilId = $pupilManager->addData('pupil', $pupil_data);

//////////////////////////////////////////////////
///////////////////// sport /////////////////////
//////////////////////////////////////////////////
$data_sport = array( 
    'name'=> ['Boxe', 'Judo', 'football', 'natation','cyclisme'],
    //'number_sports' => $randomNumber
);
$sport = new Sport($data_sport);
// Instanciation de la classe sportManager
$sportManager = new SportManager($dbh);
// Appel de la méthode addSport avec objet Sport
$sportId = $sportManager->addSport('sport', $data_sport);

//////////////////////////////////////////////////
///////////////////  pupilSport /////////////////
/////////////////////////////////////////////////
// Création d'un objet pupilSport
$pupilSport_data = array( 
        'id_pupil' => (int) $pupilId,
        'id_sport' => 'null'
);
foreach($sportId as $sport){
    $pupilSport_data['id_sport'] = $sport;
$pupilSport = new PupilSport($pupilSport_data);
// Instanciation de la classe pupilSportManager
$pupilSportManager = new PupilSportManager($dbh);
// Appel de la méthode addPupilSport avec objet pupilSport
$pupilSportId = $pupilSportManager->addPupilSport('pupil_sport', $pupilSport_data);
}
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
    
    <!-- Attar Latifa 19/09/2023 Devoir n°1 : Génération de contenus et statistiques -->
      
    <title>Géneration de contenus et statistiques</title>
       
    </head>
    <body class="body px-4">
        <!--Contenu affichant dfférents tableaux afin de  Restituer la liste des écoles en affichant pour chacune :
             le nombre d’élèves ;
             le nombre d’élèves pratiquant au moins un sport ;
             le nombre d’activités sportives pratiquées ;
             la liste des activités sportives pratiquées classées par 
             ordre croissant en fonction du nombre d’élèves qui les pratiquent et en précisant ce 
             nombre pour chacune des activités -->
    <h1 class= "title mx-5 p-3">Listes des écoles</h1>        
    <div class="wrapper m-5 p-3">
        <div class="container p-5">    
            <div class="row mb-5">
                <div class="col-md-6 gx-5">
                    <h2 class= "subtitle school">Listes des écoles avec le nombre<br> d'élèves</h2>
                        <table class="table table-striped table-borderless text-center">
                        <tr>
                            <th>Nom de l'école</th>
                            <th>Nombres d'élèves</th>
                        </tr>
                        <?php
                        $schools = $schoolManager->getSchools();
                        foreach($schools as $row){
                            echo'<tr>';
                            echo'<td>'.$row['name'].'</td>';
                            echo'<td>'.$row['num_pupils'].'</td>';
                            echo'</tr>';
                        }
                        ?>
                        </table>
                </div>
                <div class="col-md-6">
                    <h2 class= "subtitle school1">Listes des écoles avec le  nombre <br> d'élèves pratiquant au moins un sport</h2>
                        <table class="table table-striped table-borderless text-center">
                        <tr>
                            <th>Nom de l'école</th>
                            <th>Nombres d'élèves</th>
                        </tr>
                        <?php
                        $schoolsAndPupils = $schoolManager->getSchoolsAndPupils();
                        foreach($schoolsAndPupils as $school){
                            echo'<tr>';
                            echo'<td>'.$school['name'].'</td>';
                            echo'<td>'.$school['num_pupils'].'</td>';
                            echo'</tr>';
                        }
                        ?>
                        </table> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 gx-5">
                    <h2 class= "subtitle">Listes des écoles avec le nombre <br> d'activités sportives pratiquées</h2>
                        <table class="table table-striped table-borderless text-center ">
                        <tr>
                            <th>Nom de l'école</th>
                            <th>Nombres d'activités sportives</th>
                        </tr>
                        <?php
                        $schoolsAndSports = $schoolManager->getSchoolsAndSports();
                        foreach($schoolsAndSports as $school){
                            echo'<tr>';
                            echo'<td>'.$school['name'].'</td>';
                            echo'<td>'.$school['num_sports'].'</td>';
                            echo'</tr>';
                        }
                        ?>
                        </table>
                </div>
                <div class="col-md-6">
                    <h2 class= "subtitle activity">Liste des activités sportives  pratiquées <br> classées par ordre 
                    croissant avec <br> le nombre d'élèves qui les pratiquent</h2>

                        <table class="table table-striped table-borderless text-center">
                            <tr>
                                <th>Nombre d'élèves</th>
                                <th>Activités sportives</th>
                            </tr>
                            <?php
                            $schoolsAndSportsByPupilsCount = $pupilSportManager->getsportsByPupilsCount();
                        
                            foreach($schoolsAndSportsByPupilsCount as $row){
                                echo'<tr>';
                                echo'<td>'.$row['num_pupils'].'</td>';
                                echo'<td>'.$row['sport_name'].'</td>';
                                echo'</tr>';
                            }
                            ?>
                        </table>
                </div>
            </div>
         </div>
    </div>        
 
     <!--Script Javascript et JQuery-->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>