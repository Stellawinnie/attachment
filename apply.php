<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
 $user_home->redirect('login.php');
}

$stmt = $user_home->runQuery("SELECT * FROM users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$conn = mysqli_connect("localhost", "root", "12345678", "attachment");

$msg = "";
if(isset($_GET['category']))
{
  $_SESSION['category']=$_GET['category'];
 header("Location: category.php");
}
$apply = $_SESSION['apply'];

/* code for data insert */
if(isset($_POST['save']) && isset($_FILES['uploaded_file']) && $_FILES['uploaded_file']['error'] === UPLOAD_ERR_OK)
{
     // get values
   	$companyName =  $_POST['companyName'];
   	$userName = $_POST['userName'];
   	$userEmail = $_POST['userEmail'];
   	$userPhone =  $_POST['userPhone'];
    $about =  $_POST['about'];
    $postId =  $_POST['postId'];
   	$postTime = $_POST['postTime'];

    $emailresponse = $conn->query("SELECT * FROM tbl_posts WHERE id='$postId'");
    $emailRow=$emailresponse->fetch_array();

    $companyemail = $emailRow['companyEmail'];

    require 'PHPMailer/PHPMailerAutoload.php';

      if(isset($_FILES['attachmentLetter']) && $_FILES['attachmentLetter']['error'] === UPLOAD_ERR_OK){

        $allfiles = array($_FILES['uploaded_file'], $_FILES['attachmentLetter']);
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->Username = 'beja.emmanuel@gmail.com';
        $mail->Password = '#1Emmcodes';
        $mail->AddAttachment($allfiles);
        $mail->setFrom('DoNotReply@gmail.com', 'Saps');
        $mail->addAddress($companyemail);
        $mail->Subject = 'Saps! Application';
        $mail->Body = " Hello $companyName,
        $userName has just applied for the position you posted.Bellow are his/her application credentials and acompanying documents.
        Applicant Email: $userEmail
        Applicant Phone: 0$userPhone
        About: $about

        Thank you for using Saps,";

        //send the message, check for errors
        if (!$mail->send()) {
          $msg = "
            <div class='alert alert-danger'>
             <button class='close' data-dismiss='alert'>&times;</button>
             <strong>Error!</strong>  Couldnt send email to $companyemail.
                           Please try again later.
              </div>
            ";
            $sent="No";
        } else {
          $msg = "
            <div class='alert alert-success'>
             <button class='close' data-dismiss='alert'>&times;</button>
             <strong>Success!</strong>  We've sent an email of your application to $companyemail.
             Kindly wait for them to get back to you.
              </div>
            ";
            $sent="Yes";
        }
      } else{
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->Username = 'beja.emmanuel@gmail.com';
        $mail->Password = '#1Emmcodes';
        $mail->AddAttachment($_FILES['uploaded_file']['tmp_name'], $_FILES['uploaded_file']['name']);
        $mail->setFrom('DoNotReply@gmail.com', 'Saps');
        $mail->addAddress($companyemail);
        $mail->Subject = 'Saps! Application';
        $mail->Body = " Hello $companyName,
        $userName has just applied for the position you posted.Bellow are his/her application credentials and acompanying documents.
        Applicant Email: $userEmail
        Applicant Phone: 0$userPhone
        About: $about

        Thank you for using Saps,";

        //send the message, check for errors
        if (!$mail->send()) {
          $msg = "
            <div class='alert alert-danger'>
             <button class='close' data-dismiss='alert'>&times;</button>
             <strong>Error!</strong>  Couldnt send email to $companyemail.
                           Please try again later.
              </div>
            ";
            $sent="No";
        } else {
          $msg = "
            <div class='alert alert-success'>
             <button class='close' data-dismiss='alert'>&times;</button>
             <strong>Success!</strong>  We've sent an email of your application to $companyemail.
             On your next application, kindly attach an application letter too.
             Kindly wait for them to get back to you.
              </div>
            ";
            $sent="Yes";
        }
      }

    $respCheck = $conn->query("SELECT * FROM tbl_applicants WHERE userName='$userName' AND postId='$postId'");
    if($RowCheck=$respCheck->fetch_array()){
      $idApplicant = $RowCheck['id'];
      $QL = $conn->prepare("DELETE FROM tbl_applicants WHERE id='$idApplicant'");
      $QL->bind_param('i',$idApplicant);
      $QL->execute();

      $SQL = $conn->prepare("INSERT INTO tbl_applicants(companyName, userName, userEmail, userPhone, about, postId, postTime, sent) VALUES(?,?,?,?,?,?,?,?)");
      $SQL->bind_param('ssssssss',$companyName, $userName, $userEmail, $userPhone, $about, $postId, $postTime, $sent);
      $SQL->execute();

      if(!$SQL)
      {
       echo $MySQLiconn->error;
      }

    } else{
      $SQL = $conn->prepare("INSERT INTO tbl_applicants(companyName, userName, userEmail, userPhone, about, postId, postTime, sent) VALUES(?,?,?,?,?,?,?,?)");
      $SQL->bind_param('ssssssss',$companyName, $userName, $userEmail, $userPhone, $about, $postId, $postTime, $sent);
      $SQL->execute();

      if(!$SQL)
      {
       echo $MySQLiconn->error;
      }
    }

    header("refresh:5;category.php");
    }


if(isset($_GET['apply']))
{
  $_SESSION['apply']=$_GET['apply'];
 header("Location: apply.php");
}

if(isset($_POST['editpic'])){
  header("Location: userProfile.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Category|Saps</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body onload="startTime()">

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Saps</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
              <li>
              <a href="home.php"><i class="fa fa-home fa-fw"></i>Home</a>
              </li>
              <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  <i class="fa fa-th-list fa-fw"></i>
                  Categories <i class="fa fa-caret-down"></i>
              </a>
              <ul class="dropdown-menu dropdown-user">
                  <li><a href="?category=Business"><i class="fa fa-book fa-fw"></i> Businesss</a>
                  </li>
                  <li><a href="?category=Arts"><i class="fa fa-book fa-fw"></i> Arts</a>
                  </li>
                  <li><a href="?category=Education"><i class="fa fa-book fa-fw"></i> Education</a>
                  </li>
                  <li><a href="?category=Engineering"><i class="fa fa-book fa-fw"></i> Engineering</a>
                  </li>
                  <li><a href="?category=Computing"><i class="fa fa-book fa-fw"></i> Computing</a>
                  </li>
                  <li><a href="?category=Media"><i class="fa fa-book fa-fw"></i> Media</a>
                  </li>
                  <li><a href="?category=Geology"><i class="fa fa-book fa-fw"></i> Geology</a>
                  </li>
                  <li><a href="?category=Health"><i class="fa fa-book fa-fw"></i> Health</a>
                  </li>
                  <li><a href="?category=Law"><i class="fa fa-book fa-fw"></i> Law</a>
                  </li>
                  <li><a href="?category=Agriculture"><i class="fa fa-book fa-fw"></i> Agriculture</a>
                  </li>
                  <li><a href="?category=Architecture"><i class="fa fa-book fa-fw"></i> Architecture</a>
                  </li>
                  <li><a href="?category=Appliedsciences"><i class="fa fa-book fa-fw"></i> Applied Sciences</a>
                  </li>
                  <li><a href="?category=Mathematics"><i class="fa fa-book fa-fw"></i> Mathematics</a>
                  </li>
                  <li><a href="?category=Other"><i class="fa fa-book fa-fw"></i> Other</a>
                  </li>
              </ul>
              <!-- /.dropdown-user -->
          </li>
              <li><span>
              <button class="btn btn-outline btn-primary" data-toggle="modal" data-target="#companies">Companies</button>
              </span></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php echo $row['userName']?><i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user"
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            <div class="navbar-default sidebar" role="navigation">
          <div class="sidebar-nav navbar-collapse">
            <div class="panel panel-default">
                  <div class="panel-heading">
                    <?php
                    $name = $row['userName'];
                    $response = $conn->query("SELECT * FROM tbl_prof WHERE userName='$name'");
                    $prow=$response->fetch_array();
                    $_SESSION['picName'] = $prow['userName'];
                    if (!$prow['image']){
                      ?>
                      <img src="upload/noimage-team.png" class="img-responsive img-circle" alt="">
                      <?php
                    } else{
                      ?>
                      <img src="upload/<?php echo $prow['image']; ?>" class="img-responsive img-circle" alt=""></br>
                      <?php
                    }
                     ?>
                    <form role="form" method="post">
                    <button class="btn btn-outline btn-primary btn-block" name="editpic">Edit Profile</button>
                    </form>
                  </div>
                  <div class="panel-body">
                  </div>
                  <!-- /.panel-body -->
              </div>
          </div>
      </div>
        </nav>

        <div id="page-wrapper">
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <?php
                        echo $msg;
                        $name = $row['userName'];
                        $res = $conn->query("SELECT * FROM tbl_posts WHERE id='$apply'");
                        $Row=$res->fetch_array();
                        ?>
                        <h4><?php echo $Row['position']; ?></h4>
                        <a href="mailto:<?php echo $Row['companyEmail']; ?>"> <i class="fa fa-envelope-o fa-fw"></i><?php echo $Row['companyName']; ?></a>
                      </div>
                        <div class="panel-body">
                          <div class="list-group">
                            <form method="post" enctype="multipart/form-data">
                                                          <div class="form-group">
                                                              <label for="companyName">To</label>
                                                              <input type="text" name="companyName" placeholder="" class="form-control" value="<?php echo $Row['companyName']?>" autofocus required/>
                                                          </div>

                                                          <div class="form-group">
                                                              <input type="hidden" name="userName" placeholder="" class="form-control" value="<?php echo $row['userName']?>" autofocus required/>
                                                          </div>

                                                          <div class="form-group">
                                                              <input type="hidden" name="userEmail" placeholder="Your email" value="<?php echo $row['userEmail'];  if(isset($_GET['edit'])) echo $Row['companyEmail']?>" class="form-control"/>
                                                          </div>

                                                            <div class="form-group">
                                                                <input type="hidden" name="userPhone" placeholder="" value="<?php echo $row['userPhone'];  ?>" class="form-control"/>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="about">About</label>
                                                                <textarea type="text" name="about" placeholder="Short description About you" value="" class="form-control"/></textarea>
                                                            </div>

                                                            <div class="form-group">
                                                                <input type="hidden"  name="postId" placeholder="" value="<?php echo $Row['id']; ?>" class="form-control"/>
                                                            </div>

                                                            <div class="form-group">
                                                              <label for="uploaded_file">CV</label>
                                                               <input type="file" name="uploaded_file" id="uploaded_file"/>
                                                            </div>

                                                            <div class="form-group">
                                                              <label for="applicationLetter">Application Letter</label>
                                                               <input type="file" name="applicationLetter" id="applicationLetter"/>
                                                            </div>

                                                            <div class="form-group">
                                                                <input type="hidden" id="postTime" name="postTime" placeholder="" class="form-control"/>
                                                            </div>

                                                             <button type="submit" class="btn btn-primary" name="save">Add Record</button>

                                                          </form>
                          </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Applied
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                              <?php
                              $name = $row['userName'];
                              $re = $conn->query("SELECT * FROM tbl_applicants WHERE userName='$name'");
                              while($rows=$re->fetch_array())
                              {
                                $dee = $rows['postId'];
                                $respo =  $conn->query("SELECT * FROM tbl_posts WHERE id='$dee'");
                                $ros=$respo->fetch_array();

                                if($rows['sent']=='No'){?>
                                  <a href="?apply=<?php echo $ros['id']; ?>" class="list-group-item">
                                    <i class="fa fa-user fa-fw"></i><?php echo $rows['companyName']; ?><br>
                                    <i class="fa fa-briefcase fa-fw"></i><?php echo $ros['level']; ?>
                                    <i class="fa fa-book fa-fw"><?php echo $ros['category']; ?></i><br>
                                    <i class="fa fa-file-text-o fa-fw"></i><?php echo $ros['detail']; ?><br>
                                    <i class="fa  fa-fw text-muted fa-clock-o fa-fw"><?php echo $rows['postTime']; ?></i><br>
                                  </a>
                                  <div class='alert alert-danger'>
                                  <button class='close' data-dismiss='alert'>&times;</button>
                                   You tried applying for this post but sending of your email to the company failed.
                                   Click above to try again.
                                 </div>
                                  <?php
                                }else{?>
                                  <span class="list-group-item">
                                    <i class="fa fa-user fa-fw"></i><?php echo $rows['companyName']; ?><br>
                                    <i class="fa fa-briefcase fa-fw"></i><?php echo $ros['level']; ?>
                                    <i class="fa fa-book fa-fw"><?php echo $ros['category']; ?></i><br>
                                    <i class="fa fa-file-text-o fa-fw"></i><?php echo $ros['detail']; ?><br>
                                    <i class="fa  fa-fw text-muted fa-clock-o fa-fw"><?php echo $rows['postTime']; ?></i><br>
                                  </span>
                                  <?php
                                }
                                ?>

                              <?php } ?>
                            </div>
                            <!-- /.list-group -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <div class="modal fade" id="companies" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
               <h4>Companies</h4>
             </div>
             <div class="modal-body">
               <?php
               $res = $conn->query("SELECT * FROM users WHERE loginType='company'");
               while($Row=$res->fetch_array())
               {?>
                  <div class="list-group">
                    <span class="list-group-item">
                      <a href="mailto:<?php echo $Row['userEmail']; ?>"> <i class="fa fa-envelope-o fa-fw"></i><?php echo $Row['userName']; ?></a><br>
                      <i class="fa fa-phone fa-fw"> 0<?php echo $Row['userPhone']; ?></i><br>
                    </span>
                 </div>
               <?php } ?>
             </div>
             <div class="modal-footer">
               <div class="form-group" >
                 <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Cancel</button>
               </div>
               </form>
             </div>
        </div>
    </div>
    </div>
    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>


    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

    <script>
    function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    // add a zero in front of numbers<10
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById("postTime").value = h + ":" + m + ":" + s;
    var t = setTimeout(function(){ startTime() }, 10);
    }

    function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
    }
    </script>
</body>

</html>
