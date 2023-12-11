<?php
include '../koneksi.php';

// Initialize response array
$response = array();

// Check if productId is provided in the POST request
if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    // Use prepared statement to perform the deletion in the database
    $deleteQuery = "DELETE FROM produk WHERE produk_id = ?";

    $stmt = mysqli_prepare($conn, $deleteQuery);
    mysqli_stmt_bind_param($stmt, "i", $productId);

    if (mysqli_stmt_execute($stmt)) {
        // Deletion successful
        $response['status'] = 'success';
        $response['message'] = 'Product deleted successfully';
    } else {
        // Deletion failed
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    // Invalid request
    $response['status'] = 'error';
    $response['message'] = 'Invalid request: productId not provided';
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>