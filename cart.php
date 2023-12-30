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
    <!-- jQuery -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" defer></script>



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

    </div>
    <div class="logoone">
        <img src="images/miaw3.png" width="310" height="300" loading="lazy" alt="" class="img">
    </div>

    <div class="pemesanan-produk">
        <center>
            <h1>PESAN PRODUK</h1>
        </center>
        <form class="form-group" id="order-form">
            <?php
            include 'koneksi.php';

            function generateOrderID($conn)
            {
                try {
                    // Check if the connection is successful
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT order_id FROM `order` ORDER BY order_id DESC LIMIT 1";
                    $result = $conn->query($sql);

                    if ($result !== false && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $lastID = $row['order_id'];

                        $numericPart = substr($lastID, 3);
                        $increment = (int) $numericPart + 1;
                        $newID = sprintf("ODR%04d", $increment);
                        return $newID;
                    } else {
                        return "ODR0001";
                    }
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                    return "ODR0001";
                }
            }

            $orderID = generateOrderID($conn);
            ?>

            <!-- Use $orderID value in HTML -->
            <label for="order_id">Order ID</label>
            <input id="order_id" type="text" name="order_id" value="<?php echo htmlspecialchars($orderID); ?>" readonly
                required>

            <label for="kategori_produk">Produk</label>
            <select id="kategori_produk" name="kategori_produk" required
                style="width: 100%; height: 50px; padding: 10px; font-size: 16px; border-radius: 5px; overflow: auto;">
                <option value="0">- Pilih Product -</option>
                <?php
                // Assuming you have a database connection established in your koneksi.php file
                
                // Perform a query to fetch category data from the database
                $query = "SELECT produk_id, name, harga FROM produk";
                $result = mysqli_query($conn, $query);

                // Check if the query was successful
                if ($result) {
                    // Fetch associative array
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['produk_id'] . '" data-harga="' . $row['harga'] . '">' . $row['name'] . '</option>';
                    }

                    // Free result set
                    mysqli_free_result($result);
                } else {
                    // Handle the error if the query fails
                    echo "Error: " . mysqli_error($conn);
                }
                ?>
            </select>

            <!-- Script to initialize Select2 -->
            <script>
                // Initialize Select2 after the document is fully loaded
                $(document).ready(function () {
                    $('#kategori_produk').select2({
                        placeholder: "Select an option",
                        allowClear: true
                    });
                });
            </script>

            <label for="harga">Harga Produk:</label>
            <input type="text" id="harga" name="harga" readonly required>

            <label for="alamat_pengiriman">Alamat Pengiriman</label>
            <input id="alamat_pengiriman" type="text" name="alamat_pengiriman" placeholder="Alamat Pengiriman" required>

            <label for="jumlah">Jumlah (Max: 10)</label>
            <input id="jumlah" type="number" name="jumlah" placeholder="Jumlah" max="10" required>

            <label for="total_pembayaran">Total Pembayaran:</label>
            <input type="text" id="total_pembayaran" name="total_pembayaran" readonly required>

            <button id="tambah_produk" type="button" class="btn-primary" onclick="addProduct()">Tambah Produk</button>
            <button id="kirim" type="button" class="btn-primary" onclick="submitOrder()">Pesan Sekarang</button>
        </form>
        <!-- Table to display orders -->
        <table id="order-table" class="table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Alamat Pengiriman</th>
                    <th>Harga</th>
                    <th>Total Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <!-- Order entries will be added here dynamically -->
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4"><strong>Total Pembayaran:</strong></td>
                    <td><span id="total_pembayaran_display">0</span></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- JavaScript to update the price based on the selected product -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        function addProduct() {
            var selectedOption = $('#kategori_produk').find('option:selected');
            var productName = selectedOption.text();
            var productId = selectedOption.val();
            var harga = selectedOption.data('harga');
            var jumlah = $('#jumlah').val();
            var alamat = $('#alamat_pengiriman').val();

            // Validasi input
            if (productId === "0" || jumlah === "" || alamat === "") {
                alert("Harap lengkapi semua kolom yang diperlukan.");
                return;
            }

            // Add the selected product to the table
            $('#order-table tbody').append('<tr>' +
                '<td>' + productName + '<input type="hidden" name="produk_id[]" value="' + productId + '"></td>' +
                '<td class="jumlah">' + jumlah + '</td>' +
                '<td>' + alamat + '</td>' +
                '<td class="harga">' + harga + '</td>' +
                '<td class="total">' + (harga * jumlah) + '</td>' +
                '</tr>');

            // Update the total pembayaran
            updateTotalPembayaran();
        }

        function updateTotalPembayaran() {
            var totalPembayaran = 0;
            $('#order-table tbody tr').each(function () {
                var jumlah = parseInt($(this).find('.jumlah').text());
                var harga = parseInt($(this).find('.harga').text());
                totalPembayaran += jumlah * harga;
            });

            $('#total_pembayaran').val(totalPembayaran);

            // Update the display in the table footer
            $('#total_pembayaran_display').text(totalPembayaran);
        }

        function submitOrder() {
            // Kumpulkan data dari formulir
            var orderID = $('#order_id').val();
            var alamatPengiriman = $('#alamat_pengiriman').val();
            var totalPembayaran = $('#total_pembayaran').val();

            // Check if the values are not null or undefined
            if (orderID && alamatPengiriman && totalPembayaran) {
                var produkIDs = [];
                var jumlahs = [];

                // Iterasi melalui setiap produk pada tabel pesanan
                $('#order-table tbody tr').each(function () {
                    var produkID = $(this).find('input[name="produk_id[]"]').val();
                    var jumlah = $(this).find('.jumlah').text();

                    produkIDs.push(produkID);
                    jumlahs.push(jumlah);
                });

                // Log the data before making the AJAX request
                console.log('orderID:', orderID);
                console.log('alamatPengiriman:', alamatPengiriman);
                console.log('totalPembayaran:', totalPembayaran);
                console.log('produkIDs:', produkIDs);
                console.log('jumlahs:', jumlahs);

                // Kirim data ke backend menggunakan AJAX
                $.ajax({
                    url: 'controller/createpesanan_controller.php',
                    method: 'POST',
                    data: {
                        orderID: orderID,
                        alamatPengiriman: alamatPengiriman,
                        totalPembayaran: totalPembayaran,
                        produkIDs: produkIDs,
                        jumlahs: jumlahs
                    },
                    success: function (response) {
                        // Tampilkan pesan ke pengguna atau lakukan tindakan lain sesuai kebutuhan

                        alert(response);
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        // Tangani kesalahan jika terjadi
                        console.error(xhr.responseText);
                    }
                });
            } else {
                // Handle the case where one of the values is null or undefined
                alert('Error: One or more form fields are empty.');
            }
        }
    </script>

    </div>

    <script>
        $(document).ready(function () {
            $('#kategori_produk').change(function () {
                var selectedOption = $(this).find('option:selected');
                var harga = selectedOption.data('harga');
                $('#harga').val(harga);
            });
        });
    </script>
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
</body>

</html>