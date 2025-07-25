<?php
require_once ('functions.php');

$info = submitMessage();


?>


<!DOCTYPE html>
<html>
<?php showHead(); ?>

    <?php showHeader(); ?>

    <center style="margin-top:50px;"><h2><?php echo $info;?></h2></center>
    <section class="contact_section" style="margin-top:50px;">
    <div class="container">
      <div class="row">
        <div class="custom_heading-container ">
          <h2>
            Send Us A Message
          </h2>
        </div>
      </div>
    </div>
    <div class="container layout_padding2">
      <div class="row">
        <div class="col-md-5">
          <div class="form_contaier">
            <form method="POST">
              <div class="form-group">
                <label for="exampleInputName1">Name</label>
                <input required type="text" class="form-control" name="username">
              </div>
              <div class="form-group">
                <label for="exampleInputNumber1">Phone Number</label>
                <input required type="text" class="form-control" name="phone">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Email </label>
                <input required type="email" class="form-control" name="email">
              </div>
              <div class="form-group">
                <label for="exampleInputMessage">Message</label>
                <textarea required rows="4" class="form-control" name="message"></textarea>
              </div>
              <button type="submit" name="sendmessage">Send</button>
            </form>
          </div>
        </div>
        <div class="col-md-7">
          <div class="detail-box">
            <h3>
              Get Now Medicines
            </h3>
            <p>
              There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
              in some form, by injected humour, or randomised words which don't look even slightly believable.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  

    
    
    <?php showFooter(); ?>

  <?php endBodyScripts(); ?>

