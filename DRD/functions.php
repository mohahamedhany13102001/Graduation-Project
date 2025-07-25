<?php
// error_reporting(0);

require_once("database/connection.php");

session_start();


function isUserLoggedIn ()
{
  $user = getLogginInUser();
  if ($user == null) {return false;}
  else {return true;}
}

function getLogginInUser ()
{
  if (!isset($_SESSION["email"]) || !isset($_SESSION["password"]))  return false;
  $email = $_SESSION['email'];
  $password = $_SESSION['password'];
  $user = $GLOBALS["db"]->readTable("users","WHERE email='{$email}' AND password='{$password}'");
  if (count($user) == 1) {return $user[0];}
  else {return null;}
}

function showHead()
{
    echo '<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="DRD Diabetic Diagnoze Retnia " />
    <meta name="description" content="" />
    <meta name="author" content="" />
  
    <title>DRD</title>
  
    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />
  
    <!-- font awesome style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  
    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700|Roboto:400,700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zeyada&display=swap" rel="stylesheet">
  
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />

    <link href="css/login.css" rel="stylesheet" />
  </head>';
}

function showHeader ()
{

    echo '<!-- header section strats -->
    <header class="header_section" style="">
      
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container pt-3">
          <a class="navbar-brand" href="index.php">
            <img src="images/project logo.png" alt="">
            <!-- <span>
              DRD
            </span> -->
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex  flex-column flex-lg-row align-items-center w-100 justify-content-between">
              <ul class="navbar-nav  ">
                <li class="nav-item">
                  <a class="nav-link" href="about.php"> About </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="service.php"> Service </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="knowledge.php"> Knowledge Base </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact.php">Contact us</a>
                </li>
              </ul>
              <form class="form-inline " action="search.php">
                <input type="search" placeholder="Search" name="searchtext">
                <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit" name="search"></button>
              </form>
              <div class="login_btn-contanier ml-0 ml-lg-5">';
              if (isUserLoggedIn())
              {
                $user = getLogginInUser();
                $name = explode(" ",$user["name"])[0];
                echo '<a href="profile.php">
                  <img src="images/user.png" alt="">
                  <span>
                    '.$name.'
                  </span>
                </a>';
                echo '<a href="logout.php">
                  <img src="images/user.png" alt="">
                  <span>Logout</span>
                </a>';
              }
              else
              {
                echo '<a href="login.php">
                  <img src="images/user.png" alt="">
                  <span>
                    Login
                  </span>
                </a>';
              }
              echo '</div>
            </div>
          </div>

        </nav>
      </div>
    </header>
    <!-- end header section -->';

}


function showFooter ()
{
    echo '<!-- info section -->
    <section class="info_section layout_padding2">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="info_contact">
              <h4>
                Contact
              </h4>
              <div class="box">
                <div class="img-box">
                  <img src="images/email.png" alt="">
                </div>
                <div class="detail-box">
                  <h6>
                    support@drd.com
                  </h6>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="info_menu">
              <h4>
                Menu
              </h4>
              <ul class="navbar-nav  ">
                <li class="nav-item">
                  <a class="nav-link" href="about.php"> About </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="service.php"> Service </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="knowledge.php"> Knowledge Base </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact.php"> Contact Us </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-6">
            <div class="info_news">
              <h4>
                Search
              </h4>
              <form action="search.php">
                <input type="text" placeholder="Search" name="searchtext">
                <div class="d-flex justify-content-center justify-content-end mt-3">
                  <button name="search">
                    Search
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  
  
    <!-- end info section -->
  
    <!-- footer section -->
    <section class="container-fluid footer_section">
      <p>
        &copy; 2023 All Rights Reserved. Design by
        <a target="_blank" href="https://www.modern-academy.edu.eg">DRD Team Modern Academy</a>
      </p>
    </section>
    <!-- footer section -->';
}


function endBodyScripts ()
{
    echo '<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js">
    </script>';
}


function submitMessage()
{
  $info = "";
  if (isset($_POST["sendmessage"]))
  {

    $name = mysqli_real_escape_string($GLOBALS['db']->connection,$_POST["username"]);
    $email = mysqli_real_escape_string($GLOBALS['db']->connection,$_POST["email"]);
    $phone = mysqli_real_escape_string($GLOBALS['db']->connection,$_POST["phone"]);
    $message = mysqli_real_escape_string($GLOBALS['db']->connection,$_POST["message"]);


    $sql = "INSERT INTO messages (name,email,phone,message) VALUES 
    ('{$name}','{$email}','{$phone}','{$message}')";
    $GLOBALS['db']->executeQuery($sql);

    $info = "Your message have been saved, We will contact you via email";
  }

  return $info;
}
