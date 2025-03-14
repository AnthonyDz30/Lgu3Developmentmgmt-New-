<?php 
include('../user/assets/config/dbconn.php');

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('../user/inc/header.php');
    ?>
    
</head>
    
    <div class="loader-mask">
        <div class="loader">
            <div></div>
            <div></div>
        </div>
    </div>
    
 
  <body class="vertical  light">
    <div class="wrapper">
    <div class="wrapper">


    <?php include('../user/inc/navbar.php');
        ?>
    <?php include('../user/inc/sidebar.php');
        ?>

      <main role="main" class="main-content">

<!--For Notification header naman ito-->
        <?php include('../user/inc/notif.php'); 
        ?>

<!--YOUR CONTENTHERE-->
<div class="data-card">
    <div class="card">
        <div class="card-header">
        </div>


        <div class="card-body">
            <div class="row">
                <div class="col-md-12">

                    <div class="card text-center">
                        <div class="card-header" style="background: blue;">
                            Featured
                        </div>
                        <div class="card-body" style="background: #fff;">
                            <h5 class="card-title">To all users</h5>
                            <p class="card-text">Fucking Shit   </p>
                            <a href="#" class="btn btn-primary">Go To Info For More Guideline.</a>
                        </div>
                        <div class="card-footer text-body-secondary" style="background: blue;">
                            2 days ago
                        </div>
                    </div>  


                </div>
            </div>
        </div>
    </div>
</div>
    </main>
    </div>
    </div>
    
    <!-- Include jQuery (once) -->
    <?php 
include('../user/inc/footer.php');
?> 
</body>
</html>