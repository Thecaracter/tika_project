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
        <div class="logotwo">
            <img src="images/miaw1.png" width="310" height="300" loading="lazy" alt="" class="img">

            <h2> APAKAH ANABUL KESAYANGAN KAMU <span> PUNYA MASALAH, SEPERTI:
            </h2>

        </div>
        <div class="container">
            <div class="mamdi">
                <img src="images/tika.png" width="89" height="89" loading="lazy" alt="icon">
            </div>
            <h3 class="h3 card-title">Bakteri & Jamur Di Permukaan Kulit!?</h3>
            <div class="mandi">
                <img src="images/tika.png" width="89" height="89" loading="lazy" alt="icon">
            </div>
            <h3 class="h3 card-title">Muncul Kutu Yang Membuat Gatal - Gatal!?</h3>
            <div class="mandi">
                <img src="images/tika.png" width="89" height="89" loading="lazy" alt="icon">
            </div>
            <h3 class="h3 card-title">Bulu Terlihat Rontok, Gimbal, Tidak Terawat!?</h3>
            <div class="mandi">
                <img src="images/tika.png" width="89" height="89" loading="lazy" alt="icon">
            </div>
            <h3 class="h3 card-title">Muncul Kotoran Di Sela - Sela Mata & Telinga!?</h3>

        </div>
        <div class="hallo2">
            <div class="background_image">
                <img src="images/solusi2.png">
            </div>
        </div>


        <div class="daftar">
            <h1>---------- GROOMING SERVICES ---------</h1>
            <table>
                <tr>
                    <th>No.</th>
                    <th>Daftar Pilihan Grooming</th>
                    <th>Kucing 3-5,2Kg</th>
                    <th>Kucing 5,3-10Kg</th>
                </tr>
                <tr>
                    <td>1.</td>
                    <td>Dry Grooming (Mandi Kering)</td>
                    <td>Rp 35.000</td>
                    <td>Rp 50.000</td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>Basic Grooming</td>
                    <td>Rp 60.000</td>
                    <td>Rp 95.000</td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>Basic Grooming</td>
                    <td>Rp 60.000</td>
                    <td>Rp 95.000</td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td>Basic Grooming</td>
                    <td>Rp 60.000</td>
                    <td>Rp 95.000</td>
                </tr>
                <tr>
                    <td>5.</td>
                    <td>Basic Grooming</td>
                    <td>Rp 60.000</td>
                    <td>Rp 95.000</td>
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