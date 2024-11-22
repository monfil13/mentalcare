<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #FFCCE5;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Menú superior */
        .navbar {
            background-color: #FF66B2;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }
        
        .navbar .welcome {
            font-size: 18px;
        }

        .navbar .logout {
            font-size: 18px;
            cursor: pointer;
        }

        .navbar .logout a {
            color: white;
            text-decoration: none;
        }

        .navbar .logout a:hover {
            text-decoration: underline;
        }

        .content {
            margin-top: 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            padding: 20px;
        }

        .menu {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
            text-align: center;
            margin-top: 50px;
        }

        .menu h2 {
            color: #FF66B2;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .menu p {
            margin-bottom: 15px;
            font-size: 18px;
        }

        .menu-options {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            width: 100%;
            flex-wrap: wrap;
        }

        .menu-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #FF66B2;
            color: white;
            padding: 10px 0;
            margin: 10px;
            border-radius: 15px;
            text-decoration: none;
            font-size: 20px;
            transition: background-color 0.3s;
            width: 200px;
            height: 200px;
            box-sizing: border-box;
            overflow: hidden;
            text-align: center;
        }

        .menu-item:hover {
            background-color: #ff3385;
        }

        .menu-item img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin-bottom: 5px;
        }

        .menu-item:hover img {
            opacity: 0.8;
        }
    </style>
</head>
<body>

    <!-- Menú superior -->
    <div class="navbar">
        <div class="welcome">Bienvenido(a), <?php echo $_SESSION['username']; ?>!</div>
        <div class="logout">
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
        </div>
    </div>

    <!-- Contenido -->
    <div class="content">
        <div class="menu">
            <h2>Bienvenido(a), <?php echo $_SESSION['nombre']; ?> <?php echo $_SESSION['apellidos']; ?>!</h2>
            <p>¿Qué deseas consultar?</p>
            <div class="menu-options">
                <a href="autoevaluacion.php" class="menu-item">
                    <img src="assets/auto.png" alt="Autoevaluación">
                    Autoevaluación
                </a>
                <a href="recursos.php" class="menu-item">
                    <img src="assets/recursos.png" alt="Recursos">
                    Recursos
                </a>
                <a href="alertas.php" class="menu-item">
                    <img src="assets/alertas.png" alt="Alertas">
                    Alertas
                </a>
            </div>
        </div>
    </div>

</body>
</html>
