<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Navbar -->
<nav class="topnav navbar navbar-light">
    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>
    
        
    </form>
    <ul class="nav">
        <li class="nav-item">
            <section class="nav-link text-muted my-2 circle-icon" href="#" data-toggle="modal" data-target=".modal-shortcut">
                <span class="fe fe-message-circle fe-16"></span>
            </section>
        </li>
        <li class="nav-item nav-notif">
            <section class="nav-link text-muted my-2 circle-icon" href="#" data-toggle="modal" data-target=".modal-notif">
                <span class="fe fe-bell fe-16"></span>
                <span id="notification-count" style="
                    position: absolute;
                    top: 12px; right: 5px;
                    font-size:13px; color: white;
                    background-color: red;
                    width:8px;
                    height: 8px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    border-radius: 50px;
                ">
                </span>
            </section>
        </li>
        <li class="nav-item dropdown">
            <span class="nav-link text-muted pr-0 avatar-icon" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="avatar avatar-sm mt-2">
                    <div class="avatar-img rounded-circle avatar-initials-min text-center position-relative"></div>
                </span>
            </span>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                
                <a class="dropdown-item" href="user_settings.php"><i class="fe fe-settings"></i>&nbsp;&nbsp;&nbsp;Settings</a>
                <a class="dropdown-item" href="#" onclick="confirmLogout(event)"><i class="fe fe-log-out"></i>&nbsp;&nbsp;&nbsp;Log Out</a>
            </div>
        </li>
    </ul>
</nav>

<script>
    function confirmLogout(event) {
        event.preventDefault(); // Prevent default logout action

        Swal.fire({
            title: "Are you sure?",
            text: "You will be logged out!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, logout!",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "../logout.php"; // Redirect if confirmed
            }
        });
    }
</script>
