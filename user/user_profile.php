<?php 
include('../user/assets/config/dbconn.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile</title>
    <?php include('../user/inc/header.php'); ?>
    <link rel="stylesheet" href="assets/css/profile.css">
</head>

<body class="vertical light">
    <div class="wrapper">
        <?php include('../user/inc/navbar.php'); ?>
        <?php include('../user/inc/sidebar.php'); ?>

        <main role="main" class="main-content">
            <?php include('../user/inc/notif.php'); ?>

            <div class="container profile-container">
                <!-- Profile Card -->
                <div class="profile-card">
                    <img src="../user/images/profile.png" class="profile-pic" alt="Profile Image">
                    <h4>System User</h4>
                    <p class="username">@System_user</p>
                    <div class="profile-info">
                        <p><strong>Full Name:</strong> Ed Fernandez</p>
                        <p><strong>Email:</strong> ed@mail.com</p>
                    </div>
                </div>

                <!-- Profile Settings -->
                <div class="profile-settings">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a href="#updateProfile" data-toggle="tab" class="nav-link active">
                                <i class="fas fa-user-edit"></i> Update Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#changePassword" data-toggle="tab" class="nav-link">
                                <i class="fas fa-lock"></i> Change Password
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- Update Profile Section -->
                        <div class="tab-pane show active" id="updateProfile">
                            <h5><i class="fas fa-user"></i> Personal Info</h5>
                            <form method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><i class="fas fa-user"></i> First Name</label>
                                            <input type="text" name="fname" class="form-control" value="Ed" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><i class="fas fa-user"></i> Last Name</label>
                                            <input type="text" name="lname" class="form-control" value="Fernandez" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label><i class="fas fa-envelope"></i> Email Address</label>
                                    <input type="email" name="email" class="form-control" value="ed@mail.com" required>
                                </div>

                                <div class="form-group">
                                    <label><i class="fas fa-image"></i> Profile Picture</label>
                                    <input type="file" name="profile-pic" class="form-control">
                                </div>

                                <button type="submit" name="update_profile" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save"></i> Save Changes
                                </button>
                            </form>
                        </div>

                        <!-- Change Password Section -->
                        <div class="tab-pane" id="changePassword">
                            <h5><i class="fas fa-key"></i> Change Password</h5>
                            <form method="post">
                                <div class="form-group">
                                    <label><i class="fas fa-lock"></i> Old Password</label>
                                    <input type="password" name="old_password" class="form-control" placeholder="Enter Old Password" required>
                                </div>
                                <div class="form-group">
                                    <label><i class="fas fa-key"></i> New Password</label>
                                    <input type="password" name="new_password" class="form-control" placeholder="Enter New Password" required>
                                </div>
                                <div class="form-group">
                                    <label><i class="fas fa-check-circle"></i> Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm New Password" required>
                                </div>

                                <button type="submit" name="update_password" class="btn btn-success btn-lg">
                                    <i class="fas fa-key"></i> Update Password
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php include('../user/inc/footer.php'); ?>
</body>
</html>
