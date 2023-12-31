<?php
session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="images/kucing.png" type="image/png" rel="shortcut icon" />
    <link rel="stylesheet" href="style.css">
    <title> HAY MIAW CARE SHOP.com </title>
</head>

<body>

    <div class="navigasi">
        <div class="logo">
            <img src="images/logo.png" width="360" height="98">
        </div>

        <div class="menu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>

                <li class="submenu">
                    <a href="shop.php">SHOP</a>
                    <ul class="submenu-content">
                        <li><a href="food.php">FOOD</a></li>
                        <?php

                        // Check if the 'user_data' and 'role' are set in the session
                        if (isset($_SESSION['user_data']) && isset($_SESSION['role'])) {
                            // Check the role value
                            if ($_SESSION['role'] == 2) {
                                echo '<li><a href="cart.php">Transaksi</a></li>';
                                echo '<li><a href="transaksi.php">Barang Anda</a></li>';
                            } elseif ($_SESSION['role'] == 1) {
                                echo '<li><a href="daftarproduk.php">Tambah Produk</a></li>';
                                echo '<li><a href="transaksi_admin.php">Transaksi User</a></li>';
                                echo '<li><a href="user_admin.php">User</a></li>';
                            }
                        } else {
                            // Handle the case when the 'user_data' or 'role' is not set (optional)
                        }
                        ?>
                        <li><a href="cleaning.html">CLEANING TOOL</a></li>
                        <li><a href="medis.html">MEDICINE</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="miaw.html">Service</a>
                    <ul class="submenu-content">
                        <li><a href="hotel.php">HOTEL</a></li>
                        <li><a href="miawcare.php">CARE</a></li>
                        <li><a href="playground.php">PLAYGROUND</a></li>
                    </ul>
                </li>

                <li><a href="https://api.whatsapp.com/">Contact</a></li>

                <li class="search-box">
                    <form action="#" method="get">
                        <input type="text" name="query" placeholder="Search">
                        <button type="submit">Search</button>
                    </form>
                </li>

                <li><a href="cart.php"><img src="images/cart.png"></a></li>

            </ul>
        </div>

        <div class="kotaklogin">
            <div class="background_imagetwo">
                <img src="images/regis.png" width="600" height="520">
            </div>

            <div class="login">
                <h1>Login</h1>
                <form action="controller/login_controller.php" method="post">
                    <input id="username" type="text" name="identifier" placeholder="Email atau Username">
                    <input id="password" type="password" name="password" placeholder="Password">
                    <button id="submit" type="submit" class="btn-primary">Submit</button>
                    <button id="submit" type="submit" class="btn-primary">Cancel</button>
                </form>
            </div>
        </div>
        <footer>
            <p>&copy; 2023 HAY MIAW CARE SHOP.com. By Nur Cahyani Astika Fauzi.</p>
        </footer>
        <script src="JS/login.js"></script>
        <!-- Pastikan Anda sudah menyertakan library jQuery dan SweetAlert di halaman Anda -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(document).ready(function () {
                $('form').submit(function (event) {
                    event.preventDefault();
                    $.ajax({
                        type: $(this).attr('method'),
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 'success') {
                                // Jika login berhasil
                                Swal.fire('Login Berhasil!', '', 'success').then(() => {
                                    // Refresh halaman setelah menampilkan pesan Swal
                                    location.reload();
                                });
                            } else {
                                // Jika login gagal
                                Swal.fire('Login Gagal!', response.message, 'error');
                            }
                        }
                    });
                });
            });
        </script>
</body>

</html>