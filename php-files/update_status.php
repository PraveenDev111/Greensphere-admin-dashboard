<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $currentStatus = $_POST['current_status'];
    $newStatus = $currentStatus == 1 ? 0 : 1;

    // URL of the Spring Boot API
    $url = "http://localhost:8090/api/v1/admin/users/status/{$newStatus}";

    // Data to be sent in the request body
    $data = json_encode(['id' => $userId]);

    // Initialize cURL
    $ch = curl_init($url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data)
    ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    // Execute cURL request
    $response = curl_exec($ch);

    // Close cURL session
    curl_close($ch);

    // Set success message
    $_SESSION['status_message'] = "Status changed successfully.";

    // Redirect back to the previous page
    header("Location: ../pages/users.php");
    exit();
}
