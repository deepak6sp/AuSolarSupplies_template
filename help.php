<?php include_once("php/header.php"); ?>
<!--menubar-->
    <header class="bottomHeader">
      <?php include_once("php/navHeader.php"); ?>
    </header>
<!---left Bar-->
    <aside class="leftBar">
        <?php include("php/leftBar/catagory.php"); ?>
    </aside>
<!---main content-->
    <main class="mainContent">
        <?php
          // check for header injection to avoid hacking
          function has_header_injection($str){
            return (preg_match('/[\r\n]/',$str));
          } 
          // check for is not null
          if (isset($_POST['contact_submit'])){
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $message = $_POST['message'];

            // check for name and email have header injection
            if (has_header_injection($name) || has_header_injection($email)){
              die();
            }

            if ( !$name || !$email || !$message){
              echo "<h4> * All fields required</h4>";
              exit;
            }

            $to = "deepak6sp@gmail.com";
            $subject = "$name sent you a message via ausolarsupplies website";
            $message = "Name : $name\r\n";
            $message = "Email : $email\r\n";
            $message = "Message : $message ";

            //80 char per line whenn displayed
            $message = wordwrap($message, 80);

            //format email
            $headers = "MIME-Version:1.0\r\n";
            $headers .= "Content-type:text/plain; charset-iso-8859-1\r\n";
            $headers .="From: $name <$email> \r\n";
            $headers .="X-Priority:1\r\n";
            $headers .="X-MSMail-Priority:High\r\n";

            mail($to,$subject,$message,$headers);
      ?>
      <!--  disply success message -->
      <h4> Thanks for contacting AuSolarSupplies</h4>
      <?php } else { ?>

        <form class ="form" method = "post" action="">
          <h5> Please fill the form and we will get in touch with you shortly</h5>
          <input id="name" name="name" type="text" placeholder="Name">
          <input id="email" name="email" type="text" placeholder="youremail@mail.com">
          <textarea id="message" name="message" placeholder="Enter your message here"></textarea><br>
          <input id="submit" name="contact_submit" type="submit" value="Send Message"></submit>
        </form>

      <?php } ?>
    <div id="gap"></div>
    </main>   
<!--footer-->
  <?php include_once("php/footer.php"); ?> 