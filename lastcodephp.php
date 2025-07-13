<!-- <?php 
  //  $firstname = $name = $email = $phone = $message = "";
  //  $firstnameError = $nameError = $emailError = $phoneError = $messageError = "";
  //  $isSuccess = false;
  //  $emailTo = "attar.latifa9@gmail.com";

  //  ///////////////////////////////////////////////////////
  //  ///                   Sécurité                    ////
  //  //////////////////////////////////////////////////////
  
  //  if($_SERVER['REQUEST_METHOD'] == 'POST'){
  //      $firstname = verifyInput($_POST['firstname']);
  //      $name = verifyInput($_POST['name']);
  //      $email = verifyInput($_POST['email']);
  //      $phone = verifyInput($_POST['phone']);
  //      $message = verifyInput($_POST['message']);
  //      $isSuccess = true;
  //      $emailText = "";

  //     if(empty($firstname)){
  //         $firstnameError = "Donnez moi votre prénom, s\'il vous plâit !";
  //         $isSuccess = false;
  //     }else
  //       $emailText .= "Prénom: $firstname\n";
      

  //     if(empty($name)){
  //       $nameError = "Donnez moi votre nom, s\'il vous plâit !";
  //       $isSuccess = false;
  //     }else{
  //       $emailText .= "Nom: $name\n";
  //     }
      
 
  //     if(!isEmail($email)){
  //       $emailError = "Donnez moi un email correct, s\'il vous plâit !";
  //       $isSuccess = false;
  //     }else{
  //       $emailText .= "email: $email\n";
  //     }
      

  //     if(!isPhone($phone)){
  //       $phoneError = "Donnez moi votre numéro de télephone composé de chiffre et espace, s\'il vous plâit !";
  //       $isSuccess = false;
  //     }else{
  //       $emailText .= "Télephone: $phone\n";
  //     }
    
  //     if(empty($message)){
  //       $messageError = "Laissez moi un message, s'il vous plâit !";
  //       $isSuccess = false;
  //     }else{
  //       $emailText .= "message: $message\n";
  //     }
      

  //     if($isSuccess){
  //         $headers = "From:  $firstname $name <$email>\r\nReply-To: $email";
  //         $headers .= "Content-Type: text/plain; charset=utf-8\r\n";
  //         mail($emailTo, "Un message de votre site", $emailText, $headers);
  //         $firstname = $name = $email = $phone = $message = '';
  //     }
  //  }

  //  function isPhone($var){
  //      return preg_match("/^[0-9 ]*$/", $var);
  //  }

  //  function isEmail($var){
  //      return filter_var($var, FILTER_VALIDATE_EMAIL);
  //  }

  //  function verifyInput($var){
  //     $var = trim($var ?? '');
  //     $var = stripslashes($var);
  //     $var = htmlspecialchars($var);

  //     return $var;
  //  }
  ?> -->

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