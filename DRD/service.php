<?php
require_once('functions.php');

$userLoggedIn = isUserLoggedIn();
$user = getLogginInUser();

$severityLevel = "";
$img = "";
$report_id = "";

if ($userLoggedIn && isset($_POST["checkResults"])) {
  $report_id = time();
  $target_dir = "uploads/";
  $target_file = $target_dir . $report_id . "." . pathinfo($_FILES["retinaImage"]["name"], PATHINFO_EXTENSION);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


  // Check if image file is a actual image or fake image

  $check = getimagesize($_FILES["retinaImage"]["tmp_name"]);
  if ($check !== false) {
    $errMsg = "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    $errMsg =  "File is not an image.";
    $uploadOk = 0;
  }


  // Check file size
  // if ($_FILES["retinaImage"]["size"] > 500000) {
  //   $errMsg =  "Sorry, your file is too large.";
  //   $uploadOk = 0;
  // }

  // Allow certain file formats
  if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $errMsg =  "Sorry, only JPG, JPEG, PNG files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo '<script>alert("' . $errMsg . '");</script>';
    // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["retinaImage"]["tmp_name"], $target_file)) {
    } else {
      $errMsg =  "Sorry, there was an error uploading your file.";
      echo '<script>alert("' . $errMsg . '");</script>';
    }
  }


  // Process image from python side
  $output = shell_exec('python core/core.py ' . $target_file);
  $severityLevel = $output;
  $img = $target_file;

  $datetime = date("d-m-Y H:i:s", $report_id);
  $sql = "INSERT INTO services (report_id,user_id,datetime,image,level) 
  VALUES ('{$report_id}','{$user["id"]}','{$datetime}','{$img}','{$severityLevel}')";
  $GLOBALS['db']->executeQuery($sql);

  // display results to user

}


?>
<!DOCTYPE html>
<html>
<?php showHead(); ?>

<div>
  <?php showHeader(); ?>

  <center>
    <div class="justify-content-center justify-content-end mt-3">
      <h4>Upload Retnia Image:</h4>
      <form method="post" enctype="multipart/form-data">
        <input required="" type="file" name="retinaImage" accept=".jpg, .png, .jpeg">
        <button class="custom_botton" name="checkResults" onclick="document.getElementById('spinner').style.display='block';">Check Results</button>
      </form>
    </div>
  </center>

  <center>
    <div id="spinner" class="loader" style="display:none;"></div>
  </center>

  <center><iframe src="report.php?report_id=<?php echo $report_id; ?>" style="border:1px black solid; padding:10px; min-height: 100vh;" class="container justify-content-center justify-content-end mt-3">
    </iframe>
  </center>


</div>


<?php showFooter(); ?>

<?php endBodyScripts(); ?>