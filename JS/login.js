function Login() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    if (username && password){
        alert(`username: ${username}\npassword: ${password}`)
        return;   
    }else{
        alert("HAY JANGAN SAMPAI LUPA DI ISI")
        // Baris kode ini mencegah formulir dikirimkan jika bidang nama pengguna atau kata sandi kosong.
        event.preventDefault();
        return;
    }
}
document.getElementById("submit").addEventListener("click", Login)