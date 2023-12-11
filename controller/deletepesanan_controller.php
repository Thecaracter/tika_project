<?php
include '../koneksi.php';

class OrderManagement
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function cancelOrder($orderId)
    {
        // Initialize response array
        $response = array();

        // Use prepared statement to perform the deletion in the 'detail_order' table
        $deleteDetailOrderQuery = "DELETE FROM detail_order WHERE orderid = ?";

        $stmtDetailOrder = mysqli_prepare($this->conn, $deleteDetailOrderQuery);
        mysqli_stmt_bind_param($stmtDetailOrder, "s", $orderId);

        if (mysqli_stmt_execute($stmtDetailOrder)) {
            // Deletion successful for 'detail_order'
            $response['status_detail_order'] = 'success';
            $response['message_detail_order'] = 'Detail order deleted successfully';

            // TODO: Add any additional logic or updates needed after the deletion
        } else {
            // Deletion failed for 'detail_order'
            $response['status_detail_order'] = 'error';
            $response['message_detail_order'] = 'Error: ' . mysqli_error($this->conn);
        }

        mysqli_stmt_close($stmtDetailOrder);

        // Use prepared statement to perform the deletion in the 'order' table
        $deleteOrderQuery = "DELETE FROM `order` WHERE order_id = ?";

        $stmtOrder = mysqli_prepare($this->conn, $deleteOrderQuery);
        mysqli_stmt_bind_param($stmtOrder, "s", $orderId);

        if (mysqli_stmt_execute($stmtOrder)) {
            // Deletion successful for 'order'
            $response['status_order'] = 'success';
            $response['message_order'] = 'Order deleted successfully';
        } else {
            // Deletion failed for 'order'
            $response['status_order'] = 'error';
            $response['message_order'] = 'Error: ' . mysqli_error($this->conn);
        }

        mysqli_stmt_close($stmtOrder);

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}

// Check if orderId is provided in the POST request
if (isset($_POST['orderId'])) {
    $orderId = $_POST['orderId'];

    // Create an instance of OrderManagement
    $orderManager = new OrderManagement($conn);

    // Call the cancelOrder method
    $orderManager->cancelOrder($orderId);

} else {
    // Invalid request
    $response['status'] = 'error';
    $response['message'] = 'Invalid request: orderId not provided';

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>