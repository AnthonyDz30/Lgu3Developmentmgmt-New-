<?php 
    include('../user/assets/config/dbconn.php');
    include('../user/inc/header.php');
    include('../user/inc/navbar.php');
    include('../user/inc/sidebar.php');

    if(isset($_POST['displaysend']))
    {
        $table = '<table class="table table-bordered">
                    <thead>
                        <tr>
                         <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Number</th>
                            <th scope="col">Address of Applicant</th>
                            <th scope="col">Name of the Owner</th>
                            <th scope="col">Lot area</th>
                            <th scope="col">Date of Application</th>
                            <th scope="col">Period of Date</th>
                            <th scope="col">Action</th>
                         
                        </tr>
                    </thead>';

        $sql = "SELECT * FROM registration";
        $result = mysqli_query($conn, $sql);
        $number = 1;
        while ($row = mysqli_fetch_assoc($result))
        {
            $id = $row['id'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $email = $row['email'];
            $phone = $row['phone'];
            $address = $row['address'];
            $name_owner = $row['name_owner'];
            $lot_area = $row['lot_area'];
            $date_application = $row['date_application'];
            $period_date = $row['period_date'];

            $table.='<tr>
                        <td scope="row">'.$number.'</td>
                        <td>'.$fname.'</td>
                        <td>'.$lname.'</td>
                        <td>'.$email.'</td>
                        <td>'.$phone.'</td>
                        <td>'.$address.'</td>
                        <td>'.$name_owner.'</td>
                        <td>'.$lot_area.'</td>
                        <td>'.$date_application.'</td>
                        <td>'.$period_date.'</td>
                        <td>
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Pending
                            </button>
                            <ul class="dropdown-menu">
                                <li><button class="btn btn-dark dropdown-item" onclick="getdetails('.$id.')"><i class="fa-sharp fa-solid fa-pen-to-square icon"></i>Update</button></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><button class="btn btn-danger dropdown-item" onclick="deleteuser('.$id.')"><i class="fa-solid fa-trash icon"></i> Delete</button></li>
                            </ul>
                            
                        </td>
                        </td>                       
                    </tr>';
                    $number++;
        }
        $table.='</table>';
        echo $table;
    }
?>

    
