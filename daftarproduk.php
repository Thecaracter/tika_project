<?php
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="images/kucing.png" type="image/png" rel="shortcut icon" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    </link>
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
            <img src="images/miaw3.png" width="310" height="300" loading="lazy" alt="" class="img">
        </div>

        <div class="pemesanan-produk">
            <center>
                <h1>TAMBAH PRODUK</h1>
            </center>
            <form class="form-group" id="order-form" method="post" action="controller/simpanproduk_controller.php">
                <label for="nama_produk">Nama Produk</label>
                <input id="nama_produk" type="text" name="nama_produk" placeholder="Nama Produk" required>
                <label for="harga">Harga Produk:</label>
                <input type="text" id="harga" name="harga" required>
                <label for="kategori_produk">Kategori produk</label>
                <select id="kategori_produk" name="kategori_produk" required>
                    <option value="0">- Pilih Kategori -</option>

                    <?php
                    // Assuming you have a database connection established in your koneksi.php file
                    
                    // Perform a query to fetch category data from the database
                    $query = "SELECT kategori_id, name FROM kategori";
                    $result = mysqli_query($conn, $query);

                    // Check if the query was successful
                    if ($result) {
                        // Fetch associative array
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['kategori_id'] . '">' . $row['name'] . '</option>';
                        }

                        // Free result set
                        mysqli_free_result($result);
                    } else {
                        // Handle the error if the query fails
                        echo "Error: " . mysqli_error($conn);
                    }
                    ?>

                </select>

                <button id="kirim" type="submit" class="btn-primary">Pesan Sekarang</button>
            </form>
            <?php


            // Perform a query to fetch product data from the database
            $query = "SELECT produk.*, kategori.name AS name_kategori FROM produk JOIN kategori ON produk.kategori_id = kategori.kategori_id;";
            $result = mysqli_query($conn, $query);
            ?>
            <table id="order-table">
                <thead>
                    <tr>
                        <th>Produk Id</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result) {
                        // Open the tbody tag
                        echo '
                <tbody>';

                        // Fetch associative array
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $row['produk_id'] . '</td>';
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['harga'] . '</td>';
                            echo '<td>' . $row['name_kategori'] . '</td>';
                            echo '<td>';
                            echo '<a href="updateproduk.php?' . http_build_query($row) . '"><button class="update-btn">Update</button></a>';
                            echo '<span class="button-spacing"></span>'; // Add spacing between buttons
                            echo '<button class="delete-btn" onclick="deleteProduct(' . $row['produk_id'] . ')">Delete</button>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        // Close the tbody tag
                        echo '</tbody>';

                        // Free result set
                        mysqli_free_result($result);
                    } else {
                        // Handle the error if the query fails
                        echo "Error: " . mysqli_error($conn);
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="JS/cart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const icon = document.querySelector(".icon");
            const menu = document.querySelector(".meni");

            // Toggle menu visibility when the icon is clicked
            icon.addEventListener("click", function () {
                menu.style.display = menu.style.display === "none" ? "block" : "none";
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function deleteProduct(productId) {
            // Show a SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // User confirmed, proceed with the deletion

                    // Make an AJAX request to the server-side script
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "controller/deleteproduk_controller.php", true);
                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                    // Send the productId as data
                    xhr.send("productId=" + productId);

                    // Callback function when the request is completed
                    xhr.onload = function () {
                        if (xhr.status == 200) {
                            // Parse the JSON response
                            var response = JSON.parse(xhr.responseText);

                            // Check the status and show SweetAlert accordingly
                            if (response.status === 'success') {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: response.message,
                                    icon: 'success'
                                }).then(() => {
                                    // Reload the page or update the table as needed
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: response.message,
                                    icon: 'error'
                                });
                            }
                        } else {
                            console.error("Delete request failed with status", xhr.status);

                            // Show SweetAlert for deletion failure
                            Swal.fire({
                                title: 'Error!',
                                text: 'Failed to delete the product.',
                                icon: 'error'
                            });
                        }
                    };
                }
            });
        }
    </script>


    <style>
        .button-spacing {
            margin-right: 10px;
            /* Adjust the margin as needed */
        }
    </style>


</body>

</html>