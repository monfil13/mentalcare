<?php
include('config.php');

$message = ''; // Variable para almacenar mensajes de error o éxito

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Verificar si el usuario ya existe en la base de datos
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $userExists = $stmt->fetchColumn();

    if ($userExists) {
        $message = "<p style='color: red;'>Este usuario ya existe. Intenta con otro nombre de usuario.</p>";
    } elseif ($password !== $confirm_password) {
        $message = "<p style='color: red;'>Las contraseñas no coinciden.</p>";
    } else {
        // Si no existe, registrar al nuevo usuario
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, apellidos, username, password) VALUES (:nombre, :apellidos, :username, :password)");
        $stmt->execute([
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'username' => $username,
            'password' => $hashed_password
        ]);

        $message = "<p style='color: green;'>Usuario registrado correctamente. <a href='index.php'>Iniciar sesión</a></p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #FFCCE5;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-form {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        .register-form h2 {
            color: #FF66B2;
            margin-bottom: 20px;
        }
        .register-form input {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .register-form button {
            background-color: #FF66B2;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        .register-form button:hover {
            background-color: #ff3385;
        }
        .register-form a {
            display: block;
            margin-top: 15px;
            color: #FF66B2;
            text-decoration: none;
        }
        .register-form a:hover {
            text-decoration: underline;
        }
        .message {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="register-form">
        <h2>Registro</h2>
        <form action="registro.php" method="POST">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="text" name="apellidos" placeholder="Apellidos" required>
            <input type="text" name="username" placeholder="Nombre de usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="password" name="confirm_password" placeholder="Confirmar Contraseña" required>
            <button type="submit">Registrar</button>
        </form>
        <a href="index.php">¿Ya tienes cuenta? Inicia sesión aquí</a>
        
        <!-- Mostrar mensaje debajo del formulario -->
        <div class="message">
            <?php echo $message; ?>
        </div>
    </div>

</body>
</html>
