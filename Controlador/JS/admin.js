document.getElementById("login-form").addEventListener("submit", function(event) {
    event.preventDefault(); // Evita que el formulario se envíe automáticamente
  
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
  
    // Validar los campos del formulario
    if (username === "" || password === "") {
      alert("Por favor, completa todos los campos");
      return;
    }
  
    // Realizar una solicitud AJAX para enviar los datos del formulario al archivo PHP
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "login.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var response = xhr.responseText;
        alert(response);
        // Aquí puedes realizar acciones adicionales según la respuesta recibida
      }
    };
    xhr.send("username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password));
  });
  