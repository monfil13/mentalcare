<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Care</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #FFCCE5;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }
        h2 {
            font-size: var(--titulo-tamano, 36px);
            color: #FF66B2;
            margin-bottom: 15px;
        }
        img {
            width: var(--imagen-ancho, 300px);
            height: var(--imagen-altura, 300px);
            margin-bottom: 20px;
        }
        .login-form {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }
        .login-form input {
            width: 100%;
            padding: 15px;
            margin: 15px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .login-form button {
            background-color: #FF66B2;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .login-form button:hover {
            background-color: #ff3385;
        }
        .login-form a {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #FF66B2;
            text-decoration: none;
            font-size: 16px;
        }
        .login-form a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Mental Care</h2>
    <img src="assets/brainless.png" alt="Logo Brainless">
    <div class="login-form">
        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Nombre de usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
        <a href="registro.php">¿No tienes cuenta? Regístrate aquí</a>
    </div>
</body>
</html>
