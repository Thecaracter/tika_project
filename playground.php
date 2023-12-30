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
                    <a>Service</a>
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

                <li class="submenuakun">
                    <img src="images/akun1.png"></a>
                    <ul class="submenudua-content">
                        <li>
                            <?php
                            // Display username if the user is logged in
                            if (isset($_SESSION['user_data'])) {
                                $username = $_SESSION['user_data']['username'];
                                echo '<p>Selamat datang, ' . $username . '!</p>';
                                echo '<li>';
                                // FORM LOGOUT
                                echo '<form class="signup-form" action="controller/logout_controller.php" method="post">';
                                echo '<h2>Logout Your Account</h2>';
                                // ...TOMBOL LOG OUT
                                echo '<button type="submit">Log Out</button>';
                                echo '</form>';
                                echo '</li>';
                            } else {
                                echo '<li>';
                                // FORM SIGN UP
                                echo '<form class="signup-form" action="register.php" method="post">';
                                echo '<h2>Create an Account</h2>';
                                // ...TOMBOL SIGN UP
                                echo '<button type="submit">Sign Up</button>';
                                echo '</form>';
                                echo '</li>';

                                echo '<li>';
                                echo '<form class="signin-form" action="controller/login_controller.php" method="post">';
                                echo '<h2>Sign In</h2>';
                                echo '<label for="signin-username">Username Or Email:</label>';
                                echo '<input type="text" id="signin-username" name="identifier">';
                                echo '<label for="signin-password">Password:</label>';
                                echo '<input type="password" id="signin-password" name="password">';
                                echo '<button type="submit">Sign In</button>';
                                echo '</form>';
                                echo '</li>';
                            }
                            ?>
                        </li>
                    </ul>
                </li>
                <li><a href="cart.php"><img src="images/cart.png"></a></li>

            </ul>
        </div>
        <div class="logoone">
            <img src="images/miaw2.png" width="310" height="300" loading="lazy" alt="" class="img">

            <h1> KAMU BOSEN BERMAIN SENDIRI ?? <span> YUK AJAK ANABUL KAMU KE SINI...
            </h1>
            <p>
                Taman Bermain tersedia untuk Kucing.
                Kucing dan pemiliknya dapat berenang bersama, bersenang-senang, dan bersosialisasi dengan kucing lain.
                Staf yang terlatih, ceria dan penuh semangat. Sehingga anabul kamu tidak gampang bosan sama sekali.
                Reservasi grup dipersilakan, dengan Miaw playground dalam ruangan untuk 30 orang,
                ulang tahun atau acara khusus.
            </p>
        </div>
        <div class="daftar">
            <h1>---------- JAM OPRASIONAL ---------</h1>
            <table>
                <tr>
                    <th>No.</th>
                    <th>Days</th>
                    <th>Time</th>
                    <th>Happy Hour</th>
                    <th>Weekdays</th>
                    <th>Weekend atau Tanggal Merah</th>
                </tr>
                <tr>
                    <td>1.</td>
                    <td>Jum'at</td>
                    <td>08:00 - 10:00</td>
                    <td>Rp 40.000</td>
                    <td>Rp 60.000</td>
                    <td>Rp 100.000</td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>Senin - Sabtu</td>
                    <td>09:00 - 21:00</td>
                    <td>Rp 60.000</td>
                    <td>Rp 95.000</td>
                    <td>Rp 120.000</td>

                </tr>
                <tr>
                    <td>3.</td>
                    <td>Sabtu - Minggu</td>
                    <td>09:00 - 21:00</td>
                    <td>Rp 70.000</td>
                    <td>Rp 98.000</td>
                    <td>Rp 150.000</td>
                </tr>

            </table>
        </div>



        <div class="boking">
            <h1>BOOKING NOW!!</h1>
            <a href="https://api.whatsapp.com/">
                <div class="button">
                    <p>BOOKING NOW !!!!?</p>
                </div>
            </a>
        </div>

        <footer>
            <p>&copy; 2023 HAY MIAW CARE SHOP.com. By Nur Cahyani Astika Fauzi.</p>
        </footer>


</body>

</html>