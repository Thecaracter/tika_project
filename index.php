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
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('.form-group');

            form.addEventListener('submit', function (event) {
                event.preventDefault();

                // Lakukan pengiriman AJAX ke login.php
                fetch('controller/login_controller.php', {
                    method: 'POST',
                    body: new FormData(form)
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data); // Log the response for debugging

                        if (data.status === 'success') {
                            Swal.fire({
                                title: 'Login Successful',
                                text: 'Welcome back!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            Swal.fire({
                                title: 'Login Failed',
                                text: 'Please check your credentials and try again.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    </script>

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


        <!-- Class kucing untuk tulisan ke home -->

        <div class="kucing">
            <h1>Hai...Miaw Care<span>Shop</span></h1>
            <p>“ HAY MIAW CARE SHOP “ adalah sebuah platform yang didedikasikan
                untuk para pecinta kucing yang dirancang khusus perawatan dan
                kebahagiaan kucing kesayangan mereka. Diplatform ini,
                kamu dapat menemukan berbagai produk perawatan berkualitas tinggi,
                makanan yang lezat dan sehat, serta mempunyai informasi bermanfaat
                yang akan membantu kamu untuk merawat kucing dengan penuh cinta
                dan kasih sayang.
            </p>
        </div>

        <!-- Class gambar pada menu home-->

        <div class="background_image">
            <img src="images/senang.png" width="610" height="610">
        </div>

        <!-- class btn -->

        <div class="btn">
            <p class="read"><a href="about.php">Read More</a></p>
            <p class="shop"><a href="shop.php">Shop Now</a></p>
        </div>


        <!--About Page-->

        <div class="about">
            <center>
                <h1>--------------------- CATEGORY --------------------</h1>
            </center>

            <div class="box">

                <div class="cards">
                    <img src="images/category-1.png">
                    <center>
                        <p>--------- CAT FOOD ---------</p>
                    </center>
                </div>
                <div class="cards">
                    <img src="images/category-2.jpg">
                    <center>
                        <p>--------- CAT TOYS ---------</p>
                    </center>
                </div>
                <div class="cards">
                    <img src="images/category-3.png">
                    <center>
                        <p>--------- CLEANING TOOL ---------</p>
                    </center>
                </div>
                <div class="cards">
                    <img src="images/category-5.png">
                    <center>
                        <p>--------- CAT MEDICINE ---------</p>
                    </center>
                </div>
            </div>



            <hr>
            <div class="miaw">
                <center>
                    <h1>*********** SERVICE *********** </h1>
                </center>

                <div class="miaw_box">
                    <div class="miaw_card">
                        <a href="miawcare.php">
                            <img src="images/mandi4.png">
                        </a>
                        <h1>MIAW CARE</h1>
                        <p>
                            Melayani Jasa Grooming Kucing
                            - Grooming Panggilan
                            - Memanjakan dan Memandikan Anabul Kesayangan Kamu.
                            FREE VITAMIN UNTUK PELAYANAN GROOMING
                        </p>
                    </div>

                    <div class="miaw_card">
                        <a href="hotel.php">
                            <img src="images/hotel2.png">
                        </a>
                        <h1>HOTEL MIAW</h1>
                        <p>
                            Melayani Jasa Penitipan Kucing Harian Dengan Pelayanan Terpecaya
                            Kesehatan,Kenyamanan, Dan Kebahagiaan Anabul
                            Kamu Merupakan Prioritas Kami. BURUAN BOOKING SEKARANG!!
                        </p>
                    </div>

                    <div class="miaw_card">
                        <a href="playground.php">
                            <img src="images/bermain.png">
                        </a>
                        <h1>MIAW PLAYGROUND</h1>
                        <p>
                            Cat Playground adalah ruang bermain khusus yang dirancang untuk kucing agar
                            dapat melakukan aktivitas fisik, mental, dan sosial mereka dengan aman dan menyenangkan.
                            AYOOO AJAK ANABULMU KE MIAW PLAYGROUND !!
                        </p>
                    </div>
                </div>
            </div>
            </hr>



            <hr>
            <div class="contact">
                <center>
                    <h1>:::: CONTACT :::: </h1>
                </center>

                <div class="box">
                    <div class="card">
                        <a href="https://api.whatsapp.com/">
                            <img src="images/kontak1.png">
                        </a>
                    </div>
                </div>
            </div>
            </hr>


            <footer>
                <p>&copy; 2023 HAY MIAW CARE SHOP.com. By Nur Cahyani Astika Fauzi.</p>
            </footer>



</body>

</html>