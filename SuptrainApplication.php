<?php
/*
	file:	SuptrainApplication.php
	desc:	This is the main User Interface for the application.
*/
//read the variable page from GET-request if it is there, otherwise page is empty
if(isset($_GET['page'])) $page=$_GET['page'];else $page='';
session_start(); //Uses session to check if user is logged in
if(!isset($_SESSION['user'])) $page='login';

//if not logged in, page is 'login'
header('Cache-control:no-cache, no-store, must-revalidate');
?>


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SupTrain Application</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="css/clean-blog.min.css" rel="stylesheet">
     <!-- Custom styles for this template -->
     <link href="css/starter-template.css" rel="stylesheet">
     <link href="css/signin.css" rel="stylesheet">
     <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>
     <script src="js/doneCheck.js" type="text/Javascript"></script>
  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top mystyle">
      <a class="navbar-brand" href="SuptrainApplication.php"><img src="img/menu_amk_fi.png"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php if($page=='') echo 'active'?>">
            <a class="nav-link" href="SuptrainApplication.php">Home</a>
          </li>
          <li class="nav-item <?php if($page=='organisations') echo 'active'?>">
            <a class="nav-link" href="SuptrainApplication.php?page=organisations">Organisations</a>
          </li>
          <li class="nav-item <?php if($page=='supervisors') echo 'active'?>">
            <a class="nav-link" href="SuptrainApplication.php?page=supervisors">Supervisors</a>
          </li>
          <li class="nav-item dropdown <?php if($page=='allstudents') echo 'active'?>">
            <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Students</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="SuptrainApplication.php?page=allstudents" id="allstudents">All students</a>
              <a class="dropdown-item" href="SuptrainApplication.php?page=trainingPlaceandStudent">Students in Training </a>
              <a class="dropdown-item" href="SuptrainApplication.php?page=thisyear">In training this year</a>
            </div>
          </li>
        </ul>
        <div id='bu'>
       
		
     <?php
     
      //displays user's name, if logged in
			if(isset($_SESSION['user'])){
				echo '<a href="SuptrainApplication.php?page=userinfo">';
				echo '<span  id="user" style="color:white">'.$_SESSION['user'].'</span> ';
				echo '</a>';
			};
		 ?><!--Name of logged in user-->
     
			<span id="loginplace">
				<button class="btn btn-outline-success my-2 my-sm-0 login-box" type="button"
				 data-toggle="modal" data-target="#loginfrm">Login</button></a>
			</span>
			<span id="logoutplace">
				<button id="logoutbtn" class="btn btn-outline-success my-2 my-sm-0 login-box" type="button">Logout</button></a>
			</span>
		</div>
    &nbsp;
    <div class="search-box">
		
     <input id="myfilter" class="search-txt" type="text" placeholder="Type to search" aria-label="Search">
     <a class="search-btn" href=#>
     <i class="fas fa-search"></i>
     </a>
    </div>
      </div>
    </nav>

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('img/home-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
            
              <h2>SupTrain Application</h2>
              <span class="subheading">Web application for practical training to help tutor teacher can manage student easily during practical training.</span>
              
              <div id="mainlogin">
              <?php 
              if($page=='userinfo') include('php/userinfo.php');
                ?>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </header>
     
    <!-- Main Content -->
    <main role="main" class="container">
      <div class="row">
        <div class="col-lg-8
          col-md-10  ">
          <div class="post-preview">
            <div id="maininfo">
              <a href="#" id="showall">Show all</a>
              </div>
              <div id="maincontent">
              <div class="row">
		<div class="col-sm-2">
    </div>
		<div class="col-sm-12">
		<?php
			//Here is the place for selecting the content to be displayed
			//based on user actions -> clicking menus etc
			if($page=='supervisors') include('php/supervisors.php');
			elseif($page=='newSupervisor') include('php/newSupervisor.php');
			elseif($page=='supervisorinfo') include('php/supervisorinfo.php');
      elseif($page=='editSupervisor') include('php/editSupervisor.php');
      elseif($page=='organisations') include('php/organisations.php');
      elseif($page=='newOrganisation') include('php/newOrganisation.php');
			elseif($page=='organisationInfo') include('php/organisationInfo.php');
      elseif($page=='editOrganisation') include('php/editOrganisation.php');
      elseif($page=='ontraining') include('php/ontrainingnow.php');
      elseif($page=='thisyear') include('php/thisyear.php');
      elseif($page=='notfinish') include('php/notfinish.php');
      elseif($page=='finished') include('php/finished.php');
      elseif($page=='allstudents') include('php/allstudents.php');
      elseif($page=='newStudent') include('php/newStudent.php');
			elseif($page=='studentInfo') include('php/studentInfo.php');
      elseif($page=='editStudent') include('php/editStudent.php');
      elseif($page=='trainingPlaceandStudent') include('php/trainingPlaceandStudent.php');
		?>
		</div>
	  </div>
              </div>
        </div>
      </div>
    </div>
    </main>

    <hr>

    <!-- Footer -->
    <footer class="footer1">
      <div role="main" class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <ul class="list-inline text-center">
              <li class="list-inline-item">
                <a  href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fas fa-circle fa-stack-1x"></i>
                    <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="https://www.facebook.com/yagami.raitokun.1">
                  <span class="fa-stack fa-lg">
                    <i class="fas fa-circle fa-stack-1x"></i>
                    <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fas fa-circle fa-stack-1x"></i>
                    <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
            </ul>
            <p class="copyright text-muted">Duc Ngo &copy; Your Website 2018
              <br> 
            School of Business and Culture 
              <br>
            Email:Duc.ngo@edu.lapinamk.fi 
              <br>
            Phone number: +358 40 322 8659
            </p>
          </div>
        </div>
      </div>
    </footer>

    <!--MODAL PARTS-->
	<!--loginfrm starts-->
	<div id="loginfrm" class="modal fade" role="dialog">
    <div class="modal-dialog">
     <!-- Modal content-->
     <div class="modal-content">
     <div class="modal-header">
       <h3 class="modal-title">Login</h3>
       <button type="button" class="close" data-dismiss="modal">&times;</button>
     </div>
     <div class="modal-body">
      <form class="form-signin" id="frmlogin">
       Email: <input class="form-control" type="email" id="email"   placeholder="Email" required >
       Password: <input class="form-control" type="password" id="password"  placeholder="Password" required >
       <input class="btn btn-lg btn-primary btn-block" type="submit" id="loginbtn" value="Login" >
      </form>
      <div id="logininfo"></div><!--Used to display messages, fail etc-->
       </div>
     <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
     </div>
     </div>
    </div>
   </div>
   <!--loginfrm ends-->
   
   <!--showStudent starts-->
   <div class="modal" id="showStudent">
    <div class="modal-dialog">
       <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
         <h4 class="modal-title" id="modStudentID"></h4>
         <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
     <h2>Student information</h2>
     
     <div id="modStudentText"></div>
     <div id="modTraining"></div>
     <div id="completed"></div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
         <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        </div>
       </div>
    </div>
   </div>
   <!--showStudent ends-->
   <!--addTraining starts here-->
     <div class="modal" id="addTraining">
    <div class="modal-dialog">
       <div class="modal-content">
       <!-- Modal Header -->
       <div class="modal-header">
         <h4 class="modal-title">Add training</h4>
         <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>
       <!-- Modal body -->
       <div class="modal-body" >
         <form class="form-signin" id="frmTraining">
       <input type="hidden" id="frmTrainingStudID" />
       <div class="form-group">
         <label for="start">Starting date:</label>
         <input type="date" class="form-control" id="start" />
       </div>
       <div class="form-group">
         <label for="end">Ending date:</label>
         <input type="date" class="form-control" id="end" />
       </div>
       <div class="form-group">
         <label for="place">Select place:</label>
         <select class="form-control" id="place">
         </select>
       </div>
       <div class="form-group">
         <label for="supervisor">Select supervisor:</label>
         <select class="form-control" id="supervisor">
         </select>
       </div>
       <div class="form-group">
         <label for="hours">Hours for supervising:</label>
         <input type="number" min="1" max="100" class="form-control" id="hours" />
       </div>
       <button type="submit" class="btn btn-primary">Add training</button>
     </form>
       </div>
       <!-- Modal footer -->
       <div class="modal-footer">
         <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
       </div>
       </div>
      </div>
   </main>
   <!--addTraining ends-->
 
   
 <!--END OF MODALS-->

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/clean-blog.min.js"></script>
    <script src="js/myApp.js"></script><!--myApp.js is the main UI programming part-->
    <script src="js/pwd.js"></script>

  </body>

</html>
