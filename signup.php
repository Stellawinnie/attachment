<?php
session_start();
require_once 'class.user.php';

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
 $reg_user->redirect('home.php');
}


if(isset($_POST['btn-signup']))
{
 $uname = trim($_POST['txtuname']);
 $email = trim($_POST['txtemail']);
 $upass = trim($_POST['txtpass']);
 $uphone = trim($_POST['txtphone']);
 $code = md5(uniqid(rand()));

 $stmt = $reg_user->runQuery("SELECT * FROM data WHERE userEmail=:email_id");
 $stmt->execute(array(":email_id"=>$email));
 $row = $stmt->fetch(PDO::FETCH_ASSOC);

 if($stmt->rowCount() > 0)
 {
  $msg = "
        <div class='alert alert-error'>
    <button class='close' data-dismiss='alert'>&times;</button>
     <strong>Sorry !</strong>  email already exists , Please Try another one
     </div>
     ";
 }
 else
 {
  if($reg_user->register($uname,$email,$upass,$uphone,$code))
  {
   $id = $reg_user->lasdID();
   $key = base64_encode($id);
   $id = $key;
   require 'PHPMailer/PHPMailerAutoload.php';
   $mail = new PHPMailer;
   $mail->isSMTP();
   $mail->SMTPDebug = 2;
   $mail->SMTPSecure = 'tls';
   $mail->SMTPAuth = true;
   $mail->Host = 'smtp.gmail.com';
   $mail->Port = 587;
   $mail->Username = 'beja.emmanuel@gmail.com';
   $mail->Password = '#1Emmcodes';
   $mail->setFrom('DoNotReply@gmail.com');
   $mail->addAddress($email);
   $mail->Subject = 'your subject';
   $mail->Body = " Hello $uname,
   Welcome !
   To complete your registration, please click on the link bellow
   http://localhost/attachments/verify.php?id=$id&code=$code

   Thanks,";
   //send the message, check for errors
   if (!$mail->send()) {
     $msg = "
       <div class='alert alert-error'>
        <button class='close' data-dismiss='alert'>&times;</button>
        <strong>Sorry!</strong>Couldnt send email to $email.
                      Please try again.
         </div>
       ";
   } else {
     $msg = "
       <div class='alert alert-success'>
        <button class='close' data-dismiss='alert'>&times;</button>
        <strong>Success!</strong>  We've sent an email to $email.
                      Please click on the confirmation link in the email to create your account.
         </div>
       ";
   }
 }else
  {
   echo "sorry , Query could no execute...";
  }
 }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title></title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body id="login">
    <div class="container">
    <?php if(isset($msg)) echo $msg;  ?>
      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Sign Up</h2><hr />
        <label>User Name.</label></br>
        <input type="text" class="input-block-level" placeholder="Username" name="txtuname" required /></br>
        <label>Email.</label></br>
        <input type="email" class="input-block-level" placeholder="Email address" name="txtemail" required /></br>
        <label>Phone Number.</label></br>
        <input type="text" class="input-block-level" placeholder="Phone number" name="txtphone" required /></br>
        <label>Password.</label></br>
        <input type="password" class="input-block-level" placeholder="Password" name="txtpass" required />
      <hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-signup">Sign Up</button>
        <a href="index.php" style="float:right;" class="btn btn-large">Sign In</a>
        <a href="login.php" class="btn btn-info" role="button">Login</a>
      </form>

    </div> <!-- /container -->
    <script src="vendors/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
