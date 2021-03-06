<?php

require_once 'dbconfig.php';

class USER
{

 private $conn;

 public function __construct()
 {
  $database = new Database();
  $db = $database->dbConnection();
  $this->conn = $db;
    }

 public function runQuery($sql)
 {
  $stmt = $this->conn->prepare($sql);
  return $stmt;
 }

 public function lasdID()
 {
  $stmt = $this->conn->lastInsertId();
  return $stmt;
 }

 public function register($uname,$email,$upass,$uphone,$urole,$code)
 {
  try
  {
   $password = md5($upass);
   $stmt = $this->conn->prepare("INSERT INTO users(userName,userEmail,userPass,userPhone,loginType,tokenCode)
                                                VALUES(:user_name, :user_mail, :user_pass, :user_phone,:user_type, :active_code)");
   $stmt->bindparam(":user_name",$uname);
   $stmt->bindparam(":user_mail",$email);
   $stmt->bindparam(":user_pass",$password);
   $stmt->bindparam(":user_phone",$uphone);
   $stmt->bindparam(":user_type",$urole);
   $stmt->bindparam(":active_code",$code);
   $stmt->execute();
   return $stmt;
  }
  catch(PDOException $ex)
  {
   echo $ex->getMessage();
  }
 }

 public function login($email,$upass)
 {
  try
  {
   $stmt = $this->conn->prepare("SELECT * FROM users WHERE userEmail=:email_id");
   $stmt->execute(array(":email_id"=>$email));
   $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
   //$type = $userRow['loginType'];

   if($stmt->rowCount() == 1)
   {
    if($userRow['userStatus']=="Y")
    {
     if($userRow['userPass']==md5($upass))
     {
       if($userRow['loginType']=="admin"){
         $_SESSION['userSession'] = $userRow['userID'];
         echo "<script>window.location.assign('adminhome.php')</script>";
       } else if ($userRow['loginType']=="company"){
         $_SESSION['userSession'] = $userRow['userID'];
         echo "<script>window.location.assign('companyhome.php')</script>";
       } else{
         $_SESSION['userSession'] = $userRow['userID'];
         echo "<script>window.location.assign('home.php')</script>";
       }
     }
     else
     {
      header("Location: login.php?error");
      echo "Wrong password";
      exit;
     }
    }
    else
    {
     header("Location: login.php?inactive");
     echo "your account is not activated.Try resend email option";
     exit;
    }
   }
   else
   {
    header("Location: login.php?error");
    echo "No user found";
    exit;
   }
  }
  catch(PDOException $ex)
  {
   echo $ex->getMessage();
  }
 }


 public function is_logged_in()
 {
  if(isset($_SESSION['userSession']))
  {
   return true;
  }
 }

 public function redirect($url)
 {
  header("Location: $url");
 }

 public function logout()
 {
  session_destroy();
  $_SESSION['userSession'] = false;
 }

 function send_mail($email,$message,$subject)
 {
  require_once('mailer/class.phpmailer.php');
  $mail = new PHPMailer();
  $mail->IsSMTP();
  $mail->SMTPDebug  = 0;
  $mail->SMTPAuth   = true;
  $mail->SMTPSecure = "ssl";
  $mail->Host       = "smtp.gmail.com";
  $mail->Port       = 465;
  $mail->AddAddress($email);
  $mail->Username="yourgmailid@gmail.com";
  $mail->Password="yourgmailpassword";
  $mail->SetFrom('you@yourdomain.com','');
  $mail->AddReplyTo("you@yourdomain.com","");
  $mail->Subject    = $subject;
  $mail->MsgHTML($message);
  $mail->Send();
 }
}
