<?php  
session_start();
include('../user/assets/config/dbconn.php'); // Database connection

// Generate CSRF token only if it's not set
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // CSRF Token Validation
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['error'] = "CSRF validation failed. Please try again.";
        header("Location: user_application_permit.php");
        exit;
    }
    
    unset($_SESSION['csrf_token']); // Regenerate CSRF token after submission

    function clean_input($data) {
        return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
    }

    // Sanitize user input
    $fields = ['date_application', 'reciept', 'or_date', 'fname', 'mname', 'lname', 'address', 'zip', 'name_owner', 'phone', 'email', 'loc_lot', 'rightv_land', 'lot_area', 'period_date'];
    $input_data = [];

    foreach ($fields as $field) {
        $input_data[$field] = clean_input($_POST[$field] ?? '');
    }

    // Validate Email
    if (!filter_var($input_data['email'], FILTER_VALIDATE_EMAIL) || 
        !preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|net|org|gov|edu|ph|io|co\.uk)$/i', $input_data['email'])) {
        $_SESSION['error'] = "Invalid email format. Use .com, .net, etc.";
        header("Location: user_application_permit.php");
        exit;
    }

    // Check if Receipt Number Exists
    $stmt = $conn->prepare("SELECT COUNT(*) FROM registration WHERE reciept = ?");
    $stmt->bind_param("s", $input_data['reciept']);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        $_SESSION['error'] = "Official Receipt No. already exists.";
        header("Location: user_application_permit.php");
        exit;
    }

    // File upload handling
    $uploadOk = 1;
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'pdf', 'docx'];
    $target_dir = "../user/assets/uploads/";

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $file_name = NULL;
    if (!empty($_FILES["picture"]["name"])) {
        $file_tmp = $_FILES["picture"]["tmp_name"];
        $file_ext = strtolower(pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION));
        $file_size = $_FILES["picture"]["size"];
        $mime_type = mime_content_type($file_tmp);

        $allowed_mime_types = ['image/jpeg', 'image/png', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];

        if (!in_array($file_ext, $allowed_extensions) || !in_array($mime_type, $allowed_mime_types)) {
            $_SESSION['error'] = "Invalid file type. Only JPG, JPEG, PNG, DOCX & PDF files are allowed.";
            header("Location: user_application_permit.php");
            exit;
        }

        if ($file_size > 2000000) {
            $_SESSION['error'] = "File size too large. Max 2MB allowed.";
            header("Location: user_application_permit.php");
            exit;
        }

        $file_name = uniqid("file_") . "." . $file_ext;
        $target_file = $target_dir . $file_name;

        if (!move_uploaded_file($file_tmp, $target_file)) {
            $_SESSION['error'] = "Error uploading file. Please try again.";
            header("Location: user_application_permit.php");
            exit;
        }
    }

    // Insert data into database
    try {
        $stmt = $conn->prepare("INSERT INTO registration 
            (date_application, reciept, or_date, fname, mname, lname, address, zip, name_owner, phone, email, loc_lot, rightv_land, lot_area, period_date, file_name) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssssssssssssssss", 
            $input_data['date_application'], $input_data['reciept'], $input_data['or_date'], 
            $input_data['fname'], $input_data['mname'], $input_data['lname'], 
            $input_data['address'], $input_data['zip'], $input_data['name_owner'], 
            $input_data['phone'], $input_data['email'], $input_data['loc_lot'], 
            $input_data['rightv_land'], $input_data['lot_area'], $input_data['period_date'], 
            $file_name);

        if ($stmt->execute()) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Regenerate CSRF token only on success
            $_SESSION['success'] = "Application submitted successfully!";
            header("Location: user_application_permit.php");
            exit;
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Error submitting application. Please try again.";
        header("Location: user_application_permit.php");
        exit;
    }

    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('../user/inc/header.php'); ?>
</head>
<body class="vertical light">
    <div class="wrapper">
        <?php include('../user/inc/navbar.php'); ?>
        <?php include('../user/inc/sidebar.php'); ?>
        <main role="main" class="main-content">
            <?php include('../user/inc/notif.php'); ?>
            <div class="data-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="row g-3" id="validated_form" method="post" action="user_application_permit.php" enctype="multipart/form-data">
                                    <!-- CSRF Token for protection -->
                                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                                    <div class="top-form text-center">
                                        <h6>Republic of the Philippines</h6>
                                        <h6>San Agustin, Metropolitan Manila</h6>
                                        <h6>Application Permit & Licence Office</h6>
                                        <h5>APPLICATION FORM FOR ZONING PERMIT</h5>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="date_application" class="form-label">Date of Application:</label>
                                        <input type="date" class="form-control" id="date_application" name="date_application" required>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="reciept" class="form-label">Official Receipt No.:</label>
                                        <input type="text" class="form-control" id="reciept" name="reciept" placeholder="Official Receipt No." required>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="or_date" class="form-label">O.R. Date:</label>
                                        <input type="date" class="form-control" id="or_date" name="or_date" required>
                                    </div>
                                    <hr>
                                    <div class="col-md-4">
                                        <label for="fname" class="form-label">First name:</label>
                                        <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="mname" class="form-label">Middle name:</label>
                                        <input type="text" class="form-control" id="mname" name="mname" placeholder="Middle name" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="lname" class="form-label">Last name:</label>
                                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" required>
                                    </div>
                                    <div class="col-8">
                                        <label for="address" class="form-label">Address of Applicant:</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                                    </div>
                                    <div class="col-4">
                                        <label for="zip" class="form-label">Zip:</label>
                                        <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="name_owner" class="form-label">Name of the Owner:</label>
                                        <input type="text" class="form-control" id="name_owner" name="name_owner" placeholder="Name of owner" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="phone" class="form-label">Contact #:</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Contact #" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="email" class="form-label">Email Address:</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                                    </div>

                                    <script>
                                    document.getElementById('validated_form').addEventListener('submit', function(event) {
                                        let emailInput = document.getElementById('email').value;
                                        let emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

                                        if (!emailRegex.test(emailInput)) {
                                            alert("Invalid email format. Please enter a valid email.");
                                            event.preventDefault(); // Stops form submission
                                        }
                                    });
                                    </script>


                                    <div class="col-md-4">
                                        <label for="loc_lot" class="form-label">Location of Lot:</label>
                                        <input type="text" class="form-control" id="loc_lot" name="loc_lot" placeholder="Address" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="rightv_land" class="form-label">Right Over Land:</label>
                                        <input type="text" class="form-control" id="rightv_land" name="rightv_land" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="lot_area" class="form-label">Lot Area:</label>
                                        <input type="text" class="form-control" id="lot_area" name="lot_area" placeholder="SQM" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="period_date" class="form-label">Period of Date:</label>
                                        <input type="date" class="form-control" id="period_date" name="period_date" required>
                                    </div>
                                    <hr>
                                    <div class="col-md-4">
                                        <label for="picture" class="form-label">Upload File:</label>
                                        <div class="input-group">
                                            <label class="input-group-text btn btn-primary text-white" for="picture">
                                                <i class="bi bi-upload"></i> Select File
                                            </label>
                                            <input type="file" class="d-none" id="picture" name="picture" required onchange="updateFileName(this)">
                                            <span id="file-name" class="form-control bg-white" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;" title="No file chosen">
                                                No file chosen
                                            </span>
                                        </div>
                                    </div>

                                    <script>
                                    function updateFileName(input) {
                                        if (input.files.length > 0) {
                                            let fullName = input.files[0].name;
                                            let displayName = fullName;

                                            // Limit filename length (e.g., 30 characters)
                                            const maxLength = 30;
                                            if (fullName.length > maxLength) {
                                                displayName = fullName.substring(0, maxLength - 3) + "...";
                                            }

                                            let fileNameSpan = document.getElementById("file-name");
                                            fileNameSpan.textContent = displayName;
                                            fileNameSpan.title = fullName; // Show full name on hover
                                        }
                                    }
                                    </script>

                                    <hr>
                                    <div class="col-12">
                                    <button type="button" class="btn btn-primary" id="openConfirmModal">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border shadow-sm rounded-0">
      <div class="modal-header bg-light text-dark border-bottom">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-exclamation-circle text-warning"></i> Confirm Submission
        </h5>
      </div>
      <div class="modal-body text-center">
        <p class="fs-5 text-dark">Are you sure you want to submit your application?</p>
        <p class="text-muted small">Make sure all information is correct before proceeding.</p>
      </div>
      <div class="modal-footer d-flex justify-content-center border-top">
        <button type="button" class="btn btn-outline-secondary px-4 py-2 fw-bold" data-bs-dismiss="modal">
          <i class="bi bi-x-circle"></i> No, Go Back
        </button>
        <button type="button" class="btn btn-primary px-4 py-2 fw-bold" id="confirmSubmit">
          <i class="bi bi-check-circle"></i> Yes, Submit
        </button>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript Fix -->
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("validated_form");
    const openConfirmModal = document.getElementById("openConfirmModal");
    const confirmSubmit = document.getElementById("confirmSubmit");

    // Check form before opening modal
    openConfirmModal.addEventListener("click", function() {
      if (form.checkValidity()) {
        new bootstrap.Modal(document.getElementById('confirmModal')).show(); // Open modal only if valid
      } else {
        alert("Please fill in all required fields before submitting.");
      }
    });

    // Submit the form when clicking "Yes, Submit"
    confirmSubmit.addEventListener("click", function() {
      form.submit();
    });
  });
</script>

    <?php include 'alert.php'; ?>
    <?php include('../user/inc/footer.php'); ?>
</body>
</html>
