<?php
require_once ('functions.php');

if (isset($_GET["search"]))
{

  $text = mysqli_real_escape_string($GLOBALS['db']->connection,$_GET["searchtext"]);

  $sql = "SELECT * FROM knowledge WHERE title LIKE '%{$text}%' 
  OR content LIKE '%{$text}%'";

  $articles = $GLOBALS['db']->executeQuery($sql);
  
}
else
{
  $articles = [];
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
          Search Results
        </h2>
      </div>

      <div class="detail-box">
        <?php
        if (count($articles) == 0)
        {
          echo '<h2 style="color:red;">No Results Found Match Your Search</h2>';
        }
        else
        {
          for ($i=0; $i<count($articles); $i++)
          {
            echo '<div><a href="article.php?id='.$articles[$i]["id"].'" >'.$articles[$i]["title"].'</a></div>';
          }
        }

        ?>
        
      </div>
    </div>
  </section>

    
    
    <?php showFooter(); ?>

  <?php endBodyScripts(); ?>

