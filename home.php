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


if(isset($_GET['category']))
{
  $_SESSION['category']=$_GET['category'];
 header("Location: category.php");
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

    <title>Home|Saps</title>

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

<body>

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
              <div class="row">
                <div class="col-lg-12">
                    <div class="jumbotron">
                        <h2>Hello <?php echo $row['userName']?>. Welcome to Saps!</h2>
                        <p>Getting an attachment has not always been easy.We help make your work easier. Attachments and jobs posts just a click away</p>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
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
                                   Kindly try again.
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

</body>

</html>
