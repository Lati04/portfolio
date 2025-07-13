<?php
session_start();

// Récupération des données précédentes si elles existent
$inputs = $_SESSION['inputs'] ?? [
    'prenom'    => '',
    'nom'       => '',
    'email'     => '',
    'telephone' => '',
    'message'   => '',
];

$errors = $_SESSION['errors'] ?? [
    'firstnameError' => '',
    'nameError'      => '',
    'emailError'     => '',
    'phoneError'     => '',
    'messageError'   => '',
];

// Pour n'afficher les messages (succès/échec) que juste après soumission
$justSubmitted = isset($_SESSION['submitted']);
unset($_SESSION['inputs'], $_SESSION['errors'], $_SESSION['submitted']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Latifa Attar | Développeuse Web et Web mobile Full Stack - Portfolio</title>
  <meta name="description" content="Portfolio de Latifa Attar, développeuse web full stack. Découvrez mes projets en JavaScript, PHP, Angular, Flask, ainsi que mes recommandations.">
  <meta name="keywords" content="Latifa Attar, développeuse web, portfolio, JavaScript, PHP, Angular, Flask, projets web, DWWM, HTML, CSS,React, React Native, GrapQL, TypeScript">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Open Graph -->
  <meta property="og:title" content="Portfolio Développeuse Web - Latifa Attar">
  <meta property="og:description" content="Découvrez les projets, compétences et recommandations de Latifa Attar, développeuse web full stack.">
  <meta property="og:url" content="https://portfoliolati.byethost14.com/">
  <meta property="og:type" content="website">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Portfolio Développeuse Web - Latifa Attar">
  <meta name="twitter:description" content="Découvrez mes projets en JavaScript, PHP, Angular et Flask.">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="img/favicon.png">

  <!-- Bootstrap / Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Ton style -->
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
            <a tabindex="6" class="nav-link " href="#recommendations">Recommandation</a>
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
    <canvas id="networkCanvas"></canvas>

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
        <div class="scroll-down-arrow hidden-on-load mt-5" id="scrollArrow">
          <a tabindex="8" href="#skills" aria-label="Aller à la section compétences">
            <i class="fa-solid fa-circle-down fa-2x" aria-hidden="true"></i>
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
<section id="skills" class="px-5 pb-5">
  <div class="heading py-2 mb-5">
    <h2>Compétences</h2>
  </div>

  <div class="row row-cols-1 row-cols-md-3 g-5 pt-2">
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
<section id="experience" class="px-5 pb-5">
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
                  <li class="timeline-item hidden-on-load">
                    <strong>🎥 Présentation Sprint  :</strong>
                    <a tabindex="9" href="https://www.youtube.com/watch?v=NDXdAtQVaKE" target="_blank" rel="noopener noreferrer" class="lien">
                      Voir la vidéo sur YouTube
                    </a>
                  </li>
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
                <figure class="ide">
                  <img src="img/ideimg.jpg" class="img-fluid" alt="ide">
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
    <a tabindex="10" href="doc/dwwm_cv_AttarLatifa.pdf" target="_blank" class="btn btn-pdf m-3">
      <i class="fas fa-download me-1" style="color: #fff;"></i>Télécharger le CV</a>
  </div>
  
</section>

<div class="section-divider">
  <svg viewBox="0 0 1440 100" preserveAspectRatio="none">
    <path d="M0,0 C480,100 960,0 1440,100 L1440,0 L0,0 Z" fill="#89a88f"></path>
  </svg>
</div>
  
<!--Section Formation-->
<section id="formation" class="px-5 pb-5">
    <div class="heading py-2 mb-5">
      <h2>Formation</h2>
    </div>

    <div class="row row-cols-1 row-cols-md-4 g-5 py-3">
      <div class="col formation-item hidden-on-load">
        <div class="card h-100 formation-block pt-3">
          <div class="badge"><span class="bi bi-award mx-auto"></span></div>
          <div class="card-body">
            <h5 class="card-title">2024</h5>
            <div class="card-text">
                <h3>Développeur Web et web mobile</h3>
                <h5>ESECAD Skill and you</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="col formation-item hidden-on-load">
        <div class="card h-100 formation-block pt-3">
          <div class="badge"><span class="bi bi-award mx-auto"></span></div>
          <div class="card-body">
            <h5 class="card-title">2022</h5>
            <div class="card-text">
              <h3>Formation Management</h3>
                <h5>École Française</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="col formation-item hidden-on-load">
        <div class="card h-100 formation-block pt-3">
        <div class="badge"><span class="bi bi-award mx-auto"></span></div>
          <div class="card-body">
            <h5 class="card-title">2003</h5>
            <div class="card-text">
              <h3>Infirmière Diplomée d'Etat</h3>
              <h5>IFSI Clérmont-de-l'Oise</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="col formation-item hidden-on-load">
        <div class="card h-100 formation-block pt-3">
        <div class="badge"><span class="bi bi-award mx-auto"></span></div>
          <div class="card-body">
            <h5 class="card-title">1998</h5>
            <div class="card-text">
                <h3>Baccalauréat Scientifique</h3>
                <h5>Lycée Saint-Exupéry-Fameck</h5>
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
<section id="portfolio" class="px-5 pb-5">
    <div class="heading py-2 mb-5">
      <h2>portfolio</h2>
    </div>

  <div class="row row-cols-1 row-cols-md-4 g-5 projet">
  <div class="col portfolio-item hidden-on-load">
    <div class="card h-100 text-center bggreen">
      <div class="card-body d-flex flex-column justify-content-center">
        <p class="card-text ft">
          Découvrez une sélection de projets réalisés dans le cadre de ma formation DWWM. 
          Ces travaux mettent en œuvre des langages comme JavaScript, PHP et Python, 
          ainsi que des frameworks tels qu’Angular pour le front-end et Flask pour le back-end, 
          en interaction avec des bases de données relationnelles (MySQL, PostgreSQL). 
          Chaque projet illustre une compétence clé : API REST, interactions asynchrones, POO, 
          MVC, gestion de formulaires, ou encore cartographie dynamique.
        </p>
      </div>
    </div>
  </div>

  <div class="col portfolio-item hidden-on-load">
      <div class="card h-100 text-center">
        <img src="img/jsexo1.png" class="card-img-top w-100 p-3" alt="Interface projet">
        <div class="card-body">
          <h6 class="card-title">JS-se perfectionner- projet n°1</h6>
          <div class="d-flex justify-content-around flex-wrap">
            <a tabindex="11" href="https://github.com/Lati04/note-musique-js" class="btn btn-pdf p-2 mb-2">Code source</a>
            <a tabindex="12" href="https://portfoliolati.byethost14.com/projets/js1/" target="_blank" class="btn btn-pdf p-2 mb-2">Mon projet</a>
          </div>

        </div>
      </div>
    </div>
    <div class="col portfolio-item hidden-on-load">
      <div class="card h-100 text-center">
        <img src="img/jsex2.png" class="card-img-top w-100 p-3" alt="Interface projet">
        <div class="card-body">
          <h6 class="card-title">JS-se perfectionner- projet n°2</h6>
          <div class="d-flex justify-content-around flex-wrap">
            <a tabindex="13" href="https://github.com/Lati04/note-musique-js-2" class="btn btn-pdf p-2 mb-2">Code source</a>
            <a tabindex="14" href=https://portfoliolati.byethost14.com/projets/js2/ target="_blank" class="btn btn-pdf p-2 mb-2">Mon projet</a>
          </div>   
        </div>
      </div>
    </div>
      
    <div class="col portfolio-item hidden-on-load">
      <div class="card h-100 text-center">
        <img src="img/php1.png" class="card-img-top w-100 px-3" alt="Interface projet">
        <div class="card-body"> 
          <h6 class="card-title">PHP-expert-projet n°1</h6>
          <div class="d-flex justify-content-around flex-wrap">
            <a tabindex="15" href="https://github.com/Lati04/php-expert-devoir1" class="btn btn-pdf p-2 mb-2">Code source</a>
            <a tabindex="16" href="https://portfoliolati.byethost14.com/projets/php1/" target="_blank" class="btn btn-pdf p-2 mb-2">Mon projet</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col portfolio-item hidden-on-load">
      <div class="card h-100 text-center">
        <img src="img/phpex2.png" class="card-img-top w-100 p-3" alt="Interface projet">
        <div class="card-body">
          <h6 class="card-title">PHP-expert-projet n°2</h6>
          <div class="d-flex justify-content-around flex-wrap">
            <a tabindex="17" href="https://github.com/Lati04/php-expert-devoir2" class="btn btn-pdf p-2 mb-2">Code source</a>
            <a tabindex="18" href="https://portfoliolati.byethost14.com/projets/php2/"  target="_blank" class="btn btn-pdf p-2 mb-2">Mon projet</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col portfolio-item hidden-on-load">
      <div class="card h-100 text-center">
        <img src="img/angular.png" class="card-img-top w-100 p-3" alt="Interface projet">
        <div class="card-body">
          <h6 class="card-title">Créer une application Angular</h6>
          <div class="d-flex justify-content-around flex-wrap">
            <a tabindex="19" href="https://github.com/Lati04/angular-annuaire-ecoles" class="btn btn-pdf p-2 mb-2">Code source</a>
            <a tabindex="20" href="https://portfoliolati.byethost14.com/projets/angular/"  target="_blank" class="btn btn-pdf p-2 mb-2">Mon projet</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col portfolio-item hidden-on-load">
      <div class="card h-100 text-center">
        <img src="img/api-rest.png" class="card-img-top w-100 p-3" alt="Interface projet">
        <div class="card-body">
          <h6 class="card-title">Dévelloper une API</h6>
          <div class="d-flex justify-content-around flex-wrap">
            <a tabindex="21" href="https://github.com/Lati04/api-recettes" target="_blank" class="btn btn-pdf p-2 mb-2">Code source</a>
            <a tabindex="22" href="https://portfoliolati.byethost14.com/projets/api/"  class="btn btn-pdf p-2 mb-2">Mon projet</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col portfolio-item hidden-on-load">
      <div class="card h-100 text-center">
        <img src="img/python.png" class="card-img-top w-100 p-3" alt="Interface projet Python">
        <div class="card-body">
          <h6 class="card-title">Projet Python avec Flask</h6>
          <div class="d-flex justify-content-around flex-wrap">
            <a tabindex="23" href="https://github.com/Lati04/webPyFlask" target="_blank" class="btn btn-pdf p-2 mb-2">Code source</a>
            <a tabindex="24" href="https://webpyflask.onrender.com" target="_blank" class="btn btn-pdf p-2 mb-2">Mon projet</a>
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

<section id="recommendations" class="px-5 pb-3">
  <div class="heading py-2 mb-5">
    <h2 class="text-center">Références & Recommandations</h2>
  </div>

  <div id="myCarousel" class="carousel carousel-light slide" data-bs-ride="carousel" data-bs-interval="4000">

    <!-- Contenu du carrousel -->
      <div class="carousel-inner text-center pt-2 px-2">

        <!-- Slide 1 -->
        <div class="carousel-item active pt-2">
          <h3><i class="far fa-file me-1" style="color: #89a887;"></i>Relevé de notes</h3>
          <p>Validation complète de ma formation en développement web.</p>
          <a tabindex="25" href="doc/Releve_de_notes_-_267776-0.pdf" target="_blank" class="btn btn-pdf m-2">
            <i class="fas fa-download me-1" style="color: #fff;"></i>Consulter le PDF
          </a>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item pt-2">
          <h3>Présentations & Dossiers de projet</h3>
          <p>Consulter mon dossier Professionnel DWWM, mon dossier et support de présentation de projet Studee.</p>
          <a tabindex="26" href="doc/dossierprodwwm.pdf" target="_blank" class="btn btn-pdf m-2">
            <i class="bi bi-folder-fill me-1" style="color: #fff;"></i>Dossier Professionnel
          </a>
          <a tabindex="27" href="doc/dossierprojetstudee.pdf" target="_blank" class="btn btn-pdf m-2">
            <i class="bi bi-folder-fill me-1" style="color: #fff;"></i>Dossier Projet Studee
          </a>
          <a tabindex="28" href="doc/supportprojetstudee.pdf" target="_blank" class="btn btn-pdf m-2">
            <i class="fas fa-microphone me-1" style="color: #fff;"></i>Support Projet Studee
          </a>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item pt-2">
          <h3><i class="far fa-file-alt me-1" style="color: #89a887;"></i>Lettre de recommandation</h3>
          <p>Retour positif de mon tuteur de stage sur mon implication et mes compétences.</p>
          <a tabindex="29" href="doc/Lettre recommandation Webdev - Latifa ATTAR (1).pdf" target="_blank" class="btn btn-pdf m-2">
            <i class="fas fa-download me-1" style="color: #fff;"></i>Lire la lettre
          </a>
        </div>

        <!-- Slide 4 -->
        <div class="carousel-item pt-2">
          <h3><i class="bi bi-github me-1" style="color: #89a887;"></i>Mon GitHub</h3>
          <p>Découvrez certains de mes projets web (JavaScript, PHP, Angular, Flask, React…) directement sur mon profil GitHub.</p>
          <a tabindex="30" href="https://github.com/Lati04" target="_blank" class="btn btn-pdf m-2">
            <i class="bi bi-github me-1"></i>Voir mon profil GitHub
          </a>
        </div>
      </div>
   
      <!-- ✅ Indicateurs à l’intérieur du carousel -->
      <div class="carousel-indicators justify-content-center">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
      </div>
  </div>
</section>


<div class="divider black mx-auto mb-5"></div>

<!-- Section Contact -->
<section id="contact" class="p-5">
    <div id="toast-container"  class="d-flex align-items-center justify-content-center mb-3">
          <?php if (isset($_GET['success']) && $justSubmitted): ?>
            <div class="custom-toast <?= $_GET['success'] == 1 ? 'success' : 'error' ?>" role="alert">
              <?= $_GET['success'] == 1 ? '✅ Message envoyé avec succès !' : '❌ Une erreur est survenue.' ?>
              <span class="close-toast" onclick="this.parentElement.remove();">×</span>
            </div>
          <?php endif; ?>
    </div>
  <div class="heading py-2 mb-5">
    <h2>Contactez-moi</h2>
  </div>

  <div class="row">
    <div class="col-lg-8 mx-auto">
      <form id="contact-form" method="post" action="sendmail.php">
        <div class="row px-4 mt-3">
          <div class="col-md-6">
            <label for="firstname">Prénom<span class="blue"> *</span></label>
            <input tabindex="31" name="firstname" id="firstname" type="text" class="form-control mb-1" placeholder="Prénom" 
              value="<?= htmlspecialchars($inputs['prenom']) ?>">
            <p class="comments mb-3"><?= $errors['firstnameError'] ?></p>
          </div>

          <div class="col-md-6">
            <label for="name">Nom<span class="blue"> *</span></label>
            <input tabindex="32" name="name" id="name" type="text" class="form-control mb-1" placeholder="Nom de famille" 
              value="<?= htmlspecialchars($inputs['nom']) ?>">
            <p class="comments mb-3"><?= $errors['nameError'] ?></p>
          </div>
        </div>

        <div class="row px-4">
          <div class="col-md-6">
            <label for="email">Adresse email<span class="blue"> *</span></label>
            <input tabindex="33" name="email" id="email" type="email" class="form-control mb-1" placeholder="name@example.com"
              value="<?= htmlspecialchars($inputs['email']) ?>">
            <p class="comments mb-3"><?= $errors['emailError'] ?></p>
          </div>

          <div class="col-md-6">
            <label for="phone">Téléphone</label>
            <input tabindex="34" name="phone" id="phone" type="tel" class="form-control mb-1" placeholder="Téléphone"
              value="<?= htmlspecialchars($inputs['telephone']) ?>">
            <p class="comments mb-3"><?= $errors['phoneError'] ?></p>
          </div>
        </div>

        <div class="col-md-12 px-4">
          <label for="message">Message<span class="blue"> *</span></label>
          <textarea tabindex="35" class="form-control mb-1" id="message" name="message" rows="5" placeholder="Votre message"><?= htmlspecialchars($inputs['message']) ?></textarea>
          <p class="comments mb-3"><?= $errors['messageError'] ?></p>
        </div>

        <div class="col-md-12 px-4 mt-1">
          <p class="blue"><strong>* Ces informations sont requises</strong></p>
        </div>

        <div class="d-flex align-items-center justify-content-center p-2">
          <button tabindex="36" type="submit" class="btn btn-pdf px-5">Envoyer</button>
        </div>
      </form>
    </div>
  </div>
</section>

<!--Footer-->
<footer class="text-center py-3">
      <a tabindex="37" href="#about"><svg xmlns="http://www.w3.org/2000/svg" width="53" height="33" fill="currentColor" class="bi bi-chevron-bar-up" viewBox="0 0 16 16">
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