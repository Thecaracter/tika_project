<?php
// File: register.php

// Include file koneksi
include '../koneksi.php';

class Registration
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function registerUser($fullname, $username, $password, $email, $phone_number)
    {
        // Hash password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $role = "2";
        // Prepare and bind statement
        $stmt = $this->conn->prepare("INSERT INTO customer ( name, username, password, email, phone_number,role) VALUES (?, ?, ?, ?, ?,?)");
        $stmt->bind_param("ssssss", $fullname, $username, $hashed_password, $email, $phone_number, $role);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Registration successful
        } else {
            return false; // Registration failed
        }
    }
}

// Check if form is submitted
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create object of Registration class
    $registration = new Registration($conn);

    // Get form data
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    // Validate password length
    if (strlen($password) < 8) {
        // Jika panjang password kurang dari 8 karakter
        echo json_encode(array('status' => 'failed', 'message' => 'Password harus memiliki minimal 8 karakter'));
        exit(); // Berhenti eksekusi jika password tidak memenuhi syarat
    }

    // Register user
    $registration_status = $registration->registerUser($fullname, $username, $password, $email, $phone_number);
    if ($registration_status) {
        // Menyiapkan data untuk dikirimkan ke halaman register.php
        $response = array(
            'status' => 'success'
        );
        echo json_encode($response); // Mengirimkan respons dalam format JSON
    } else {
        // Jika registrasi gagal
        echo json_encode(array('status' => 'failed'));
    }
}
?>