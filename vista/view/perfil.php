<?php

session_start();

//Si no hay Usuarios Logueados, redirige al Login.

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;

}

    $usuario = $_SESSION['usuario'];

    require_once __DIR__ . "../../config/conexion.php"; //Ajustar ruta si es necesario.
    $pdo = Database::connect();

    $usuariosRegistrados = [];
    $error = '';

//Solo carga Usuarios y Permite Eliminar si es Admin.

if ($usuario['rol'] === 'Admin'){

    //Eliminar Usuario si viene por GET.
    if (isset($_GET['eliminar'])){
        $idEliminar = (int)$_GET['eliminar'];
        if ($idEliminar !=== $usuario['id_usuario']){ //No puede eliminar a si mismo.
            $stmtDel = $pdo->prepare("DELETE FROM usuarios WHERE id_usuario = ?");
            $stmtDel->execute([$idEliminar]);
            header("Location: perfil.php");
            exit;

        }else{
            $error = "No Puede Eliminarse A Si Mismo.";

        }

    }

    //Obtener Usuarios.

    $stmt = $pdo->query("SELECT id_usuario, nombre, email, telefono, rol FROM usuarios");
    $usuariosRegistrados = $stmt->fetchAll(PDO::FETCH_ASSOC);

}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil Usuario</title>
    <link rel="stylesheet" href="../css/perfil.css">
</head>
<body>
    <div class="container">
        <h2 class="title">Bienvenido, <?= htmlspecialchars($usuario['nombre']) ?></h2>
        <p class="subtitle">(<?= htmlspecialchars($usuario['Rol']) ?>)</p>

        <?php if ($usuario['rol'] === 'Admin'): ?>
            <h3 class="subtitle">Opciones de Administrador</h3>
            <ul class="options-list">
                <li><a href="./registrarusuarios.php">Registrar Usuarios</a></li>
                <li><a href="#">Otra opción</a></li>
            </ul>

            <?php if ($error): ?>
                <p style="color:red;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <h3 class="subtitle">Lista de Usuarios Registrados</h3>
            <table border="1" cellpadding="8" cellspacing="0" style="width:100%; margin-top: 15px;">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Rol</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($usuariosRegistrados as $u): ?>
                        <tr>
                            <td><?= htmlspecialchars($u['id_usuario']) ?></td>
                            <td><?= htmlspecialchars($u['Nombre']) ?></td>
                            <td><?= htmlspecialchars($u['Email']) ?></td>
                            <td><?= htmlspecialchars($u['Telefono']) ?></td>
                            <td><?= htmlspecialchars($u['Rol']) ?></td>
                            <td>
                                <?php if ($u['id_usuario'] !== $usuario['id_usuario']): ?>
                                    <a href="?eliminar=<?= $u['id_usuario'] ?>" 
                                       onclick="return confirm('¿Eliminar usuario <?= htmlspecialchars($u['Nombre']) ?>?')"
                                       style="color:red; text-decoration:none;">Eliminar</a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php endif; ?>

        <a class="logout-btn" href="logout.php">Cerrar Sesión</a>
    </div>
</body>
</html>

