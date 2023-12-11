<?php
// File: logout.php

session_start();

// Hapus semua data sesi
session_destroy();

// Redirect ke halaman utama atau halaman lain yang diinginkan setelah logout
header("Location: ../index.php");
exit();
?>