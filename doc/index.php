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
      $emailText .= "email: $email\n";

      if(!isPhone($phone)){
        $phoneError = 'Donnez moi votre numéro de télephone composé de chiffre et espace, s\'il vous plâit !';
        $isSuccess = false;
      }else
      $emailText .= "phone: $phone\n";

      if(empty($message)){
        $messageError = 'Laissez moi un message, s\'il vous plâit !';
        $isSuccess = false;
      }else
      $emailText .= "message: $message\n";

      if($isSuccess){
          $headers = "From: $firstname $name <$email>\r\nReply-To: $email";
          mail($emailTo, "Un message de votre site", $emailText, $headers);
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
  <!--css-->
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

<!--NavBar -->

  <nav id="myNavbar" class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container-fluid">
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
  <section id="about">
    <div class="container-fluid p-5">
      <div class="d-flex align-items-center justify-content-around p-5 my-4 content">
          <div class="heading p-2 me-2">
            <h2>Bonjour, Je suis Latifa</h2>
            <h3>Développeur Web</h3>
          </div>
          <div class="col-8 col-lg-2 image text-align-center">
            <img src="img/ma-photo.jpg" alt="ma-photo" class="img-fluid">
          </div>
      </div>
    </div>
  </section>
  

<!--Section Compétences -->
  <section id="skills" class="m-5 pb-3">
  <div class="divider black mx-auto mb-5"></div>
   <div class="heading py-2 mb-3">
    <h2>Compétences</h2>
   </div>

   <div class="container">
    <div class="row m-5">

      <div class="col-lg-6">
          <div class="progress mb-3">
             <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
             <h5>HTML 100%</h5>
             </div>
          </div>
          <div class="progress mb-3">
             <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
             <h5>CSS 100%</h5>
             </div>
          </div>
          <div class="progress mb-3">
             <div class="progress-bar" role="progressbar" style="width: 95%;" aria-valuenow="95" aria-valuemin="0" aria-valuemax="95">
             <h5 class="m-3">JAVASCRIPT 95%</h5>
             </div>
          </div>
      </div>

      <div class="col-lg-6">
          <div class="progress mb-3">
            <div class="progress-bar" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="80">
              <h5>ANGULAR 80%</h5>
            </div>
          </div>
          <div class="progress mb-3">
            <div class="progress-bar" role="progressbar" aria-valuenow="100" style="width: 100%;" aria-valuemin="0" aria-valuemax="100">
            <h5>BOOTSRTAP 100%</h5>
            </div>
          </div>
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="85">
              <h5>SYMFONY 85%</h5>
            </div>
          </div>
      </div>
     </div>
    </div>
   </section>
  

<!--Section Expérience-->
   <section id="expérience" class="p-5 my-3">
   <div class="divider mx-auto mb-5"></div>
    <div class="heading py-2 mb-5">
         <h2>Expérience Professionnelle</h2>
    </div>

 
      <ul class="timeline px-1 py-3">
        <li>
          <div class="timeline-badge"><span class="bi-briefcase-fill"></span></div>
          <div class="timeline-panel-container">
            <div class="timeline-panel">
              <div class="timeline-heading">
                <h4>Infirmière Diplomée d'Etat</h4>
                <p class="text-muted"><span class="bi-clock-fill"> 2003-2022</span></p>
              </div>
              <div class="timeline-body">
              <div class="clearfix">
                <figure class="col-md-4 float-md-start me-md-3">
                  <img src="img/image-ide.jpg" class="img-fluid" alt="ide">
                  <figcaption>Infirmière Diplomée d'Etat</figcaption>
                </figure>
                <p>Ayant acquis une solide expérience dans le domaine de la santé en tant qu’infirmière 
                diplômée d'État me conférant ainsi une vision unique et précieuse en tant que futur 
                développeur web.Je suis prête à mettre à profit mes compétences relationnelles, ma 
                capacité d'adaptation, ma rigueur et mon sens de l'organisation pour créer des 
                solutions technologiques innovantes et centrées sur les besoins des utilisateurs.</p>
                <p>Je suis enthousiaste à l'idée d'apporter une approche holistique à mes projets de 
                développement, en tirant parti des connaissances et des compétences acquises lors de
                mon expérience en tant que infirmière.</p>
              </div>
              </div>
            </div>
          </div>
        </li>
        
        <li>
          <div class="timeline-badge"><span class="bi-briefcase-fill"></span></div>
            <div class="timeline-panel-container-inverted">
              <div class="timeline-panel">
                <div class="timeline-heading">
                  <h4>Développeur Web</h4>
                  <p class="text-muted"><span class="bi-clock-fill"> 2022-2024</span></p>
                </div>
                <div class="timeline-body">
                <div class="clearfix">
                  <figure class="col-md-4 float-md-end ms-md-3">
                    <img src="img/image-dev-web.png" class="img-fluid" alt="développeur">
                    <figcaption>Développeur Web</figcaption>
                  </figure>
                  <p>Je souhaite désormais orienter ma carrière vers le domaine du développement web, 
                  une nouvelle passion que j'ai développée au cours de ma formation de Développeur 
                  Web à l'ESECAD-GROUP SKILL&YOU .
                  Au cours de cette formation, j'ai acquis des compétences en langages de programmation 
                  tels que HTML, CSS, PHP et JavaScript.
                  J'ai appris à créer des interfaces utilisateur attrayantes et fonctionnelles en utilisant 
                  HTML pour la structure, CSS pour le style et JavaScript pour l’interactivité. Je suis 
                  capable de développer des sites web responsives et d'assurer leur compatibilité avec 
                  différents navigateurs et appareils, en utilisant également diférents framework tels que
                  Bootstrap, Angular, Symfony.</p>
                  <p> Grâce à ma formation, je suis en mesure de développer des interfaces utilisateur web 
                  dynamiques, d'utiliser des CMS ou des plates-formes e-commerce, de gérer des bases
                  de données. De plus, j'ai des connaissances en SEO et en gestion de projet web, ainsi 
                  qu'une capacité à effectuer une veille technologique pour rester à jour avec les 
                  dernières avancées du secteur.</p>
                </div>
                </div>
              </div>
            </div>
          </li>
        </ul>
        <div class="d-flex align-items-center justify-content-center">
           <a tabindex="8" href="doc/CvAl.pdf"  class="button p-3">Télecharger cv</a>
        </div> 

  </section>
  
  
<!--Section Formation-->
  <section id="formation" class="py-5 m-5">
  <div class="divider black mx-auto mb-5"></div>
      <div class="heading py-2 mb-3">
       <h2>Formation</h2>
      </div>

      <div class="row row-cols-1 row-cols-md-3 g-5 p-5">
        <div class="col">
        <div class="card h-100 formation-block pt-3">
        <div class="badge"><span class="bi bi-award mx-auto"></span></div>
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
          <div class="card h-100 formation-block pt-3">
          <div class="badge"><span class="bi bi-award mx-auto"></span></div>
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
          <div class="card h-100 formation-block pt-3">
            <div class="badge"><span class="bi bi-award mx-auto"></span></div>
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
    <section id="portfolio" class="p-5 my-3">
    <div class="divider mx-auto mb-5"></div>
        <div class="heading py-2 mb-5">
          <h2>portfolio</h2>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4 m-3 px-5 py-3 projet">
          <div class="col">
            <div class="card h-100 text-center">
              <img src="img/jsexo1.png" class="card-img-top w-100 mt-5" alt="Interface projet">
              <div class="card-body">
                <h5 class="card-title">JS-se perfectionner- projet n°1</h5>
                <div class="d-flex justify-content-around flex-wrap">
                  <a tabindex="9" href="./doc/consigne/Se perfectionner en javaScript-devoir1.pdf" class="button p-2 mb-2">Consigne</a>
                  <a tabindex="10" href="" class="button p-2 mb-2">Mon projet</a>
                </div>
              
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100 text-center">
              <img src="img/jsex2.png" class="card-img-top w-100 mt-5" alt="Interface projet">
              <div class="card-body">
                <h5 class="card-title">JS-se perfectionner- projet n°2</h5>
                <div class="d-flex justify-content-around flex-wrap">
                  <a tabindex="11" href="./doc/consigne/Se-perfectionner-en-javaScript-devoir2.pdf" class="button p-2 mb-2">Consigne</a>
                  <a tabindex="12" href="" class="button p-2 mb-2">Mon projet</a>
                </div>   
              </div>
            </div>
          </div>
        
          <div class="col">
            <div class="card h-100 text-center">
              <img src="img/php1.png" class="card-img-top w-100" alt="Interface projet">
              <div class="card-body">
                <h5 class="card-title">PHP-expert-projet n°1</h5>
                <div class="d-flex justify-content-around flex-wrap">
                  <a tabindex="13" href="./doc/consigne/php-expert-devoir1.pdf" class="button p-2 mb-2">Consigne</a>
                  <a tabindex="14" href="" class="button p-2 mb-2">Mon projet</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card h-100 text-center">
              <img src="img/phpex2.png" class="card-img-top w-100 p-3" alt="Interface projet">
              <div class="card-body">
                <h5 class="card-title">PHP-expert-projet n°2</h5>
                <div class="d-flex justify-content-around flex-wrap">
                  <a tabindex="15" href="./doc/consigne/php-expert-devoir2.pdf" class="button p-2 mb-2">Consigne</a>
                  <a tabindex="16" href="" class="button p-2 mb-2">Mon projet</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card h-100 text-center">
              <img src="img/angular.png" class="card-img-top w-100 p-3" alt="Interface projet">
              <div class="card-body">
                <h5 class="card-title">Créer une application Angular</h5>
                <div class="d-flex justify-content-around flex-wrap">
                  <a tabindex="17" href="./doc/consigne/application-angular.pdf" class="button p-2 mb-2">Consigne</a>
                  <a tabindex="18" href="" class="button p-2 mb-2">Mon projet</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card h-100 text-center">
              <img src="img/api-rest.png" class="card-img-top w-100 p-3" alt="Interface projet">
              <div class="card-body">
                <h5 class="card-title">Dévelloper une API</h5>
                <div class="d-flex justify-content-around flex-wrap">
                  <a tabindex="19" href="./doc/consigne/developper-api.pdf" class="button p-2 mb-2">Consigne</a>
                  <a tabindex="20" href="" class="button p-2 mb-2">Mon projet</a>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
    

<!--Section Recommandations -->
    <section id="recommendations" class="py-5 px-3 m-5">
    <div class="divider black mx-auto mb-5"></div>
        <div class="heading py-2 mb-3">
            <h2>recommandations</h2>
        </div>
        <div id="myCarousel" class="carousel carousel-light slide text-center p-5" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="col-10 col-lg-4 mx-auto">
            <div class="carousel-inner">
              <div class="carousel-item active pt-2" >
                <h3>"Bon Travail"</h3>
                <h4>Mon Formateur</h4>
              </div>
              <div class="carousel-item pt-2">
                <h3>"Excellent, continuer ainsi"</h3>
                <h4>Mon Formateur</h4>
              </div>
              <div class="carousel-item pt-2">
                <h3>"Bravo, site fonctionel et trés beau rendu"</h3>
                <h4>Mon Formateur</h4>
              </div>
            </div>
          </div>
        </div>
      </section>
      

<!--Section Contact -->
      <section id="contact" class="p-5 m-5">
      <div class="divider mx-auto mb-5"></div>
        <div class="heading py-2 mb-5">
          <h2>Contactez-moi</h2>
        </div>

        <div class="row">
          <div class="col-lg-8 mx-auto">
            <form id="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>#contact">

              <div class="row">
                <div class="col-md-6 p-3">
                  <label for="firstname">Prénom<span class="blue"> *</span> </label>
                  <input tabindex="21" name="firstname" id="firstname"  type="text" class="form-control" placeholder="Prénom" aria-label="Prénom" 
                  value="<?php echo $firstname; ?>">
                  <p class="comments mt-2"><?php echo $firstnameError; ?></p>
                </div>

                <div class="col-md-6 p-3">
                  <label for="name">Nom<span class="blue"> *</span> </label>
                  <input tabindex="22" name="name" id="name" type="text" class="form-control" autocomplete="family-name" placeholder="Nom de famille" aria-label="Nom de famille"
                  value="<?php echo $name; ?>">
                  <p class="comments mt-2"><?php echo $nameError; ?></p>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 p-3">
                      <div class="mb-3">
                          <label for="email" class="form-label">Address email<span class="blue"> *</span></label>
                          <input tabindex="23" name="email" id="email" type="email" autocomplete="off" class="form-control" placeholder="name@example.com" 
                          aria-label="Adresse mail" value="<?php echo $email; ?>">
                          <p class="comments mt-2"><?php echo $emailError; ?></p>
                      </div>
                </div>

                <div class="col-md-6 p-3">
                      <div class="mb-3">
                          <label for="phone" class="form-label">Télephone</label>
                          <input tabindex="24" name="phone" id="phone" type="tel" autocomplete="off" class="form-control" placeholder="télephone" aria-label="Télephone"
                          value="<?php echo $phone; ?>">
                          <p class="comments mt-2"><?php echo $phoneError; ?></p>
                      </div>
                </div>
              </div> 

              <div class="col-md-12">
                    <div class="mb-3">
                      <label for="message" class="form-label">Message<span class="blue"> *</label>
                      <textarea tabindex="25" class="form-control" id="message" name="message" rows="5" <?php echo $message; ?> ></textarea>
                      <p class="comments mt-2"><?php echo $messageError; ?></p>
                    </div>
              </div>

              <div class="col-md-12">
                      <p class="blue"><strong>* Ces informations sont requises</strong></p>
              </div>

              <div class="d-flex align-items-center justify-content-center p-2">
                     <button tabindex="26" type="submit" class="button py-3 px-5">Envoyer</button>
              </div>
              
              <p class="thank-you mt-3" style="display:<?php if($isSuccess) echo 'block'; else echo 'none';?>">Votre message a bien été envoyé. Merci d'avoir pris contact !</p>
            </form>
          </div>
        </div>
      </section>
      
<!--Footer-->
<footer class="text-center py-3">
      <a tabindex="27" href="#about">
        <span class="bi bi-chevron-double-up p-1"></span></a>
     <h5 class="mt-3">Haut de la page</h5>
     <p class="copy">&copy; 2024-Latifa Attar</p>

<!--CDN JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</footer>
</body>
</html>