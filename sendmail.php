<?php
require 'config.php';
$env = loadEnv(__DIR__ . '/.env');

require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

session_start();

// Fonctions de validation
function verifyInput($var)
{
    $var = trim($var ?? '');
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}

function isEmail($var)
{
    return filter_var($var, FILTER_VALIDATE_EMAIL);
}

function isPhone($var)
{
    return preg_match("/^[0-9 ]*$/", $var);
}

// Nettoyage des champs
$prenom    = verifyInput($_POST['firstname'] ?? '');
$nom       = verifyInput($_POST['name'] ?? '');
$email     = verifyInput($_POST['email'] ?? '');
$telephone = verifyInput($_POST['phone'] ?? '');
$message   = verifyInput($_POST['message'] ?? '');

// Initialisation des erreurs
$isSuccess = true;
$errors    = [
    'firstnameError' => '',
    'nameError'      => '',
    'emailError'     => '',
    'phoneError'     => '',
    'messageError'   => '',
];

// Validation des champs
if (empty($prenom)) {
    $errors['firstnameError'] = "Donnez-moi votre prénom, s'il vous plaît !";
    $isSuccess                = false;
}

if (empty($nom)) {
    $errors['nameError'] = "Donnez-moi votre nom, s'il vous plaît !";
    $isSuccess           = false;
}

if (! isEmail($email)) {
    $errors['emailError'] = "Donnez-moi un email valide, s'il vous plaît !";
    $isSuccess            = false;
}

if (! empty($telephone) && ! isPhone($telephone)) {
    $errors['phoneError'] = "Donnez-moi un numéro de téléphone valide (chiffres et espaces uniquement).";
    $isSuccess            = false;
}

if (empty($message)) {
    $errors['messageError'] = "Laissez-moi un message, s'il vous plaît !";
    $isSuccess              = false;
}

// Si erreurs, on retourne au formulaire
if (! $isSuccess) {
    $_SESSION['errors']    = $errors;
    $_SESSION['inputs']    = compact('prenom', 'nom', 'email', 'telephone', 'message');
    $_SESSION['submitted'] = true;
    session_write_close();
    header('Location: index.php?success=0#contact');
    exit;
}

// Envoi du mail avec PHPMailer
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp-relay.brevo.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = $env['SMTP_USER'];
    $mail->Password   = $env['SMTP_PASS'];
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->CharSet  = 'UTF-8';
    $mail->Encoding = 'base64';

    $mail->setFrom('attar.latifa9@gmail.com', "$prenom $nom"); 
    $mail->addReplyTo($email);  
    $mail->addAddress('attar.latifa9@gmail.com');              


    $mail->isHTML(false);
    $mail->Subject = "Un message depuis ton portfolio";
    $mail->Body    = "Prénom: $prenom\nNom: $nom\nEmail: $email\nTéléphone: $telephone\nMessage:\n$message";

    $mail->send();

    // Nettoyage de la session + succès
    unset($_SESSION['inputs'], $_SESSION['errors']);
    $_SESSION['submitted'] = true;
    session_write_close();
    header('Location: index.php?success=1#contact');
    exit;

} catch (Exception $e) {
    $_SESSION['errors']    = ['emailError' => "Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}"];
    $_SESSION['inputs']    = compact('prenom', 'nom', 'email', 'telephone', 'message');
    $_SESSION['submitted'] = true;
    session_write_close();
    header('Location: index.php?success=0#contact');
    exit;
}
