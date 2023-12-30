<?php
include '../koneksi.php';

// Initialize response array
$response = array();

// Check if customerId is provided in the POST request
if (isset($_POST['customerId'])) {
    $customerId = $_POST['customerId'];

    // Use prepared statement to perform the deletion in the database
    $deleteQuery = "DELETE FROM customer WHERE customerid = ?";

    $stmt = mysqli_prepare($conn, $deleteQuery);
    mysqli_stmt_bind_param($stmt, "i", $customerId);

    if (mysqli_stmt_execute($stmt)) {
        // Deletion successful
        $response['status'] = 'success';
        $response['message'] = 'Customer deleted successfully';
    } else {
        // Deletion failed
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    // Invalid request
    $response['status'] = 'error';
    $response['message'] = 'Invalid request: customerId not provided';
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>