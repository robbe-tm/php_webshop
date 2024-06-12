<?php

include 'includes/config.php';

if(isset($_POST['submit'])){

   $firstname = $_POST['firstname'];
   $firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
   $lastname = $_POST['lastname'];
   $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = md5($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select->execute([$email]);

   if($select->rowCount() > 0){
      $message[] = 'E-mail adres bestaat al!';
   }else{
      if($pass != $cpass){
         $message[] = '"Bevestig wachtwoord" komt niet overeen met "wachtwoord"!';
      }else{
         $insert = $conn->prepare("INSERT INTO `users`(firstname, lastname, email, password) VALUES(?,?,?,?)");
         $insert->execute([$firstname, $lastname, $email, $pass]);

         if($insert){
               $message[] = 'Succesvol geregistreerd!';
               header('location:login.php');
         }

      }
   }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/components.css">
</head>

<body>

    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '    
            <div class="message">
                <span>' . $message . '</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
            ';
        }
    }
    ?>

    <section class="formcontainer">
        <form action="" enctype="multipart/form-data" method="POST">
            <h3>Registreer u</h3>
            <input type="text" name="firstname" class="box" placeholder="Voer u voornaam in" required>
            <input type="text" name="lastname" class="box" placeholder="Voer u achternaam in" required>
            <input type="email" name="email" class="box" placeholder="Voer u e-mail in" required>
            <input type="password" name="pass" class="box" placeholder="Voer u wachtwoord in" required>
            <input type="password" name="cpass" class="box" placeholder="Bevestig u wachtwoord" required>
            <input type="submit" value="Registreren" class="btn" name="submit">
            <p>Heb je al een account? <a href="login.php">Login</a></p>
        </form>
    </section>
</body>

</html>