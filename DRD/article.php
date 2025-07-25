<?php
require_once ('functions.php');

if (!isset($_GET['id']))
{
  header("Location: index.php");
  exit();
}

$id = $_GET["id"];

$ar = $GLOBALS['db']->readTable("knowledge","WHERE id = '{$id}'");
if (count($ar) == 0) 
{
  header("Location: index.php");
  exit();
}

?>


<!DOCTYPE html>
<html>
<?php showHead(); ?>

    <?php showHeader(); ?>

    <section class="about_section layout_padding">
    <div class="container">
      <div class="custom_heading-container ">
        <h2>
          <?php echo $ar[0]["title"];?>
        </h2>
      </div>

      <div class="detail-box">
        <?php
         echo $ar[0]["content"];
        ?>
        
      </div>
    </div>
  </section>

    
    
    <?php showFooter(); ?>

  <?php endBodyScripts(); ?>

