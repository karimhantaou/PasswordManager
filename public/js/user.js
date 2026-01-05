let password = document.getElementById("password");
password.addEventListener("focus", function() {
    password.type = "text";
});

password.addEventListener("focusout", function() {
    password.type = "password";
});
