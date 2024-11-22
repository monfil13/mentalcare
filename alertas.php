<?php
session_start();

// Asegurarse de que las variables de sesión existen
if (!isset($_SESSION['depression_score']) || !isset($_SESSION['anxiety_score']) || !isset($_SESSION['stress_score'])) {
    header('Location: autoevaluacion.php');
    exit;
}

// Obtener los puntajes de la sesión
$depression_score = $_SESSION['depression_score'];
$anxiety_score = $_SESSION['anxiety_score'];
$stress_score = $_SESSION['stress_score'];

// Función para generar las tarjetas de alerta según el puntaje
function generateAlertCard($category, $score) {
    if ($score <= 30) {
        // Puntaje favorable
        return "<div style='background-color: lightgreen; color: darkgreen; padding: 20px; margin: 10px; border-radius: 8px; font-weight: bold;'>Tuviste un puntaje favorable en $category, ¡sigue así!</div>";
    } elseif ($score >= 31 && $score <= 69) {
        // Puntaje considerable
        return "<div style='background-color: lightyellow; color: orange; padding: 20px; margin: 10px; border-radius: 8px; font-weight: bold;'>Tuviste un puntaje considerable en $category, ¿deseas verificar los recursos de $category? 
            <a href='recursos.php?categoria=$category' style='color: blue; text-decoration: none;'>Si</a></div>";
    } else {
        // Puntaje alto
        return "<div style='background-color: lightcoral; color: darkred; padding: 20px; margin: 10px; border-radius: 8px; font-weight: bold;'>Tuviste un puntaje alto en $category, revisa los recursos 
            <a href='recursos.php?categoria=$category' style='color: blue; text-decoration: none;'>Ir a recursos</a></div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alertas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #FFCCE5;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            text-align: center;
        }
        .top-menu {
            display: flex;
            justify-content: space-around;
            background-color: #FF66B2;
            padding: 10px;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        .top-menu a {
            color: white;
            font-size: 20px;
            text-decoration: none;
            margin: 0 10px;
            display: flex;
            align-items: center;
        }
        .top-menu a i {
            margin-right: 8px;
        }
        .content {
            margin-top: 80px;
        }
        .result-card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            width: 350px;
            text-align: center;
        }
        .result-card img {
            width: 50px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="top-menu">
    <a href="dashboard.php"><i class="fas fa-home"></i>Inicio</a>
    <a href="autoevaluacion.php"><i class="fas fa-glasses"></i>Autoevaluación</a>
    <a href="recursos.php"><i class="fas fa-book"></i>Recursos</a>
    <a href="alertas.php"><i class="fas fa-exclamation-triangle"></i>Alertas</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Cerrar sesión</a>
</div>

<div class="result-container">
    <!-- Depresión -->
    <div class="category-result">
        <p>Depresión: <?php echo $depression_score; ?> puntos</p>
        <?php echo generateAlertCard('Depresión', $depression_score); ?>
    </div>

    <!-- Ansiedad -->
    <div class="category-result">
        <p>Ansiedad: <?php echo $anxiety_score; ?> puntos</p>
        <?php echo generateAlertCard('Ansiedad', $anxiety_score); ?>
    </div>

    <!-- Estrés -->
    <div class="category-result">
        <p>Estrés: <?php echo $stress_score; ?> puntos</p>
        <?php echo generateAlertCard('Estrés', $stress_score); ?>
    </div>
</div>

</body>
</html>
