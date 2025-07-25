<?php
require_once ('functions.php');

$message = "";

if (isset($_POST["login"]))
{
  $email = mysqli_real_escape_string($GLOBALS['db']->connection,$_POST["email"]);
  $password = mysqli_real_escape_string($GLOBALS['db']->connection,$_POST["password"]);
    
  $password = hash("sha256",$password);

  $user = $GLOBALS["db"]->readTable("users","WHERE email='{$email}' AND password='{$password}'");

  if (count($user) == 1)
  {
    // login OK

    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;

    header("Location: index.php");
    exit();
  }
  else
  {
    // login failed
    $message = "Login Failed";
  }
}
?>


<!DOCTYPE html>
<html>
<?php showHead(); ?>

    <?php showHeader(); ?>

<section class="about_section layout_padding"> 
  <center>
<div class="screen-1">
  <center><img src="images/project logo.png" style="width:185px; margin:15px; margin-bottom:40px;"/></center>
  
  <?php
  if ($message != "")
  {
    echo '<h2 style="color:red; margin-bottom:20px;">'.$message.'</h2>';
  }
  ?>
  <form method="POST">
    <div class="email">
      <label for="email">Email Address</label>
      <div class="sec-2">
        <ion-icon name="mail-outline"></ion-icon>
        <input required type="email" name="email" placeholder="Username@gmail.com"/>
      </div>
    </div>
    <div class="password">
      <label for="password">Password</label>
      <div class="sec-2">
        <ion-icon name="lock-closed-outline"></ion-icon>
        <input required class="pas" type="password" name="password" placeholder="············"/>
        <ion-icon class="show-hide" name="eye-outline"></ion-icon>
      </div>
    </div>
    <button class="login" name="login">Login </button>
  </form>
  <center><div class="footer"><a href="signup.php"><span>Sign up</span></a><span>Forgot Password?</span></div></center>

</div>
</center>
</section>

    
    
    <?php showFooter(); ?>

  <?php endBodyScripts(); ?>

