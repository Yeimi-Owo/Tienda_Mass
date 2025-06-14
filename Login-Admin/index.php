

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Sesión - TruckMAC</title>
    <link rel="stylesheet" href="../Assets-Admin/css/index.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<!-- NAVBAR -->
<header class="header">
    <nav class="navbar">
      
</header>

<!-- MAIN SECTION -->
<div class="background"></div>
<div class="container">
    <div class="item">
        <h2 class="logo"><i class='bx bxl-xing'></i>TruckMAC</h2>
        <div class="text-item">
            <h2>Bienvenido!<br><span>A Nuestro Sitio Web</span></h2>
            <p>¿Buscas repuestos confiables y al mejor precio? ¡Estás en el lugar correcto!
En nuestra tienda, encontrarás todo lo que necesitas para tu auto, rápido y seguro.
¡No esperes más, tus repuestos te están esperando! 🛠️🔥</p>
            <div class="social-icon">
                <a href="#"><i class='bx bxl-facebook'></i></a>
                <a href="#"><i class='bx bxl-twitter'></i></a>
                <a href="#"><i class='bx bxl-youtube'></i></a>
                <a href="#"><i class='bx bxl-instagram'></i></a>
                <a href="#"><i class='bx bxl-linkedin'></i></a>
            </div>
        </div>
    </div>

    <div class="login-section">

        <!-- LOGIN FORM -->
        <div class="form-box login">
            <form action="php/login_usuario_be.php" method="POST">
                <h2>Ingresa tu cuenta</h2>
                <div class="input-box">
                    <span class="icon"><i class='bx bxs-envelope'></i></span>
                    <input type="email" name="email" required>
                    <label>Correo</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                    <input type="password" name="contrasena" required style="color: white;">
                    <label>Contraseña</label>
                </div>
                <div class="remember-password">
                    <label><input type="checkbox" name="remember"> No olvidar</label>
                    <a href="#">Olvidaste Contraseña?</a>
                </div>
                <button type="submit" class="btn">Ingresar</button>
                <div class="create-account">
                    <br>
                    <p>Deseas ir a la Plataforma Web? <a href="../Vista/Home/Index.php" class="register-link">Ingrese Aqui!!</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../Assets-Admin/js/index.js"></script>

</body>
</html>