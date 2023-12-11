function InputRegistration() {
    let full_name = document.getElementById("full_name").value;
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    let email = document.getElementById("email").value;
    let phone_number = document.getElementById("phone_number").value;

    if (full_name && username && password && email && phone_number){
        alert(`full_name: ${full_name}\nusername: ${username}\npassword: ${password}\nemail: ${email}\nphone_number: ${phone_number}`)
        return;
    }else{
        alert("HAYY..TOLONG DISINI DULU YAAA")
        // This line of code prevents the form from being submitted if the username or password fields are empty.
        event.preventDefault();
        return;
    }
}
document.getElementById("submit").addEventListener("click", InputRegistration)
