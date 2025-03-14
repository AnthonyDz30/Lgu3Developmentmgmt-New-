<?php
include('../user/assets/config/dbconn.php');

if (!isset($_POST['displaysend'])) {
    die("No data received.");
}

$query = "SELECT * FROM registration"; // Replace with actual table name
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
