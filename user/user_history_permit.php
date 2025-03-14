<?php 
include('../user/assets/config/dbconn.php');
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('../user/inc/header.php'); ?>
</head>
<body class="vertical light">
    <div class="loader-mask">
        <div class="loader">
            <div></div>
            <div></div>
        </div>
    </div>
    <div class="wrapper">
        <?php include('../user/inc/navbar.php'); ?>
        <?php include('../user/inc/sidebar.php'); ?>
        <main role="main" class="main-content">
            <?php include('../user/inc/notif.php'); ?>

            <div class="data-card">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">History List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Number</th>
                                        <th scope="col">Address of Applicant</th>
                                        <th scope="col">Name of the Owner</th>
                                        <th scope="col">Lot Area</th>
                                        <th scope="col">Date of Application</th>
                                        <th scope="col">Period of Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="displayDataTable">
                                    <!-- Data will be loaded here from AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    displayData();
                });

                function displayData() {
                    $.ajax({
                        url: "user_history_permit_list_displaydata.php",
                        type: 'POST',
                        data: { displaysend: "true" },
                        success: function(data) {
                            $('#displayDataTable').html(data);
                        }
                    });
                }

                function deleteUser(deleteId) {
                    if (confirm("Are you sure you want to delete this record?")) {
                        $.ajax({
                            url: "user_history_permit_list_delete.php",
                            type: 'POST',
                            data: { deletesend: deleteId },
                            success: function(response) {
                                displayData();
                            }
                        });
                    }
                }
            </script>

        </main>
    </div>

    <?php include('../user/inc/footer.php'); ?>
</body>
</html>
