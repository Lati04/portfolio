<?php
   $firstname = $name = $email = $phone = $message = "";
   $firstnameError = $nameError = $emailError = $phoneError = $messageError = "";
   $isSuccess = false;
   $emailTo = "nefer_titi.57@hotmail.fr";

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
       $emailText = "";

      if(empty($firstname)){
          $firstnameError = "Donnez moi votre prénom, s\'il vous plâit !";
          $isSuccess = false;
      }else
        $emailText .= "Prénom: $firstname\n";
      

      if(empty($name)){
        $nameError = "Donnez moi votre nom, s\'il vous plâit !";
        $isSuccess = false;
      }else{
        $emailText .= "Nom: $name\n";
      }
      
 
      if(!isEmail($email)){
        $emailError = "Donnez moi un email correct, s\'il vous plâit !";
        $isSuccess = false;
      }else{
        $emailText .= "email: $email\n";
      }
      

      if(!isPhone($phone)){
        $phoneError = "Donnez moi votre numéro de télephone composé de chiffre et espace, s\'il vous plâit !";
        $isSuccess = false;
      }else{
        $emailText .= "Télephone: $phone\n";
      }
    
      if(empty($message)){
        $messageError = "Laissez moi un message, s'il vous plâit !";
        $isSuccess = false;
      }else{
        $emailText .= "message: $message\n";
      }
      

      if($isSuccess){
          $headers = "From:  $firstname $name <$email>\r\nReply-To: $email";
          $headers .= "Content-Type: text/plain; charset=utf-8\r\n";
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />


  <!--css-->
  <link rel="stylesheet" href="css/style.css">

</head>

<body>

<!--NavBar -->

  <nav id="myNavbar" class="navbar navbar-expand-lg sticky-top">
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
            <a tabindex="3" class="nav-link" href="#experience">Expérience</a>
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

  <section id="about" class="sparkle-bg">
  <div class="container-fluid py-5">
    <div class="row align-items-center justify-content-around p-5 m-4 content box">

      <!-- Colonne photo -->
      <div class="col-md-6 col-12 image text-center mb-4 mb-md-0">
        <img src="img/AttarLatifa_Photo.JPG" alt="ma-photo" class="img-fluid mx-auto d-block" style="max-width: 300px;">
      </div>

      <!-- Colonne texte -->
      <div class="col-md-6 col-12 heading text-center">
        <h2>
          <span class="word">Bonjour,</span>
          <span class="word">Je</span>
          <span class="word">suis</span>
          <span class="word">Latifa</span>
        </h2>
        <h3>
          <span class="word">Développeuse</span>
          <span class="word">Web</span>
          <span class="word">et</span>
          <span class="word">web</span>
          <span class="word">mobile</span>
          <span class="word">junior</span>
        </h3>

        <p class="about-intro hidden-on-load mt-4 px-2">
          Reconversion assumée, passion revendiquée. Ce qui ne change pas ? Mon envie d’apprendre, d’agir, de créer et de bien faire.
          <br>
          Curieux·se d’en savoir plus ? Je vous emmène avec moi.
        </p>

        <!-- Flèche vers le bas -->
        <div class="scroll-down-arrow hidden-on-load mt-3" id="scrollArrow">
          <a href="#skills">
            <i class="fa-solid fa-circle-down fa-2x"></i>
          </a>
        </div>
      </div>

    </div>
  </div>
</section>

<div class="section-divider">
  <svg viewBox="0 0 1440 100" preserveAspectRatio="none">
    <path d="M0,0 C480,100 960,0 1440,100 L1440,0 L0,0 Z" fill="#89a88f"></path>
  </svg>
</div>


<!--Section Compétences -->
<section id="skills" class="p-5">
  <div class="divider black mx-auto mb-5"></div>
  <div class="heading py-2 mb-5">
    <h2>Compétences</h2>
  </div>

  <div class="row row-cols-1 row-cols-md-3 g-5 py-2">
      <!-- Gauche : barres de compétences -->
      <div class="col">
        <div class="progress mb-3">
          <div class="progress-bar skill-bar" role="progressbar" data-skill="100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
            <h6>HTML 100%</h6>
          </div>
        </div>
        <div class="progress mb-3">
          <div class="progress-bar skill-bar" role="progressbar" data-skill="100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
            <h6>CSS 100%</h6>
          </div>
        </div>
        <div class="progress mb-3">
          <div class="progress-bar skill-bar" role="progressbar" data-skill="90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
            <h6>JAVASCRIPT 90%</h6>
          </div>
        </div>
        <div class="progress mb-3">
          <div class="progress-bar skill-bar" role="progressbar" data-skill="80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
            <h6>PYTHON 80%</h6>
          </div>
        </div>
        <div class="progress mb-3">
          <div class="progress-bar skill-bar" role="progressbar" data-skill="80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
            <h6>ANGULAR 80%</h6>
          </div>
        </div>
        <div class="progress mb-3">
          <div class="progress-bar skill-bar" role="progressbar" data-skill="90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
            <h6>BOOTSTRAP 90%</h6>
          </div>
        </div>
        <div class="progress mb-3">
          <div class="progress-bar skill-bar" role="progressbar" data-skill="80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
            <h6>SYMFONY 80%</h6>
          </div>
        </div>
        <div class="progress mb-3">
          <div class="progress-bar skill-bar" role="progressbar" data-skill="80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
            <h6>REACT NATIVE 80%</h6>
          </div>
        </div>
      </div>

     <!-- Colonne 2 : Hard Skills -->
<div class="col">
  <div class="row row-cols-1 g-3">
    <div class="col skills-item hidden-on-load">
      <div class="card h-80 p-1">
        <h5 class="card-title">Base de données & API</h5>
        <ul class="card-text">
          <li>MySQL, Prisma</li>
          <li>REST, GraphQL</li>
        </ul>
      </div>
    </div>
    <div class="col skills-item hidden-on-load">
      <div class="card h-80 p-1">
        <h5 class="card-title">Outils de développement</h5>
        <ul class="card-text">
          <li>GitHub, Jira</li>
          <li>VS Code, WebStorm</li>
          <li>Docker, WordPress</li>
        </ul>
      </div>
    </div>
    <div class="col skills-item hidden-on-load">
      <div class="card h-80 p-1">
        <h5 class="card-title">Design & UX/UI</h5>
        <ul class="card-text">
          <li>Figma (prototypage interactif)</li>
          <li>Intégration responsive, accessibilité numérique</li>
        </ul>
      </div>
    </div>
    <div class="col skills-item hidden-on-load">
      <div class="card h-80 p-1">
        <h5 class="card-title">Méthodes & qualité</h5>
        <ul class="card-text">
          <li>SEO, sécurité, veille technologique</li>
          <li>Documentation projet, méthodes agiles</li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Colonne 3 : Soft Skills -->
<div class="col">
  <div class="row row-cols-1 g-3">
    <div class="col skills-item hidden-on-load">
      <div class="card h-80 p-1">
        <h5 class="card-title">Leadership naturel</h5>
        <p class="card-text">Coordination d’équipes pendant la crise COVID, continuité des soins assurée.</p>
      </div>
    </div>
    <div class="col skills-item hidden-on-load">
      <div class="card h-80 p-1">
        <h5 class="card-title">Résolution de problèmes</h5>
        <p class="card-text">Débogage structuré, soutien technique aux stagiaires.</p>
      </div>
    </div>
    <div class="col skills-item hidden-on-load">
      <div class="card h-80 p-1">
        <h5 class="card-title">Force de proposition & agilité</h5>
        <p class="card-text">Refonte UX/UI proactive pour améliorer les maquettes.</p>
      </div>
    </div>
    <div class="col skills-item hidden-on-load">
      <div class="card h-80 p-1">
        <h5 class="card-title">Apprentissage & réactivité</h5>
        <p class="card-text">Montée en compétence rapide sur React, GraphQL, livrables à chaque sprint.</p>
      </div>
    </div>
    <div class="col skills-item hidden-on-load">
      <div class="card h-80 p-1">
        <h5 class="card-title">Intelligence collective</h5>
        <p class="card-text">Scrum, dailys, sprint reviews, reporting quotidien.</p>
      </div>
    </div>
  </div>
</div>
  </div>
</section>

<div class="section-divider">
  <svg viewBox="0 0 1440 100" preserveAspectRatio="none">
    <path d="M0,0 C480,100 960,0 1440,100 L1440,0 L0,0 Z" fill="#89a88f"></path>
  </svg>
</div>

<!--Section experience-->
<section id="experience" class="p-5">
  <div class="divider mx-auto mb-5"></div>
  <div class="heading py-2 mb-5">
    <h2>Expérience Professionnelle</h2>
  </div>

  <ul class="timeline px-1 py-3">
    <!-- Développeuse Full Stack -->
    <li>
      <div class="timeline-badge"><span class="bi-briefcase-fill"></span></div>
      <div class="timeline-panel-container">
        <div class="timeline-panel">
          <div class="timeline-heading text-center">
            <h4>Développeuse Full Stack Web & Mobile</h4>
            <h5>HDM Network (Bruxelles)</h5>
            <p class="text-muted"><span class="bi-clock-fill"> Fév. – Mai 2024 (stage) + bénévolat 6 mois</span></p>
          </div>
          <div class="timeline-body">
            <div class="row align-items-start g-3">
              <div class="col-md-3 text-center">
                <figure>
                  <img src="img/studee.jpg" class="img-fluid" style="max-height: 200px; object-fit: cover;" alt="développeur">
                  <figcaption>Projet Studee</figcaption>
                </figure>
              </div>
              <div class="col-md-9">
                <ul class="list-unstyled mb-0">
                  <li class="timeline-item hidden-on-load"><h6>App mobile stages & alternances</h6></li>
                  <li class="timeline-item hidden-on-load"><strong>Gestion de projet Agile :</strong> 5 sprints pilotés avec le pôle IT (Scrum, Jira, GitHub).</li>
                  <li class="timeline-item hidden-on-load"><strong>Développement front-end :</strong> React Native, TypeScript, navigation fluide multi-profils, logique métier robuste à partir de maquettes Figma.</li>
                  <li class="timeline-item hidden-on-load"><strong>Back-end industrialisé :</strong> NestJS, Prisma, GraphQL, MySQL, conteneurisation avec Docker.</li>
                  <li class="timeline-item hidden-on-load"><strong>Livraison validée :</strong> App testée sous Expo Go & Android Studio, validée par le client interne (qualité, autonomie, professionnalisme).</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </li>

    <!-- Infirmière diplômée d'État -->
    <li>
      <div class="timeline-badge"><span class="bi-briefcase-fill"></span></div>
      <div class="timeline-panel-container-inverted">
        <div class="timeline-panel">
          <div class="timeline-heading text-center">
            <h4>Infirmière diplômée d’État</h4>
            <h5>Hôpital, domicile, médico-social</h5>
            <p class="text-muted"><span class="bi-clock-fill"> 2003 – 2022</span></p>
          </div>
          <div class="timeline-body">
            <div class="row align-items-start g-3">
              <div class="col-md-3 text-center">
                <figure>
                  <img src="img/ideimg.jpg" class="img-fluid" style="max-width: 120px; object-fit: cover;" alt="ide">
                  <figcaption>Profession paramédicale</figcaption>
                </figure>
              </div>
              <div class="col-md-9">
                <ul class="list-unstyled mb-0">
                  <li class="timeline-item hidden-on-load"><strong>Qualité & accréditation :</strong> Conduite de 20+ audits ISO 15189 sans non-conformité, amélioration continue validée.</li>
                  <li class="timeline-item hidden-on-load"><strong>Encadrement & transmission :</strong> Tutorat de 100+ stagiaires infirmiers (100% réussite), formation de 30 collaborateurs aux normes ISO.</li>
                  <li class="timeline-item hidden-on-load"><strong>Compétences transférables :</strong> gestion de projet, communication bienveillante, rigueur et sens de l'utilisateur.</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </li>
  </ul>

  <div class="d-flex align-items-center justify-content-center mt-4">
    <a tabindex="8" href="doc/dwwm_cv_AttarLatifa.pdf" class="button p-3">Télécharger le CV</a>
  </div>
</section>

<div class="section-divider">
  <svg viewBox="0 0 1440 100" preserveAspectRatio="none">
    <path d="M0,0 C480,100 960,0 1440,100 L1440,0 L0,0 Z" fill="#89a88f"></path>
  </svg>
</div>
  
<!--Section Formation-->
  <section id="formation" class="p-5">
  <div class="divider black mx-auto mb-5"></div>
      <div class="heading py-2 mb-5">
       <h2>Formation</h2>
      </div>

      <div class="row row-cols-1 row-cols-md-3 g-5 py-3">
      <div class="col formation-item hidden-on-load">
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
        <div class="col formation-item hidden-on-load">
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
        <div class="col formation-item hidden-on-load">
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
   
    <div class="section-divider">
  <svg viewBox="0 0 1440 100" preserveAspectRatio="none">
    <path d="M0,0 C480,100 960,0 1440,100 L1440,0 L0,0 Z" fill="#89a88f"></path>
  </svg>
</div>

<!--Section Portfolio -->
    <section id="portfolio" class="sparkle-bg p-5">
    <div class="divider mx-auto mb-5"></div>
        <div class="heading py-2 mb-5">
          <h2>portfolio</h2>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-5 mx-3 projet">
        <div class="col portfolio-item hidden-on-load">
            <div class="card h-100 text-center">
              <img src="img/jsexo1.png" class="card-img-top w-100 p-3" alt="Interface projet">
              <div class="card-body">
                <h5 class="card-title">JS-se perfectionner- projet n°1</h5>
                <div class="d-flex justify-content-around flex-wrap">
                  <a tabindex="9" href="./doc/consigne/Se-perfectionner-en-javaScript-devoir2.pdf" class="button p-2 mb-2">Consigne</a>
                  <a tabindex="10" href="https://portfoliolati.byethost14.com/projets/js1/" target="_blank" class="button p-2 mb-2">Mon projet</a>
                </div>
   
              </div>
            </div>
          </div>
          <div class="col portfolio-item hidden-on-load">
            <div class="card h-100 text-center">
              <img src="img/jsex2.png" class="card-img-top w-100 p-3" alt="Interface projet">
              <div class="card-body">
                <h5 class="card-title">JS-se perfectionner- projet n°2</h5>
                <div class="d-flex justify-content-around flex-wrap">
                  <a tabindex="11" href="./doc/consigne/Se-perfectionner-en-javaScript-devoir2.pdf" class="button p-2 mb-2">Consigne</a>
                  <a tabindex="12" href=https://portfoliolati.byethost14.com/projets/js2/ target="_blank" class="button p-2 mb-2">Mon projet</a>
                </div>   
              </div>
            </div>
          </div>
        
          <div class="col portfolio-item hidden-on-load">
            <div class="card h-100 text-center">
              <img src="img/php1.png" class="card-img-top w-100 px-3" alt="Interface projet">
              <div class="card-body"> 
                <h5 class="card-title">PHP-expert-projet n°1</h5>
                <div class="d-flex justify-content-around flex-wrap">
                  <a tabindex="13" href="./doc/consigne/php-expert-devoir1.pdf" class="button p-2 mb-2">Consigne</a>
                  <a tabindex="14" href="https://portfoliolati.byethost14.com/projets/php1/" target="_blank" class="button p-2 mb-2">Mon projet</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col portfolio-item hidden-on-load">
            <div class="card h-100 text-center">
              <img src="img/phpex2.png" class="card-img-top w-100 p-3" alt="Interface projet">
              <div class="card-body">
                <h5 class="card-title">PHP-expert-projet n°2</h5>
                <div class="d-flex justify-content-around flex-wrap">
                  <a tabindex="15" href="./doc/consigne/php-expert-devoir2.pdf" class="button p-2 mb-2">Consigne</a>
                  <a tabindex="16" href="https://portfoliolati.byethost14.com/projets/php2/"  target="_blank" class="button p-2 mb-2">Mon projet</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col portfolio-item hidden-on-load">
            <div class="card h-100 text-center">
              <img src="img/angular.png" class="card-img-top w-100 p-3" alt="Interface projet">
              <div class="card-body">
                <h5 class="card-title">Créer une application Angular</h5>
                <div class="d-flex justify-content-around flex-wrap">
                  <a tabindex="17" href="./doc/consigne/application-angular.pdf" class="button p-2 mb-2">Consigne</a>
                  <a tabindex="18" href="https://portfoliolati.byethost14.com/projets/angular/"  target="_blank" class="button p-2 mb-2">Mon projet</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col portfolio-item hidden-on-load">
            <div class="card h-100 text-center">
              <img src="img/api-rest.png" class="card-img-top w-100 p-3" alt="Interface projet">
              <div class="card-body">
                <h5 class="card-title">Dévelloper une API</h5>
                <div class="d-flex justify-content-around flex-wrap">
                  <a tabindex="19" href="./doc/consigne/developper-api.pdf" target="_blank" class="button p-2 mb-2">Consigne</a>
                  <a tabindex="20" href="https://portfoliolati.byethost14.com/projets/api/"  class="button p-2 mb-2">Mon projet</a>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
 
  <div class="section-divider">
  <svg viewBox="0 0 1440 100" preserveAspectRatio="none">
    <path d="M0,0 C480,100 960,0 1440,100 L1440,0 L0,0 Z" fill="#89a88f"></path>
  </svg>
  </div>

<!-- Section Références & Recommandations -->
<section id="recommendations" class="p-5">
  <div class="divider black mx-auto mb-5"></div>
  <div class="heading py-2 mb-5">
    <h2 class="text-center">Références & Recommandations</h2>
  </div>

  <div id="myCarousel" class="carousel carousel-light slide" data-bs-ride="carousel" data-bs-interval="4000">
    <!-- Indicateurs -->
    <div class="carousel-indicators d-none">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"></button>
    </div>

    <!-- Contenu du carrousel -->
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg- text-center">
          <div class="carousel-inner">

            <!-- Slide 1 - Intro -->
            <div class="carousel-item active pt-2">
              <h3>Mes références</h3>
              <p>Retrouvez ici mon relevé de notes officiel ainsi qu'une lettre de recommandation provenant de mon stage.</p>
            </div>

            <!-- Slide 2 - Relevé de notes -->
            <div class="carousel-item pt-2">
              <h3>📄 Relevé de notes</h3>
              <p>Validation complète de ma formation en développement web.</p>
              <a href="doc/Releve_de_notes_-_267776-0.pdf" target="_blank" class="btn btn-pdf m-3">
                📥 Consulter le PDF
              </a>
            </div>

            <!-- Slide 3 - Lettre de recommandation -->
            <div class="carousel-item pt-2">
              <h3>📝 Lettre de recommandation</h3>
              <p>Retour positif de mon tuteur de stage sur mon implication et mes compétences.</p>
              <a href="doc/Lettre recommandation Webdev - Latifa ATTAR (1).pdf" target="_blank" class="btn btn-pdf m-3">
                📥 Lire la lettre
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
 
<div class="section-divider">
  <svg viewBox="0 0 1440 100" preserveAspectRatio="none">
    <path d="M0,0 C480,100 960,0 1440,100 L1440,0 L0,0 Z" fill="#89a88f"></path>
  </svg>
</div>

<!--Section Contact -->
      <section id="contact" class="p-5">
      <div class="divider black mx-auto mb-5"></div>
      <div class="heading py-2 mb-5">
          <h2>Contactez-moi</h2>
        </div>

        <div class="row">
          <div class="col-lg-8 mx-auto">
            <form id="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>#contact">

              <div class="row px-4 mt-3">
                <div class="col-md-6">
                  <label for="firstname">Prénom<span class="blue"> *</span> </label>
                  <input tabindex="8" name="firstname" id="firstname"  type="text" class="form-control" placeholder="Prénom" aria-label="Prénom" 
                  value="<?php echo $firstname; ?>">
                  <p class="comments mt-2"><?php echo $firstnameError; ?></p>
                </div>

                <div class="col-md-6">
                  <label for="name">Nom<span class="blue"> *</span> </label>
                  <input tabindex="9" name="name" id="name" type="text" class="form-control" autocomplete="family-name" placeholder="Nom de famille" aria-label="Nom de famille"
                  value="<?php echo $name; ?>">
                  <p class="comments mt-2"><?php echo $nameError; ?></p>
                </div>
              </div>

              <div class="row px-4">
                <div class="col-md-6">
                  <label for="email" class="form-label">Address email<span class="blue"> *</span></label>
                  <input tabindex="10" name="email" id="email" type="email" autocomplete="off" class="form-control" placeholder="name@example.com" 
                  aria-label="Adresse mail" value="<?php echo $email; ?>">
                  <p class="comments mt-2"><?php echo $emailError; ?></p>
                </div>

                <div class="col-md-6">
                  <label for="phone" class="form-label">Télephone</label>
                  <input tabindex="11" name="phone" id="phone" type="tel" autocomplete="off" class="form-control" placeholder="télephone" aria-label="Télephone"
                  value="<?php echo $phone; ?>">
                  <p class="comments mt-2"><?php echo $phoneError; ?></p>
                </div>
              </div> 

              <div class="col-md-12 px-4">
                      <label for="message" class="form-label">Message<span class="blue"> *</label>
                      <textarea tabindex="12" class="form-control" id="message" name="message" rows="5" <?php echo $message; ?> ></textarea>
                      <p class="comments mt-2"><?php echo $messageError; ?></p>
              </div>

              <div class="col-md-12 px-4">
                      <p class="blue"><strong>* Ces informations sont requises</strong></p>
              </div>


              <div class="d-flex align-items-center justify-content-center p-2">
                     <button tabindex="13" type="submit" class="btn btn-success px-5">Envoyer</button>
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
</footer>

<!--CDN JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/animations.js"></script>

</body>
</html>