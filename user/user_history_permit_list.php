
<?php 
    include('../user/assets/config/dbconn.php');
    include('../employee/assets/config/dbconn.php');
    $pic_uploaded = 0;

    if(isset($_REQUEST['submit']))
    {

        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $mname = mysqli_real_escape_string($conn, $_POST['mname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $zip = mysqli_real_escape_string($conn, $_POST['zip']);
        $name_owner = mysqli_real_escape_string($conn, $_POST['name_owner']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $loc_lot = mysqli_real_escape_string($conn, $_POST['loc_lot']);
        $rightv_land = mysqli_real_escape_string($conn, $_POST['rightv_land']);
        $lot_area = mysqli_real_escape_string($conn, $_POST['lot_area']);
        $period_date = mysqli_real_escape_string($conn, $_POST['period_date']);
        $date_application = mysqli_real_escape_string($conn, $_POST['date_application']);
        $or_date = mysqli_real_escape_string($conn, $_POST['or_date']);
        
       
        $picture = time().$_FILES["picture"]['name'];
        if(move_uploaded_file($_FILES['picture']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'../user/assets/image/'.$picture))
        {
            $target_file = $_SERVER['DOCUMENT_ROOT'].'../user/assets/image/'.$picture;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $picturename = basename($_FILES['picture']['name']);
            $photo = time().$picturename;

            if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png")
            {?>
                <script>
                    alert("Please upload photo having extension .jpg/.jpeg/.png");
                </script>
            <?php
            }
            else if($_FILES["picture"]["size"] > 2000000)
            {?>
                <script>
                    alert("Your photo exceed the size of 2 MB");
                </script>
            <?php
            }
            else
            {
                $pic_uploaded = 1;
            }

        }
        

        if($pic_uploaded == 1)
        { 

        $sql = "INSERT INTO registration (fname, mname, lname, address,name_owner, phone, email, loc_lot,  
        lot_area, period_date, date_application, or_date,picture) 
            VALUES ('$id', '$fname', '$mname', '$lname', '$address','$name_owner', '$phone', '$email', '$loc_lot', 
        '$lot_area ', '$period_date', '$date_application', '$or_date', '$picture')";

        $result = mysqli_query($conn, $sql);
        if($result)
            {
                
                header("location: user_history_permit.php");
                
            }
        
        }
    }


    extract($_POST);

    if(isset($_POST['fnameSend']) && isset($_POST['lnameSend']) && isset($_POST['emailSend']) && isset($_POST['phoneSend']) && isset($_POST['addressSend']))
    {
        $sql = "INSERT INTO users (fname, lname, email, phone, address) 
                VALUES ('$fnameSend', '$lnameSend', '$emailSend', '$phoneSend', '$addressSend') ";

        $result = mysqli_query($conn, $sql);
    }
    exit(0);
?> 
