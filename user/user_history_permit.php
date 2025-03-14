<?php  
include('../user/assets/config/dbconn.php');
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <title>History List</title>
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
                                        <th scope="col">Middle Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">ZIP</th>
                                        <th scope="col">Lot Location</th>
                                        <th scope="col">Lot Area</th>
                                        <th scope="col">Date of Application</th>
                                        <th scope="col">Period of Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="displayDataTable">
                                    <?php
                                    // Fetch Data from Database
                                    $query = "SELECT * FROM registration"; // Replace with your actual table name
                                    $result = mysqli_query($conn, $query);

                                    if (!$result) {
                                        die("SQL Error: " . mysqli_error($conn));
                                    }

                                    $number = 1;
                                    while ($row = mysqli_fetch_assoc($result)) { 
                                        echo "<tr>
                                                <td>{$number}</td>
                                                <td>" . htmlspecialchars($row['fname']) . "</td>
                                                <td>" . htmlspecialchars($row['mname']) . "</td>
                                                <td>" . htmlspecialchars($row['lname']) . "</td>
                                                <td>" . htmlspecialchars($row['email']) . "</td>
                                                <td>" . htmlspecialchars($row['phone']) . "</td>
                                                <td>" . htmlspecialchars($row['address']) . "</td>
                                                <td>" . htmlspecialchars($row['zip']) . "</td>
                                                <td>" . htmlspecialchars($row['loc_lot']) . "</td>
                                                <td>" . htmlspecialchars($row['lot_area']) . "</td>
                                                <td>" . htmlspecialchars($row['date_application']) . "</td>
                                                <td>" . htmlspecialchars($row['period_date']) . "</td>
                                                <td>
                                                    <form method='POST' action='delete_user.php'>
                                                        <input type='hidden' name='delete_id' value='" . $row['id'] . "'>
                                                        <button type='submit' class='btn btn-danger'>Delete</button>
                                                    </form>
                                                </td>
                                            </tr>";
                                        $number++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <?php include('../user/inc/footer.php'); ?>
</body>
</html>
