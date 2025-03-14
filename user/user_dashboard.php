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
    <div class="card-info">
        <a href="user_history_permit.php">
            <div class="card-data">
             <i class='bx bxs-user-detail icon'></i>
                <div>
                    <h3>1</h3>
                    <span>Total Registration</span>
               
                </div>
                 
            </div>
        </a>
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