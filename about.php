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

        <div class="kucingone">
            <h1>Hai...Miaw<span>FRIENDS</span></h1>
            <p>Hay Miaw Care Shop terus berkembang pesat di bawah kepemimpinan yang dinamis dan inovatif dari Atika.
                Dengan fokusnya pada hewan peliharaan kecil, toko ini telah menjadi pusat unggulan di Gresik dan
                sekitarnya.
                Melalui kombinasi toko hewan peliharaan dan salon perawatan, Hay Miaw Care Shop memberikan pengalaman
                komprehensif bagi
                pemilik hewan peliharaan. Atika, sebagai pendiri dan pemilik toko,
                memiliki visi yang jelas untuk menyediakan produk berkualitas tinggi dan layanan perawatan yang
                profesional.
                Keberhasilannya dalam memahami kebutuhan pelanggan dan tren industri hewan peliharaan menjadikan Hay
                Miaw Care Shop
                menjadi destinasi utama bagi para pecinta hewan. Toko ini tidak hanya menyediakan berbagai macam
                makanan, mainan, dan
                perlengkapan hewan peliharaan, tetapi juga menawarkan layanan salon perawatan khusus.
                Dengan tim perawatan yang dilatih dengan baik, hewan peliharaan dapat menikmati layanan
                grooming, mandi spa, dan perawatan kesehatan lainnya. Selain itu juga Hay Miaw Care juga menyediakan
                layanan MIAW PLAYGROUND yang dimana para anabul bisa bermain untuk kucing agar
                dapat melakukan aktivitas fisik, mental, dan sosial mereka dengan aman dan menyenangkan.
            </p>
        </div>

        <div class="background_image">
            <img src="images/toko.png" width="500" height="520">
        </div>


        <!--About Page-->

        <div class="aboutone">
            <center>
                <h1>--------------------- VISI AND MISI--------------------</h1>
            </center>

            <div class="box">

                <div class="cards">
                    <center>
                        <p>
                            <b>LAYANAN PERAWATAN PROFESIONAL</b>
                        </p>
                    </center>
                    <img src="images/kasih.png">
                    <p>
                        Menyelengarakan layanan perawatan hewan peliharaan yang profesional,
                        termasuk grooming, mandi spa dan perawatan kesehatan untuk meningkatkan
                        kesejahteraan dan kebahagiaan hewan peliharaan. Tim ahli groomer di Hay Miaw Care Shop dilatih
                        untuk
                        memberikan perawatan grooming terbaik untuk hewan peliharaan. Mulai dari potongan rambut,
                        pemotongan kuku, hingga perawatan bulu, layanan grooming kami
                        dirancang untuk menjaga penampilan terbaik dan kesehatan kulit hewan peliharaan.
                    </p>
                </div>
                <div class="cards">
                    <center>
                        <p>
                            <b>MEMBERIKAN PRODUK BERKUALITAS TINGGI</b>
                        </p>
                    </center>
                    <img src="images/kasih1.png">
                    <p>
                        Menyediakan beragam produk hewan peliharaan berkualitas tinggi, termasuk makanan,
                        mainan, dan perlengkapan lainnya, untuk memenuhi kebutuhan dan keinginan pelanggan.
                        Hay Miaw Care Shop menjalin kemitraan yang erat dengan produsen terkemuka dalam industri hewan
                        peliharaan.
                        Ini memastikan bahwa kami dapat menyediakan produk berkualitas tinggi
                        yang memenuhi standar keamanan dan kesehatan tertinggi untuk hewan peliharaan.
                    </p>
                </div>
                <div class="cards">
                    <center>
                        <p>
                            <b>INOVASI DAN KREATIVITAS</b>
                        </p>
                    </center>
                    <img src="images/kasih2.png">
                    <p>
                        Terus mengembangkan inovasi dalam produk dan layanan,
                        serta menyelaraskan penawaran dengan
                        tren terkini dalam industri hewan peliharaan. Tim R&D kami selalu mencari bahan-bahan baru,
                        teknologi terkini, dan formulasi yang lebih baik untuk memastikan kualitas produk yang tinggi.
                        Kami berkomitmen untuk menjadi trendsetter dalam gaya dan desain produk hewan peliharaan.
                        Dari mainan hingga aksesoris, setiap produk
                        yang kami tawarkan dirancang dengan estetika yang modern dan fungsionalitas yang tinggi
                    </p>
                </div>
                <div class="cards">
                    <center>
                        <p>
                            <b>PENGIRIMAN CEPAT</b>
                        </p>
                    </center>
                    <img src="images/kasih3.png">
                    <p>
                        Kami memahami betapa pentingnya waktu bagi pelanggan kami, terutama ketika mendesaknya kebutuhan
                        hewan peliharaan.
                        Oleh karena itu,Hay Miaw Care Shop menawarkan layanan pengiriman cepat yang efisien dan dapat
                        diandalkan.
                        Hay Miaw Care Shop menyediakan opsi pengiriman ekspres bagi pelanggan yang membutuhkan produk
                        dengan segera.
                        Dengan opsi ini, pelanggan dapat memastikan bahwa pesanan mereka akan sampai dengan cepat.
                        Pesanan dengan layanan pengiriman cepat mendapatkan prioritas pemesanan
                    </p>
                </div>
            </div>


            <footer>
                <p>&copy; 2023 HAY MIAW CARE SHOP.com. By Nur Cahyani Astika Fauzi.</p>
            </footer>



</body>

</html>