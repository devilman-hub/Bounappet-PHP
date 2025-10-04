<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="../css/login.css">
</head>
<body>

  <div class="login-container">
    <h2>¡Bienvenido, Corazóne!</h2>

    <form action = "../../controlador/usuariocontroller.php">

     <label for="email">Correo electrónico</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Contraseña</label>
    <input type="password" id="password" name="password" required>

      <button type="submit">Ingresar</button>

    </form>

    <p class="registro">¿No tienes cuenta? <a href="#">¡Regístrate!</a></p>

  </div>

</body>
</html>
