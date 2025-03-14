<?php
// Retrieve error message if set, then unset it
$errorMessage = isset($_SESSION['error']) ? $_SESSION['error'] : null;
unset($_SESSION['error']); // Remove error from session after retrieving
?>

<!-- Toast Notification -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
    <div id="errorToast" class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="toastMessage"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    console.log("Toast script loaded."); // Debugging

    var errorMessage = <?= json_encode($errorMessage) ?>; // Secure encoding

    if (errorMessage) {
        console.log("Error message found:", errorMessage); // Debugging
        document.getElementById("toastMessage").innerHTML = errorMessage;

        var toastEl = document.getElementById("errorToast");
        var toast = new bootstrap.Toast(toastEl); // Initialize Bootstrap toast
        toast.show(); // Show the toast
    }
});
</script>
