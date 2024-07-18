<!DOCTYPE html>
<html lang="en">

<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Greensphere Admin</title>
<!-- plugins:css -->
<link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
<link rel="stylesheet" href="../vendors/base/vendor.bundle.base.css">
<!-- endinject -->s
<!-- inject:css -->
<link rel="stylesheet" href="../css/style.css">
<!-- endinject -->
<link rel="shortcut icon" href="../images/gs-logo-.png" />
</head>

<body>
<div class="container-scroller">
    <!-- partial:../partials/_navbar.html -->
    <?php
    include '../components/navbar.php';
    ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
    <!-- partial:../partials/_sidebar.html -->
    <?php include "../components/sidebar.html" ?>
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">                   
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Create New User</h4>
                                <form class="form-sample" method="POST" action="../php-files/create_users.php">
                                <p class="card-description">Personal info</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">First Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="first_name" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Last Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="last_name"  />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" name="email" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" name="password" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Address</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="address" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Contact Info</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="contact_info" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Preferred Username</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="username" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Status</label>
                                            <div class="col-sm-9">
                                                <div class="form-check">
                                                <input class="form-check-input" type="radio" name="statusRadio" id="statusActive" value="active" checked>
                                                <label class="form-check-label" for="statusActive">Active</label>
                                                <input class="form-check-input" type="radio" name="statusRadio" id="statusDisabled" value="disabled">
                                                <label class="form-check-label" for="statusDisabled">Disabled</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary btn-icon-text">
                                            <i class="ti-file btn-icon-prepend"></i>
                                            Create User
                                            </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Edit User</h4>
                                <p class="card-description">
                                    Search by ID
                                </p>
                                <form class="forms-sample" id="search-form">
                                    <div class="form-group">
                                        <label for="userId">User ID</label>
                                        <input type="text" class="form-control" id="userId" placeholder="User ID">
                                    </div>
                                    <button type="button" class="btn btn-primary me-2" onclick="searchUser()">Search</button>
                                </form>
                                <form class="forms-sample" id="update-form" style="display:none;" method="POST" action="../php-files/update_user.php">
                                        <input type="text" class="form-control" id="userid" name="userId" placeholder="ID" readonly hidden>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="firstName">First Name</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="lastName">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="contactInfo">Contact Info</label>
                                        <input type="text" class="form-control" id="contactInfo" name="contactInfo" placeholder="Contact Info">
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div>
                                            <input type="radio" class="form-check-input" name="status" id="statusActive" value="active" checked>
                                            <label class="form-check-label" for="statusActive">Active</label>
                                            <input type="radio" class="form-check-input" name="status" id="statusDisabled" value="disabled">
                                            <label class="form-check-label" for="statusDisabled">Disabled</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary me-2">Update</button>
                                    <button type="button" class="btn btn-light" onclick="resetForm()">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
 
                </div>
                <!-- content-wrapper ends -->
                <?php include "../components/footer.php"; ?>
            </div>
        
        </div>
    <!-- page-body-wrapper ends -->
    </div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="../vendors/base/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="../js/off-canvas.js"></script>
<script src="../js/hoverable-collapse.js"></script>
<script src="../js/template.js"></script>
<script src="../js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script>
function searchUser() {
    var userId = document.getElementById("userId").value;
    console.log(userId);
    fetch(`http://localhost:8090/api/v1/admin/users/get/${userId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Populate form fields with fetched data
            document.getElementById("userid").value = data.id;
            document.getElementById("firstName").value = data.first_name;
            document.getElementById("username").value = data.username;
            document.getElementById("lastName").value = data.last_name;
            document.getElementById("email").value = data.email;
            document.getElementById("password").value = data.password;
            document.getElementById("address").value = data.address;
            document.getElementById("contactInfo").value = data.contact_info;
            if (data.status) {
                document.getElementById("statusActive").checked = true;
            } else {
                document.getElementById("statusDisabled").checked = true;
            }

            // Show the update form
            document.getElementById("update-form").style.display = 'block';
        })
        .catch(error => {
            console.error('User not found / There was a problem with the fetch operation:', error);
            alert("User not found");
        });
}


function resetForm() {
    document.getElementById("update-form").reset();
    document.getElementById("update-form").style.display = "none";
}
</script>

<!-- End custom js for this page-->
</body>

</html>
