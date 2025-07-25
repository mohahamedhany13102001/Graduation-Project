<?php
require_once ('functions.php');

$articles = $GLOBALS['db']->readTable("knowledge");


?>


<!DOCTYPE html>
<html>
<?php showHead(); ?>

    <?php showHeader(); ?>

    <section class="about_section layout_padding">
    <div class="container">
      <div class="custom_heading-container ">
        <h2>
          Knowledge Database
        </h2>
      </div>

      <div class="detail-box">
        <?php
          for ($i=0; $i<count($articles); $i++)
          {
            echo '<div><a href="article.php?id='.$articles[$i]["id"].'" >'.$articles[$i]["title"].'</a></div>';
          }


        ?>
        
      </div>
    </div>
  </section>

    
    
    <?php showFooter(); ?>

  <?php endBodyScripts(); ?>

