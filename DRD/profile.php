<?php
require_once ('functions.php');
if (!isUserLoggedIn())
{
  header("Location: index.php");
  exit();    
}

$user = getLogginInUser();


$message = "";

if (isset($_POST["update"]))
{
  $fullname = mysqli_real_escape_string($GLOBALS['db']->connection,$_POST["fullname"]);
  $email = mysqli_real_escape_string($GLOBALS['db']->connection,$_POST["email"]);
  $password = mysqli_real_escape_string($GLOBALS['db']->connection,$_POST["password"]);
  $newpassword = mysqli_real_escape_string($GLOBALS['db']->connection,$_POST["newpassword"]);
  $age = mysqli_real_escape_string($GLOBALS['db']->connection,$_POST["age"]);
  $phone = mysqli_real_escape_string($GLOBALS['db']->connection,$_POST["phone"]);
  $country = mysqli_real_escape_string($GLOBALS['db']->connection,$_POST["country"]);
  $city = mysqli_real_escape_string($GLOBALS['db']->connection,$_POST["city"]);

  $password = hash("sha256",$password);
  $newpassword = hash("sha256",$newpassword);

  $u = $GLOBALS["db"]->readTable("users","WHERE email='{$email}' AND password='{$password}'");

  if ($age > 105 && $age< 0) 
  {
    $message = "Age can only be between 0 and 105";
  }
  else if (count($u) > 0)
  {
    // allow edits 
    $sql = "UPDATE users SET name='{$fullname}',email='{$email}',
    password='{$newpassword}',age='{$age}',phone='{$phone}',country='{$country}',city='{$city}' 
    WHERE id = '{$user['id']}'";

    $GLOBALS['db']->executeQuery($sql);

    header("Location: login.php");
    exit();    
  }
  else
  {
    $message = "Wrong email or Old password";
    
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
        <input required class="fullname" type="text" name="fullname" value="<?php echo $user['name'];?>"/>
        <ion-icon class="show-hide" name="eye-outline"></ion-icon>
      </div>
    </div>
    <div class="email">
      <label for="email">Email Address</label>
      <div class="sec-2">
        <ion-icon name="mail-outline"></ion-icon>
        <input required readonly type="email" name="email" value="<?php echo $user['email'];?>"/>
      </div>
    </div>
    <div class="password">
      <label for="password">Old Password</label>
      <div class="sec-2">
        <ion-icon name="lock-closed-outline"></ion-icon>
        <input required class="pas" type="password" name="password" value="<?php echo '';?>"/>
        <ion-icon class="show-hide" name="eye-outline"></ion-icon>
      </div>
    </div>
    <div class="password">
      <label for="password">New Password</label>
      <div class="sec-2">
        <ion-icon name="lock-closed-outline"></ion-icon>
        <input required class="pas" type="password" name="newpassword" value="<?php echo '';?>"/>
        <ion-icon class="show-hide" name="eye-outline"></ion-icon>
      </div>
    </div>

    <div class="text">
      <label for="age">Age</label>
      <div class="sec-2">
        <ion-icon name="lock-closed-outline"></ion-icon>
        <input required class="fullname" type="number" name="age" value="<?php echo $user['age'];?>"/>
        <ion-icon class="show-hide" name="eye-outline"></ion-icon>
      </div>
    </div>
    <div class="text">
      <label for="phone">Phone</label>
      <div class="sec-2">
        <ion-icon name="lock-closed-outline"></ion-icon>
        <input required class="fullname" type="text" name="phone" value="<?php echo $user['phone'];?>"/>
        <ion-icon class="show-hide" name="eye-outline"></ion-icon>
      </div>
    </div>
    <div class="text">
      <label for="country">Country</label>
      <div class="sec-2">
        <ion-icon name="lock-closed-outline"></ion-icon>
        <input required class="fullname" type="text" name="country" value="<?php echo $user['country'];?>"/>
        <ion-icon class="show-hide" name="eye-outline"></ion-icon>
      </div>
    </div>
    <div class="text">
      <label for="city">City</label>
      <div class="sec-2">
        <ion-icon name="lock-closed-outline"></ion-icon>
        <input required class="fullname" type="text" name="city" value="<?php echo $user['city'];?>"/>
        <ion-icon class="show-hide" name="eye-outline"></ion-icon>
      </div>
    </div>


    <button class="login" name="update">Update Profile </button>
  </form>

</div>
</center>
</section>

<section class="about_section layout_padding">
<center>
  <h1>Previous Services</h1>
  <table style="width: 80%; max-width:80%; margin: auto;" class="table table-bordered table-hover table-striped">
    <tr>
        <th>ID</th>
        <th>Report ID</th>
        <th>Report Date</th>
        <th>Patiant Name</th>
        <th>Severity Level</th>
        <th>View Report</th>
    </tr>

    <?php
    if ($user["id"] == 1)
    {
      // admin
      $reports = $GLOBALS['db']->readTable("services");
      
    }
    else
    {
      // normal user
      $reports = $GLOBALS['db']->readTable("services","WHERE user_id='{$user["id"]}'");
      
    }
      for ($i=0; $i<count($reports); $i++)
      {
        $reportuser = $GLOBALS['db']->readTable("users","WHERE id = '{$reports[$i]["user_id"]}'")[0];
        echo '<tr>
            <th>'.($i+1).'</th>
            <th>'.$reports[$i]["report_id"].'</th>
            <th>'.$reports[$i]["datetime"].'</th>
            <th>'.$reportuser["name"].'</th>
            <th>'.$reports[$i]["level"].'</th>
            <th><a href="report.php?report_id='.$reports[$i]["report_id"].'" target="_blank">View</a></th>
        </tr>
    ';
      }
    ?>
</table>
</center>
</section>

    
    
    <?php showFooter(); ?>

  <?php endBodyScripts(); ?>

