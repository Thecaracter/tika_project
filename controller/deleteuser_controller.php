<?php
include '../koneksi.php';

// Initialize response array
$response = array();

// Check if customerId is provided in the POST request
if (isset($_POST['customerId'])) {
    $customerId = $_POST['customerId'];

    // Use prepared statement to perform the deletion in the order table
    $deleteOrderQuery = "DELETE FROM `order` WHERE customerId = ?";

    $stmtOrder = mysqli_prepare($conn, $deleteOrderQuery);

    if ($stmtOrder) {
        mysqli_stmt_bind_param($stmtOrder, "i", $customerId);

        if (mysqli_stmt_execute($stmtOrder)) {
            // Deletion from order table successful
            // Now, delete from customer table
            $deleteCustomerQuery = "DELETE FROM customer WHERE customerId = ?";
            $stmtCustomer = mysqli_prepare($conn, $deleteCustomerQuery);

            if ($stmtCustomer) {
                mysqli_stmt_bind_param($stmtCustomer, "i", $customerId);

                if (mysqli_stmt_execute($stmtCustomer)) {
                    // Deletion from customer table successful
                    $response['status'] = 'success';
                    $response['message'] = 'Orders and customer deleted successfully';
                } else {
                    // Deletion from customer table failed
                    $response['status'] = 'error';
                    $response['message'] = 'Error deleting customer: ' . mysqli_stmt_error($stmtCustomer);
                }

                mysqli_stmt_close($stmtCustomer);
            } else {
                // Error in prepared statement for customer deletion
                $response['status'] = 'error';
                $response['message'] = 'Error in prepared statement for customer deletion: ' . mysqli_error($conn);
            }
        } else {
            // Deletion from order table failed
            $response['status'] = 'error';
            $response['message'] = 'Error deleting orders: ' . mysqli_stmt_error($stmtOrder);
        }

        mysqli_stmt_close($stmtOrder);
    } else {
        // Error in prepared statement for order deletion
        $response['status'] = 'error';
        $response['message'] = 'Error in prepared statement for order deletion: ' . mysqli_error($conn);
    }
} else {
    // Invalid request
    $response['status'] = 'error';
    $response['message'] = 'Invalid request: customerId not provided';
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>