<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Responsive Bootstrap Portfolio Template developed by winlet">
    <meta name="author" content="Stella letting">
    <title>Attachment system</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,800,700,300' rel='stylesheet' type='text/css'>


</head>

<body>
    <!-- ====================================================
    header section -->
    <header class="top-header">
        <div class="container">
            <div class="row header-row">
                <div class="col-md-12">
                    <nav class="navbar navbar-default">
                        <a href="index.html"><img src="img/logo.png" alt="" class="logo"></a>
                        <div class="container-fluid">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="home.php">For attaches</a></li>
                                    
<li >
    
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
      Opportunities <span class="caret"></span>
    </a>

    <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Student</a><br>
        <a class="dropdown-item" href="#">Employers</a><br>
        <a class="dropdown-item" href="#">Supervisors</a>
        <div class="dropdown-divider"></div>
        <a href="opps.php">back</a>
    </div>
</li>

                                    <li><a href="co.php">Companies</a></li>
                                    <li><a href="down.php">Downloads</a></li>
                                    <li><a href="media.php">Media Centre</a></li>
                                </ul>
                            </div>
                            
                            <!-- /.navbar-collapse -->
                        </div>
                        <!-- /.container-fluid -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
<a href="login.php" class="btn btn-success" role="button" align="right">Login</a>
    <!-- banner area starts here -->
    <section class="banner text-center" id="sec1">
        <div class="container">

            <div class="col-lg-12 form">
            <h4>APPLICATION FORM</h4>
<form class="form-horizontal" role="form" method="post" action="index.php"> 
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="course" name="course" placeholder="name" value="">
        </div>
    </div>
        <div class="form-group">
        <label for="course" class="col-sm-2 control-label">Course</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="course" name="course" placeholder="course" value="">
        </div>
    </div>
    <div class="form-group">
        <label for="Dept" class="col-sm-2 control-label">Dept</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="Dept" name="dept" placeholder="Dept" value="">
        </div>
    </div>
    <div class="form-group">
        <label for="year-of-study" class="col-sm-2 control-label">Year-of-study</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="year-of-study" name="year-of-study" placeholder="year-of-study" value="">
        </div>
    </div>
<div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="">
        </div>
    </div>

    <div class="form-group">
        <label for="university" class="col-sm-2 control-label">University</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="university" name="name" placeholder="university" value="">
        </div><br>
        </div>

<div class="form-group dropdown">
<div class="container">
<label for="email" class="col-sm-2 control-label">Town</label>
<select name="menu">
<option value="0" selected>(prefered city/town:)</option>
<option value="1">Mombasa</option>
<option value="2">Nairobi</option>
<option value="3">Voi</option>
<option value="3">Nakuru</option>
<option value="3">Eldoret</option>
<option value="3">Lowdar</option>
<option value="3">Kitale</option>
<option value="3">Kisumu</option>
<option value="3">Moyale</option>
<option value="3">Wajir</option>
<option value="other">other, please specify:</option>
</select>
</div>
<div class="container">
<!--<input type="text" name="choicetext">-->
 <label for="study" class="col-sm-2 control-label">Area of Study</label>
<select name="menu">
<option value="0" selected>(Area of study:)</option>
<option value="1">Agriculture</option>
<option value="2">Computer science</option>
<option value="3">Business</option>
<option value="3">Education</option>
<option value="3">Engineering</option>
<option value="3">Humanities</option>
<option value="3">Law</option>
<option value="3">Medical</option>
<option value="3">Media and communication</option>
<option value="3">Leisure and Tourism</option>
<option value="other">other, please specify:</option>
</select>
</div>
<!--<input type="text" name="choicetext">-->
<div class="container">
<label for="Duration" class="col-sm-2 control-label">Duration</label>
<select name="menu">
<option value="0" selected>(prefered duaration:)</option>
<option value="1">2 months</option>
<option value="2">3 months</option>
<option value="3">6 months</option>
<option value="other">other, please specify:</option>
</select>
</div>
<!--<input type="text" name="choicetext">--></div>
<div class="container">
<label for="Duration" class="col-sm-2 control-label">File</label>
        <div class="form-group ">
        <div class="col-lg-9">
        <!--<form action="upload.php" method="post" enctype="multipart/form-data">-->
<input type="file" name="fileToUpload" id="fileToUpload">
</div>
<input id="Send the application" name="Send the application" type="Send the application" value="Send the application" class="from-group btn btn-primary">
        </div>
    </div>
    
    </div>
    </div>
    </form>
                </div>
                <div class="col-lg-6">

                </div>
            </div>
    </section>

        <section class="contact-form">
        <div class="container">
            <div class="row">
                <div class="form">
                    <form action="contact.php">
                        <div class="sbtn col-md-12 text-center">
                        <h4>CONTACT US</h4>

                            <input class="name form-input" type="text" placeholder="NAME">
                            <input class="email form-input" type="email" placeholder="EMAIL">
                            <input class="message form-input" type="text" placeholder="MASSAGE">
                            <input class="submit-btn" type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- footer starts here -->
    <footer class="footer text-center">
        <p>Copyright: &copy; <a href="http://winlet">winlet</a> | All rights reserved</p>
    </footer>
</body>

</html>
