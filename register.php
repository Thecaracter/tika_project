<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="images/kucing.png" type="image/png" rel="shortcut icon" />
    <link rel="stylesheet" href="style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('.form-group');

            form.addEventListener('submit', function (event) {
                event.preventDefault();

                // Lakukan pengiriman AJAX ke register_controller.php
                fetch('controller/register_controller.php', {
                    method: 'POST',
                    body: new FormData(form)
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire({
                                title: 'Registration Successful',
                                text: 'Thank you for registering!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            Swal.fire({
                                title: 'Registration Failed',
                                text: 'Please try again.',
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
                        <li><a href="playground.html">PLAYGROUND</a></li>
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
        <div class="kotakregis">
            <div class="background_imagetwo">
                <img src="images/regis.png" width="600" height="520">
            </div>

            <div class="register">
                <h1>SIGN UP </h1>
                <form class="form-group" id="registrationForm" action="controller/register_controller.php"
                    method="POST">
                    <label for="">Full Name</label>
                    <input id="fullname" type="text" name="fullname" placeholder="Full Name" required>
                    <label for="">Username</label>
                    <input id="username" type="text" name="username" placeholder="Username" required>
                    <label for="">Password (minimum 8 characters)</label>
                    <input id="password" type="password" name="password" placeholder="Password" required>
                    <label for="">Email</label>
                    <input id="email" type="email" name="email" placeholder="Email" required>
                    <label for="">Phone Number</label>
                    <input id="phone_number" type="text" name="phone_number" placeholder="Phone Number" pattern="[0-9]+"
                        title="Please enter numbers only" required>
                    <button id="submit" type="submit" class="btn-primary">Create Account</button>
                </form>
            </div>
        </div>
        <footer>
            <p>&copy; 2023 HAY MIAW CARE SHOP.com. By Nur Cahyani Astika Fauzi.</p>
        </footer>
        <script src="JS/register.js"></script>
        <!-- Referensi Bootstrap JavaScript -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('registrationForm');

                form.addEventListener('submit', function (event) {
                    event.preventDefault();

                    const password = document.getElementById('password').value;
                    const email = document.getElementById('email').value;

                    // Validasi panjang password minimal 8 karakter
                    if (password.length < 8) {
                        alert('Password must be at least 8 characters long.');
                        return;
                    }

                    // Validasi format email
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(email)) {
                        alert('Please enter a valid email address.');
                        return;
                    }

                    // Jika validasi berhasil, submit form
                    this.submit();
                });
            });
        </script>
</body>

</html>