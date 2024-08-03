<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>GS | All users</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../vendors/base/vendor.bundle.base.css">
  <!-- endinject -->s
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/gs-logo-.png"  type="image/png"/> 
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
        <div class="content-wrapper" >
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <div class="row">
                <div class="col-lg-12 d-flex flex-column flex-lg-row justify-content-between align-items-center">
                  <h4 class="card-title mb-3 mb-lg-0">All users</h4>
                  <div class="form-outline flex-grow-1 mb-3 mb-lg-0" data-mdb-input-init style="padding: 0 2em;">
                      <input type="text" id="search-input" onkeyup="searchUsers()" class="form-control" placeholder="Search users..." aria-label="Search">
                  </div>
                  <div class="pagination">
                      <div class="btn-group pagination" role="group" aria-label="Basic example">
                        <button id="prev-page" class="btn btn-primary" onclick="changePage(-1)" disabled>Previous</button>&nbsp;
                        <button id="next-page" class="btn btn-primary" onclick="changePage(1)">Next</button>
                      </div>
                    </div>
                  </div>
                  <p class="card-description">
                    All users in database - scroll right to make changes
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
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody id="user-table-body">
                      </tbody>
                    </table>
                  </div>
                  <div class="pagination">
                    <div class="btn-group pagination" role="group" aria-label="Basic example">
                      <button id="prev-page" class="btn btn-primary" onclick="changePage(-1)" disabled>Previous</button>&nbsp;
                      <button id="next-page" class="btn btn-primary" onclick="changePage(1)">Next</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <?php include "../components/footer.php"; ?>
        <script>
    let currentPage = 0;
    const limit = 25;
    let allUsers = [];

    document.addEventListener('DOMContentLoaded', function() {
      fetchAllUsers(); 
        fetchUsers(currentPage, limit);
    });

    function fetchUsers(page, limit) {
        const url = `http://localhost:8090/api/v1/admin/users/all?offset=${page}&limit=${limit}`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                populateTable(data);
                document.getElementById('prev-page').disabled = (page === 0);
                document.getElementById('next-page').disabled = (data.length < limit);
            })
            .catch(error => {
                console.error('Error fetching user data:', error);
            });
    }
    function fetchAllUsers() {
        fetch('http://localhost:8090/api/v1/admin/users/allusers')
            .then(response => response.json())
            .then(data => {
                if (Array.isArray(data)) {
                    allUsers = data; // Store all users for searching
                } else {
                    console.error('Expected an array of users, but got:', data);
                }
            })
            .catch(error => {
                console.error('Error fetching all users:', error);
            });
    }


    function searchUsers() {
    const query = document.getElementById('search-input').value.toLowerCase();
    if (Array.isArray(allUsers)) {
        const filteredUsers = allUsers.filter(user => 
            user.username.toLowerCase().includes(query) ||
            user.email.toLowerCase().includes(query) ||
            user.first_name.toLowerCase().includes(query) ||
            user.last_name.toLowerCase().includes(query)
        );
        populateTable(filteredUsers);
    } else {
        console.error('allUsers is not an array:', allUsers);
    }
}
    function populateTable(data) {
        const tableBody = document.getElementById('user-table-body');
        tableBody.innerHTML = ''; // Clear previous data

        data.forEach(row => {
            const id = htmlspecialchars(String(row.id));
            const status = row.status ? "Active" : "Disabled";
            const username = htmlspecialchars(String(row.username));
            const email = htmlspecialchars(String(row.email));
            const createdDateTime = substr(htmlspecialchars(String(row.createdDateTime)), 0, 19);
            const updatedDateTime = substr(htmlspecialchars(String(row.updatedDateTime)), 0, 19);
            const fname = htmlspecialchars(String(row.first_name));
            const lname = htmlspecialchars(String(row.last_name));
            const contact = htmlspecialchars(String(row.contact_info));
            const address = htmlspecialchars(String(row.address));
            const buttonColor = row.status ? "#28a745" : "#dc3545";

            const rowHTML = `
                <tr>
                    <td>${id}</td>
                    <td>${username}</td>
                    <td>${email}</td>
                    <td>${createdDateTime}</td>
                    <td>${updatedDateTime}</td>
                    <td>
                        <button onclick="updateStatus(${id}, ${row.status})" style="padding:10px; width:170px; border: none; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 5px; color: white; background-color: ${buttonColor}">${status} | Change</button>
                    </td>
                    <td>${fname}</td>
                    <td>${lname}</td>
                    <td>${address}</td>
                    <td>${contact}</td>
                    <td>
                        <button type="submit" onclick="deleteUser(${id})" style="padding:10px; width:100px; border: none; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 5px; cursor: pointer; color: white; background-color: #dc3545">Delete</button>
                    </td>
                </tr>
            `;
            tableBody.innerHTML += rowHTML;
        });
    }

    function changePage(direction) {
        currentPage += direction;
        fetchUsers(currentPage, limit);
    }

    function htmlspecialchars(str) {
        // Convert the input to a string and replace special characters
        return str.replace(/&/g, '&amp;')
                  .replace(/</g, '&lt;')
                  .replace(/>/g, '&gt;')
                  .replace(/"/g, '&quot;')
                  .replace(/'/g, '&#039;');
    }

    function substr(str, start, length) {
        // Ensure the input is a string before calling substring
        return String(str).substring(start, start + length);
    }
            function deleteUser(userId) {
              if (confirm('Are you sure you want to delete this user?')) {
                  fetch(`http://localhost:8090/api/v1/admin/users/delete/${userId}`, {
                      method: 'DELETE'
                  })
                  .then(response => {
                      if (!response.ok) {
                          throw new Error('Network response was not ok');
                      }
                      alert('User deleted successfully');
                      // Optionally, you can refresh the page or update the UI to reflect the deletion
                      location.reload();
                  })
                  .catch(error => {
                      console.error('There was a problem with the fetch operation:', error);
                      alert('Failed to delete user');
                  });
              }
            }
            function updateStatus(userId, currentStatus) {
            // Prompt user for confirmation
            var confirmChange = confirm("Are you sure you want to change the status?");

            if (confirmChange) {
                // Determine the new status
                var newStatus = currentStatus == 1 ? 0 : 1;

                // URL of the Spring Boot API
                var url = `http://localhost:8090/api/v1/admin/users/status/${newStatus}`;

                // Data to be sent in the request body
                var data = JSON.stringify({ id: userId });

                // Create a new request
                var xhr = new XMLHttpRequest();

                // Configure it: PUT-request for the URL
                xhr.open("PUT", url, true);

                // Set the request header for JSON content type
                xhr.setRequestHeader("Content-Type", "application/json");

                // Callback function for when the request completes
                xhr.onload = function () {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        // Parse the JSON response
                        var response = JSON.parse(xhr.responseText);

                        // Alert success message
                        location.reload();
                        alert("Status changed successfully.");

                        // Optionally, you can update the UI or redirect the page
                         // Refresh the page
                    } else {
                        // Handle errors
                        alert("Failed to update status: " + xhr.statusText);
                    }
                };

                // Send the request with the data
                xhr.send(data);
            } else {
                alert("Status change canceled.");
            }
        }
          </script>
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
