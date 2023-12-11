<?php
session_start();

// Include file koneksi
include '../koneksi.php';

class Login
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function loginUser($identifier, $password)
    {
        // Retrieve user data associated with the provided email or username
        $stmt = $this->conn->prepare("SELECT customerid, username, email, password, role FROM customer WHERE email = ? OR username = ?");
        $stmt->bind_param("ss", $identifier, $identifier);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];

            // Check if password matches the hashed password
            if (password_verify($password, $hashed_password)) {
                unset($row['password']); // Remove the hashed password from the returned data
                return $row; // Return user data on successful login
            }
        }

        return false; // Login failed
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create object of Login class
    $login = new Login($conn);

    // Get form data
    $identifier = $_POST['identifier']; // This could be either email or username
    $password = $_POST['password'];

    // Login user
    $user_data = $login->loginUser($identifier, $password);
    if ($user_data) {
        // Jika login sukses
        $_SESSION['user_data'] = $user_data; // Store user data in the session
        $_SESSION['role'] = $user_data['role']; // Store the user's role in the session
        $_SESSION['customerid'] = $user_data['customerid']; // Store customerid in the session

        echo json_encode(array('status' => 'success'));

        // Redirect to index.php
        header("Location: ../index.php");
        exit(); // Ensure that no further code is executed after the redirection
    } else {
        // Jika login gagal
        echo json_encode(array('status' => 'failed', 'message' => 'Email/Username atau password salah.'));
    }
}
?>