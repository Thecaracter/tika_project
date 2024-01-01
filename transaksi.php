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
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-H0REoJNtl06FQJuJ"></script>
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
            <?php
            $customerId = $_SESSION['user_data']['customerid'];

            $query = "SELECT * FROM `order` WHERE `order`.customerid = $customerId;";

            $result = mysqli_query($conn, $query);
            ?>
            <table id="order-table">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Order Date</th>
                        <th>Customer Id</th>
                        <th>Alamat</th>
                        <th>Total Bayar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result) {
                        // Open the tbody tag
                        echo '<tbody>';

                        // Fetch associative array
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $row['order_id'] . '</td>';
                            echo '<td>' . $row['orderdate'] . '</td>';
                            echo '<td>' . $row['customerid'] . '</td>';
                            echo '<td>' . $row['alamat'] . '</td>';
                            echo '<td>' . $row['total_bayar'] . '</td>';
                            $status = $row['status'];


                            if ($status == 1) {
                                echo '<td>';
                                echo '<button class="payment-btn" onclick="paymentAction(\'' . $row['order_id'] . '\')" style="background-color: #3887BE; color: #fff; padding: 8px 8px; border: none; border-radius: 4px; cursor: pointer;">Lakukan Pembayaran</button>';
                                echo '</td>';
                            } elseif ($status == 2) {
                                echo '<td>';
                                echo '<button class="delete-btn" onclick="deleteProduct(\'' . $row['order_id'] . '\')" style="background-color: #dc3545; color: #fff; padding: 8px 8px; border: none; border-radius: 4px; cursor: pointer;">Batalkan Pesanan</button>';
                                echo '</td>';
                            } elseif ($status == 3) {
                                echo '<td>';
                                echo '<span style="border: 1px solid #28a745; color: #28a745; padding: 6px 10px; border-radius: 30px; display: inline-block;">Pesanan Selesai</span>';
                                echo '</td>';
                            } else {
                                echo '<td>Status Tidak Dikenali</td>';
                            }
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Inside your HTML -->
    <script>
        function deleteProduct(orderId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send orderId in the request body
                    fetch('controller/deletepesanan_controller.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'orderId=' + orderId,
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                Swal.fire({
                                    title: 'Cancelled!',
                                    text: data.message_order,
                                    icon: 'success',
                                });
                                location.reload();
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: data.message_order,
                                    icon: 'error',
                                });
                                location.reload();
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
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
    <!-- Pastikan Anda sudah menyertakan jQuery di halaman Anda -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Skrip JavaScript -->
    <script>
        function paymentAction(orderId) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        // Handle the response if needed
                        console.log(xhr.responseText);

                        // Parse JSON response if it's a JSON string
                        try {
                            var response = JSON.parse(xhr.responseText);

                            // Access specific properties of the response
                            console.log("Snap Token: " + response.snapToken);

                            // Perform additional actions based on the response
                            // For example, you can pass the transaction token to Midtrans Snap
                            window.snap.pay(response.snapToken, {
                                onSuccess: function (result) {


                                    window.location.href = 'controller/updatestatus_controller.php?order_id=' + encodeURIComponent(orderId);
                                },
                                onPending: function (result) {
                                    // Handle pending status if needed
                                    console.log("Payment is pending:", result);
                                },
                                onError: function (result) {
                                    // Handle error status if needed
                                    console.error("Payment failed:", result);
                                },
                                onClose: function () {
                                    // Handle when the Snap Popup is closed
                                    console.log("Snap Popup closed");
                                }
                            });
                        } catch (error) {
                            console.error("Error parsing JSON response:", error);
                        }
                    } else {
                        console.error("XHR request failed with status:", xhr.status);
                    }
                }
            };

            var url = 'controller/payment_controller.php';
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            var data = 'order_id=' + orderId;


            xhr.send(data);
        }
    </script>
</body>

</html>