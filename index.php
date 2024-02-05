<?php

   $firstname = $name = $email = $phone = $message = '';
   $firstnameError = $nameError = $emailError = $phoneError = $messageError = '';
   $isSuccess = false;
   $emailTo = 'nefer_titi.57@hotmail.fr';

   ///////////////////////////////////////////////////////
   ///                   Sécurité                    ////
   //////////////////////////////////////////////////////
  
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
       $firstname = verifyInput($_POST['firstname']);
       $name = verifyInput($_POST['name']);
       $email = verifyInput($_POST['email']);
       $phone = verifyInput($_POST['phone']);
       $message = verifyInput($_POST['message']);
       $isSuccess = true;
       $emailText = '';

      if(empty($firstname)){
          $firstnameError = 'Donnez moi votre prénom, s\'il vous plâit !';
          $isSuccess = false;
      }else
        $emailText .= "firstname: $firstname\n";
      

      if(empty($name)){
        $nameError = 'Donnez moi votre nom, s\'il vous plâit !';
        $isSuccess = false;
      }else
      $emailText .= "name: $name\n";
 
      if(!isEmail($email)){
        $emailError = 'Donnez moi un email correct, s\'il vous plâit !';
        $isSuccess = false;
      }else
      $emailText .= 'email: $email\n';

      if(!isPhone($phone)){
        $phoneError = 'Donnez moi votre numéro de télephone composé de chiffre et espace, s\'il vous plâit !';
        $isSuccess = false;
      }else
      $emailText .= 'phone: $phone\n';

      if(empty($message)){
        $messageError = 'Laissez moi un message, s\'il vous plâit !';
        $isSuccess = false;
      }else
      $emailText .= 'message: $message\n';

      if($isSuccess){
          $headers = 'From: $firstname $name <$email>\r\nReply-To: $email';
          mail($emailTo, 'Un message de votre site', $emailText, $headers);
          $firstname = $name = $email = $phone = $message = '';
      }
   }

   function isPhone($var){
       return preg_match("/^[0-9 ]*$/", $var);
   }

   function isEmail($var){
       return filter_var($var, FILTER_VALIDATE_EMAIL);
   }

   function verifyInput($var){
      $var = trim($var ?? '');
      $var = stripslashes($var);
      $var = htmlspecialchars($var);

      return $var;
   }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Portfolio Développeur web - Attar Latifa</title>
  <meta name="Description" content="En tant que développeur Web, mon portfolio présente mes compétences en HTML, CSS, JavaScript
  , PHP, Angular, Symfony, etc. Découvrez mes diplômes, mes différents prpjets, mes recommandations, et utilisez mon formulaire de 
  contact pour me contacter.">
  <!--IE navigateur-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!--responsive-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!--CDN Bootstrap.css-->
 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!--css-->
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

<!--NavBar -->

  <nav id="myNavbar" class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" 
      aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item m-3">
            <a tabindex="1" class="nav-link active" aria-current="page" href="#about">Moi</a>
          </li>
          <li class="nav-item m-3">
            <a tabindex="2" class="nav-link" href="#skills">Compétence</a>
          </li>
          <li class="nav-item m-3">
            <a tabindex="3" class="nav-link" href="#expérience">Expérience</a>
          </li>
          <li class="nav-item m-3">
            <a tabindex="4" class="nav-link " href="#formation">Formation</a>
          </li>
          <li class="nav-item m-3">
            <a tabindex="5" class="nav-link " href="#portfolio">Portfolio</a>
          </li>
          <li class="nav-item m-3">
            <a tabindex="6" class="nav-link " href="#recommendations">Recommendations</a>
          </li>
          <li class="nav-item m-3">
            <a tabindex="7" class="nav-link " href="#contact">Contactez-moi</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

<!--Section about me -->
  <section id="about" class="container-fluid p-5">
    <div class="row d-flex align-items-center justify-content-between m-5 p-5 content">
      <div class="col-md-6">
        <div class="heading">
          <h2>Bonjour, Je suis Latifa</h2>
          <h3>Développeur Web</h3>
        </div>
      </div>
      <div class="col-md-5 d-flex justify-content-center">
        <img src="img/ma-photo.jpg" alt="ma-photo" class="image">
      </div>
    </div>
  </section>

<!--Section Compétences -->
  <section id="skills" class="m-5 pb-3">
   <div class="heading py-2 mb-3">
    <h2>Compétences</h2>
   </div>
   <div class="container">
    <div class="row m-5">

      <div class="col-lg-6">
          <div class="progress m-4">
             <div class="progress-bar w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
             <h5 class="m-3">HTML 100%</h5>
             </div>
          </div>
          <div class="progress m-4">
             <div class="progress-bar w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
             <h5 class="m-3">CSS 100%</h5>
             </div>
          </div>
          <div class="progress m-4">
             <div class="progress-bar w-95" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">
             <h5 class="m-3">JAVASCRIPT 95%</h5>
             </div>
          </div>
      </div>

      <div class="col-lg-6">
         <div class="progress m-4">
            <div class="progress-bar w-80" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
              <h5 class="m-3">ANGULAR 80%</h5>
            </div>
         </div>
          <div class="progress m-4">
            <div class="progress-bar w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
            <h5 class="m-3">BOOTSRTAP 100%</h5>
            </div>
          </div>
          <div class="progress m-4">
            <div class="progress-bar w-85" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
              <h5 class="m-3">Symfony 85%</h5>
            </div>
          </div>
      </div>

     </div>
    </div>
   </section>

<!--Section Expérience-->
   <section id="expérience" class="py-4 px-3 m-5">
      <div class="heading py-2 mb-3">
         <h2>Expérience Professionnelle</h2>
      </div>

      </div>
          <div class="expérience-block p-3 m-5 deux-colonnes">

          <div class="clearfix">
            <figure class="col-md-4 float-md-start me-md-3">
              <img src="img/image-ide.jpg" class="img-fluid" alt="ide">
              <figcaption>Infirmière Diplomée d'Etat</figcaption>
            </figure>
            
            <p>
            Ayant acquis une solide expérience dans le domaine de la santé en tant qu’infirmière 
                diplômée d'État me conférant ainsi une vision unique et précieuse en tant que futur 
                développeur web.Je suis prête à mettre à profit mes compétences relationnelles, ma 
                capacité d'adaptation, ma rigueur et mon sens de l'organisation pour créer des 
                solutions technologiques innovantes et centrées sur les besoins des utilisateurs.
            </p>
            <p>
            Je suis enthousiaste à l'idée d'apporter une approche holistique à mes projets de 
                développement, en tirant parti des connaissances et des compétences acquises lors de
                mon expérience en tant que infirmière.
            </p>
          </div>
          <div class="clearfix">
            <figure class="col-md-4 float-md-end">
              <img src="img/image-dev-web.png" class="img-fluid" alt="développeur">
              <figcaption>Développeur</figcaption>
            </figure>
            
            <p>
            Je souhaite désormais orienter ma carrière vers le domaine du développement web, 
                une nouvelle passion que j'ai développée au cours de ma formation de Développeur 
                Web à l'ESECAD-GROUP SKILL&YOU .
                Au cours de cette formation, j'ai acquis des compétences en langages de programmation 
                tels que HTML, CSS, PHP et JavaScript.
                J'ai appris à créer des interfaces utilisateur attrayantes et fonctionnelles en utilisant 
                HTML pour la structure, CSS pour le style et JavaScript pour l’interactivité. Je suis 
                capable de développer des sites web responsives et d'assurer leur compatibilité avec 
                différents navigateurs et appareils, en utilisant également diférents framework tels que
                Bootstrap, Angular, Symfony.
                Grâce à ma formation, je suis en mesure de développer des interfaces utilisateur web 
                dynamiques, d'utiliser des CMS ou des plates-formes e-commerce, de gérer des bases
                de données. De plus, j'ai des connaissances en SEO et en gestion de projet web, ainsi 
                qu'une capacité à effectuer une veille technologique pour rester à jour avec les 
                dernières avancées du secteur.
            </p>
            <div class="d-flex align-items-center justify-content-center">
                <a href="doc/CvAl.pdf"  class="btn btn-danger">Télecharger cv</a>
              </div>
          </div>
        </div>  
  </section>

<!--Section Formation-->
    <section id="formation" class="py-5 m-5">
      <div class="heading py-2 mb-3">
       <h2>Formation</h2>
      </div>

      <div class="row row-cols-1 row-cols-md-3 g-5 p-5">
        <div class="col">
        <div class="card formation-block pt-3">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-award mx-auto" viewBox="0 0 16 16">
            <path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702 1.509.229z"/>
            <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/>
          </svg>
            <div class="card-body">
              <h5 class="card-title">1995-1998</h5>
              <div class="card-text">
                 <h3>Lycée Saint-Exupéry-Fameck</h3>
                 <h4>Baccalauréat Scientifique</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card formation-block pt-3">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-award mx-auto" viewBox="0 0 16 16">
            <path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702 1.509.229z"/>
            <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/>
          </svg>
            <div class="card-body">
              <h5 class="card-title">2000-2003</h5>
              <div class="card-text">
                <h3>IFSI Clérmont-de-l'Oise</h3>
                <h4>Infirmière Diplomée d'Etat</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card formation-block pt-3">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-award mx-auto" viewBox="0 0 16 16">
            <path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702 1.509.229z"/>
            <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/>
          </svg>
            <div class="card-body">
              <h5 class="card-title">2022-2024</h5>
              <div class="card-text">
                 <h3>ESECAD Skill and you</h3>
                 <h4>Formation Développeur Web</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<!--Section Portfolio -->
    <section id="portfolio" class="py-4 px-3 m-5">
        <div class="heading py-2 mb-3">
          <h2>portfolio</h2>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4 m-3">
          <div class="col">
            <div class="card h-100 text-center">
              <img src="img/jsexo1.png" class="card-img-top w-100 mt-5" alt="Interface projet">
              <div class="card-body">
                <h5 class="card-title">JS-se perfectionner- projet n°1</h5>
                <div class="d-flex justify-content-between">
                  <a href="./projects/JS02-01-267776-Attar-Latifa/NoteMusicJs/consigne/Se-perfectionner-en-javaScript-devoir1.pdf" 
                  class="button p-2">Consigne</a>
                  <a href="./projects/JS02-01-267776-Attar-Latifa/NoteMusicJs/index.html" class="button p-2">Mon projet</a>
                </div>
              
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100 text-center">
              <img src="img/jsex2.png" class="card-img-top w-100 mt-5" alt="Interface projet">
              <div class="card-body">
                <h5 class="card-title">JS-se perfectionner- projet n°2</h5>
                <div class="d-flex justify-content-between">
                  <a href="./projects/JS02-02-267776-Attar-Latifa/consigne/Se-perfectionner-en-javaScript-devoir2.pdf" class="button p-2">Consigne</a>
                  <a href="./projects/JS02-02-267776-Attar-Latifa/NoteMusicDemande1/index.php" class="button p-2">Mon projet</a>
                </div>   
              </div>
            </div>
          </div>
        
          <div class="col">
            <div class="card h-100 text-center">
              <img src="img/php1.png" class="card-img-top w-100" alt="Interface projet">
              <div class="card-body">
                <h5 class="card-title">PHP-expert-projet n°1</h5>
                <div class="d-flex justify-content-between">
                  <a href="./projects/PHP-ex-01-267776-Attar-Latifa/schoolPupilSport/consigne/php-expert-devoir1.pdf" 
                  class="button p-2">Consigne</a>
                  <a href="./projects/PHP-ex-01-267776-Attar-Latifa/schoolPupilSport/index.php" class="button p-2">Mon projet</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card h-100 text-center">
              <img src="img/phpex2.png" class="card-img-top w-100 p-3" alt="Interface projet">
              <div class="card-body">
                <h5 class="card-title">PHP-expert-projet n°2</h5>
                <div class="d-flex justify-content-between">
                  <a href="./projects/PHP-ex-02-267776-Attar-Latifa//ApplicationBooking/consigne/php-expert-devoir2.pdf" 
                  class="button p-2">Consigne</a>
                  <a href="./projects/PHP-ex-02-267776-Attar-Latifa/ApplicationBooking/index.php" class="button p-2">Mon projet</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card h-100 text-center">
              <img src="img/angular.png" class="card-img-top w-100 p-3" alt="Interface projet">
              <div class="card-body">
                <h5 class="card-title">Créer une application Angular</h5>
                <div class="d-flex justify-content-between">
                  <a href="./projects/myAngularApp/consigne/application-angular.pdf" class="button p-2">Consigne</a>
                  <a href="./projects/myAngularApp/src/app/app.component.html" class="button p-2">Mon projet</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card h-100 text-center">
              <img src="img/api-rest.png" class="card-img-top w-100 p-3" alt="Interface projet">
              <div class="card-body">
                <h5 class="card-title">Dévelloper une API</h5>
                <div class="d-flex justify-content-between">
                  <a href="./projects/recettes_api/consigne/developper-api.pdf" class="button p-2">Consigne</a>
                  <a href="./projects/recettes_api/index.php" class="button p-2">Mon projet</a>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>

<!--Section Recommandations -->
    <section id="recommendations" class="py-5 px-3 m-5">
        <div class="heading py-2 mb-3">
            <h2>recommandations</h2>
        </div>
        <div id="myCarousel" class="carousel carousel-light slide text-center p-5" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner w-50 mx-auto pt-2">
            <div class="carousel-item active" >
              <h3>"Bon Travail"</h3>
              <h4>Mon Formateur</h4>
            </div>
            <div class="carousel-item">
              <h3>"Excellent, continuer ainsi"</h3>
              <h4>Mon Formateur</h4>
            </div>
            <div class="carousel-item">
              <h3>"Bravo, site fonctionel et trés beau rendu"</h3>
              <h4>Mon Formateur</h4>
            </div>
          </div>
        </div>
      </section>

<!--Section Contact -->
      <section id="contact" class="p-5 m-5">
        <div class="heading py-2 mb-5">
          <h2>Contactez-moi</h2>
        </div>

        <div class="row">
          <div class="col-lg-8 mx-auto">
            <form id="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>#contact">

              <div class="row">
                <div class="col-md-6 p-3">
                  <label for="firstname">Prénom<span class="blue"> *</span> </label>
                  <input tabindex="8" name="firstname" id="firstname"  type="text" class="form-control" placeholder="Prénom" aria-label="Prénom" 
                  value="<?php echo $firstname; ?>">
                  <p class="comments mt-2"><?php echo $firstnameError; ?></p>
                </div>

                <div class="col-md-6 p-3">
                  <label for="name">Nom<span class="blue"> *</span> </label>
                  <input tabindex="9" name="name" id="name" type="text" class="form-control" autocomplete="family-name" placeholder="Nom de famille" aria-label="Nom de famille"
                  value="<?php echo $name; ?>">
                  <p class="comments mt-2"><?php echo $nameError; ?></p>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 p-3">
                      <div class="mb-3">
                          <label for="email" class="form-label">Address email<span class="blue"> *</span></label>
                          <input tabindex="10" name="email" id="email" type="email" autocomplete="off" class="form-control" placeholder="name@example.com" 
                          aria-label="Adresse mail" value="<?php echo $email; ?>">
                          <p class="comments mt-2"><?php echo $emailError; ?></p>
                      </div>
                </div>

                <div class="col-md-6 p-3">
                      <div class="mb-3">
                          <label for="phone" class="form-label">Télephone</label>
                          <input tabindex="11" name="phone" id="phone" type="tel" autocomplete="off" class="form-control" placeholder="télephone" aria-label="Télephone"
                          value="<?php echo $phone; ?>">
                          <p class="comments mt-2"><?php echo $phoneError; ?></p>
                      </div>
                </div>
              </div> 

              <div class="col-md-12">
                    <div class="mb-3">
                      <label for="message" class="form-label">Message<span class="blue"> *</label>
                      <textarea tabindex="12" class="form-control" id="message" name="message" rows="5" <?php echo $message; ?> ></textarea>
                      <p class="comments mt-2"><?php echo $messageError; ?></p>
                    </div>
              </div>

              <div class="col-md-12">
                      <p class="blue"><strong>* Ces informations sont requises</strong></p>
              </div>


              <div class="d-flex align-items-center justify-content-center p-2">
                     <button tabindex="13" type="submit" class="btn btn-danger px-5">Envoyer</button>
              </div>
              
              <p class="thank-you mt-3" style="display:<?php if($isSuccess) echo 'block'; else echo 'none';?>">Votre message a bien été envoyé. Merci d'avoir pris contact !</p>
            </form>
          </div>
        </div>
      </section>
      
<!--Footer-->
<footer class="text-center py-3">
      <a href="#about"><svg xmlns="http://www.w3.org/2000/svg" width="53" height="33" fill="currentColor" class="bi bi-chevron-bar-up" viewBox="0 0 16 16">
       <path fill-rule="evenodd" d="M3.646 11.854a.5.5 0 0 0 .708 0L8 8.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708zM2.4 5.2c0 .22.18.4.4.4h10.4a.4.4 0 0 0 0-.8H2.8a.4.4 0 0 0-.4.4z"/>
     </svg></a>
     <h5>Haut de la page</h5>
     <p class="copy">&copy; 2024-Latifa Attar</p>

<!--CDN JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</footer>
</body>
</html>