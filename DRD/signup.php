<?php
require_once ('functions.php');

$message = "";

if (isset($_POST["signup"]))
{
  $fullname = mysqli_real_escape_string($GLOBALS['db']->connection,$_POST["fullname"]);
  $email = mysqli_real_escape_string($GLOBALS['db']->connection,$_POST["email"]);
  $password = mysqli_real_escape_string($GLOBALS['db']->connection,$_POST["password"]);
  $age = mysqli_real_escape_string($GLOBALS['db']->connection,$_POST["age"]);
  $phone = mysqli_real_escape_string($GLOBALS['db']->connection,$_POST["phone"]);
  $country = mysqli_real_escape_string($GLOBALS['db']->connection,$_POST["country"]);
  $city = mysqli_real_escape_string($GLOBALS['db']->connection,$_POST["city"]);

  $password = hash("sha256",$password);

  $user = $GLOBALS["db"]->readTable("users","WHERE email='{$email}' AND password='{$password}'");

  if ($age > 105 && $age< 0) 
  {
    $message = "Age can only be between 0 and 105";
  }
  else if (count($user) > 0)
  {
    // sigup failed
    $message = "Your email already signed up in our website";
  }
  else
  {
    $sql = "INSERT INTO users (name,email,password,age,phone,country,city) 
    VALUES ('{$fullname}','{$email}','{$password}','{$age}','{$phone}','{$country}','{$city}')";

    $GLOBALS['db']->executeQuery($sql);

    header("Location: login.php");
    exit();    
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

    <div class="text">
      <label for="fullname">Full Name</label>
      <div class="sec-2">
        <ion-icon name="lock-closed-outline"></ion-icon>
        <input required class="fullname" type="text" name="fullname" placeholder="Your Name"/>
        <ion-icon class="show-hide" name="eye-outline"></ion-icon>
      </div>
    </div>
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

    <div class="text">
      <label for="age">Age</label>
      <div class="sec-2">
        <ion-icon name="lock-closed-outline"></ion-icon>
        <input required class="fullname" type="number" name="age" placeholder="30"/>
        <ion-icon class="show-hide" name="eye-outline"></ion-icon>
      </div>
    </div>
    <div class="text">
      <label for="phone">Phone</label>
      <div class="sec-2">
        <ion-icon name="lock-closed-outline"></ion-icon>
        <input required class="fullname" type="text" name="phone" placeholder="01234567891"/>
        <ion-icon class="show-hide" name="eye-outline"></ion-icon>
      </div>
    </div>
    <div class="text">
      <label for="country">Country</label>
      <div class="sec-2">
        <ion-icon name="lock-closed-outline"></ion-icon>
        <input required class="fullname" type="text" name="country" placeholder="Egypt"/>
        <ion-icon class="show-hide" name="eye-outline"></ion-icon>
      </div>
    </div>
    <div class="text">
      <label for="city">City</label>
      <div class="sec-2">
        <ion-icon name="lock-closed-outline"></ion-icon>
        <input required class="fullname" type="text" name="city" placeholder="Cairo"/>
        <ion-icon class="show-hide" name="eye-outline"></ion-icon>
      </div>
    </div>


    <button class="login" name="signup">Signup </button>
  </form>

</div>
</center>
</section>

    
    
    <?php showFooter(); ?>

  <?php endBodyScripts(); ?>

