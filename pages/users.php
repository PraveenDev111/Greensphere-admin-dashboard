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
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Users Data</h4>
                  <p class="card-description">
                    All users in database
                    <!--Add class <code>.table</code>-->
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>U_ID</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Created</th>
                          <th>Updated</th>
                          <th>Status</th>
                          <th>First name</th>
                          <th>Last name</th>
                          <th>Address</th>
                          <th>Contact info</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      if (isset($_SESSION['status_message'])) {
                        echo "<script>alert('" . $_SESSION['status_message'] . "');</script>";
                        unset($_SESSION['status_message']); // Clear the message after displaying it
                    }
                  // URL of the Spring Boot API
                  $url = "http://localhost:8090/api/v1/admin/users/all";

                  // Initialize cURL
                  $ch = curl_init($url);

                  // Set cURL options
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

                  // Execute cURL request
                  $response = curl_exec($ch);

                  // Close cURL session
                  curl_close($ch);

                  // Decode the JSON response
                  $data = json_decode($response, true);

                  // Check if the response contains data
                  if (!empty($data)) {
                      // Iterate over each user
                      foreach ($data as $row) {
                          $id = htmlspecialchars($row["id"]);
                          $status = ($row["status"]) ? "Active" : "Disabled";
                          $username = htmlspecialchars($row["username"]); // Avoid XSS attacks
                          $email = htmlspecialchars($row["email"]);
                          $createdDateTime = substr(htmlspecialchars($row["createdDateTime"]), 0, 19);
                          $updatedDateTime = substr(htmlspecialchars($row["updatedDateTime"]), 0, 19);
                          $fname = htmlspecialchars($row["first_name"]);
                          $lname = htmlspecialchars($row["last_name"]);
                          $contact = htmlspecialchars($row["contact_info"]);
                          $address = htmlspecialchars($row["address"]);
                          //button color for status change
                          $buttonColor = $row["status"] ? "#28a745" : "#dc3545";

                          echo <<<HTML
                          <tr>
                              <td>{$id}</td>
                              <td>{$username}</td>
                              <td>{$email}</td>
                              <td>{$createdDateTime}</td>
                              <td>{$updatedDateTime}</td>
                              <td>
                                <form method="POST" action="../php-files/update_status.php">
                                      <input type="hidden" name="user_id" value="{$id}">
                                      <input type="hidden" name="current_status" value="{$row['status']}">
                                      <button type="submit" style="padding:10px; width:170px;border: none; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  border-radius: 5px; cursor: pointer;color: white; background-color: {$buttonColor}">{$status} | Change</button>
                                  </form>
                              </td>
                              <td>{$fname}</td>
                              <td>{$lname}</td>
                              <td>{$address}</td>
                              <td>{$contact}</td>
                          </tr>
                          HTML;
                      }
                  } else {
                      echo "<tr><td colspan='6'>No data found</td></tr>";
                  }
                  ?>


                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <?php include "../components/footer.php"; ?>
      </div>
      <!-- main-panel ends -->
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
  <!-- End custom js for this page-->
</body>

</html>
