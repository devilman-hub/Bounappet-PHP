<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar</title>
  <link rel="stylesheet" href="../css/registro.css">
</head>
<body>
  <div class="registro-container">
    <form action="registro.php" class="formulario" method = "POST">
      <h2 class="titulo">¡Regístrate!</h2>

      <div class="campo">
        <label for="nombre">Nombre Completo</label>
        <input type="text" id="nombre" name="nombre" class="input" required>
      </div>

      <div class="campo">
        <label for="email">Correo Electrónico</label>
        <input type="email" id="email" name="email" class="input" required>
      </div>

      <div class="campo">
        <label for="telefono">Teléfono</label>
        <input type="text" id="telefono" name="telefono" class="input" required>
      </div>

      <div class="campo">
        <label for="rol">Rol</label>
        <select id="rol" name="rol" class="input" required>
            <option value=""> Seleccionar</option>
            <option value="usuario">Usuario</option>
            <option value="admin">Administrador</option>
       </select>
      </div>

      <div class="campo">
        <label for="contraseña">Contraseña</label>
        <input type="password" id="contraseña" name="contraseña" class="input" required>
      </div>

      <div class="boton">
        <input type="submit" value="Enviar">
      </div>
    </form>
  </div>
</body>
</html>
