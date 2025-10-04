<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Usuarios</title>
    <link rel="stylesheet" href="../css/usuarios.css">
</head>
<body>
    <div class="registro-container">
        <h2 class="titulo">Formulario de Registro</h2>

        <form action="../../controlador/usuariocontroller.php" method="POST" class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" required>
            </div>

            <div class="campo">
                <label for="email">Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="campo">
                <label for="telefono">Teléfono</label>
                <input type="number" name="telefono" required>
            </div>

            <div class="campo">
                <label for="rol">Rol</label>
                <select name="rol" id="rol" required>
                    <option value=""></option>
                    <option value="usuario">Usuario</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="campo">
                <label for="password">Contraseña</label>
                <input type="password" name="contraseña" required>
            </div>

            <div class="boton">
                <input type="submit" value="registrarse">
            </div>
        </form>
    </div>
</body>
</html>
