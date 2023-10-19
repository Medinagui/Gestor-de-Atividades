document.getElementById("login-form").addEventListener("submit", function (e) {
    e.preventDefault();
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    // Enviar dados para o servidor usando AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "login.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            if (response === "success") {
                window.location.href = "principal.php";
            } else {
                // Mostrar uma mensagem de erro ao usuário
                alert("Usuário ou senha incorretos. Tente novamente.");
            }
        }
    };
    xhr.send("username=" + username + "&password=" + password);
});
