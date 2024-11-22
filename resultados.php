<?php
session_start();

// Asegurarse de que las variables de sesión existen
if (!isset($_SESSION['depression']) || !isset($_SESSION['anxiety']) || !isset($_SESSION['stress'])) {
    header('Location: autoevaluacion.php');
    exit;
}

// Obtener los puntajes de las respuestas almacenadas en sesión
$depression_score = $_SESSION['depression'];
$anxiety_score = $_SESSION['anxiety'];
$stress_score = $_SESSION['stress'];

// Función para obtener la imagen correspondiente según el puntaje
function getImage($score) {
    if ($score <= 30) {
        return 'bien.png';
    } elseif ($score >= 31 && $score <= 69) {
        return 'regular.png';
    } else {
        return 'mal.png';
    }
}

// Guardamos los puntajes en la sesión para usarlos en alertas.php
$_SESSION['depression_score'] = $depression_score;
$_SESSION['anxiety_score'] = $anxiety_score;
$_SESSION['stress_score'] = $stress_score;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #FFCCE5;
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            min-height: 100vh;
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
        .top-menu a:hover {
            color: #ff3385;
        }
        .result-container {
            margin-top: 80px;
            display: flex;
            justify-content: space-evenly;
            width: 100%;
            padding: 20px;
        }
        .category-result {
            text-align: center;
        }
        .category-result img {
            width: 150px;
            height: auto;
            margin-bottom: 10px;
        }
        .alert-button {
            background-color: #FF66B2;
            color: white;
            padding: 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }
        .alert-button:hover {
            background-color: #ff3385;
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
    <div class="category-result">
        <img src="assets/<?php echo getImage($depression_score); ?>" alt="Depresión">
        <p>Depresión: <?php echo $depression_score; ?> puntos</p>
    </div>
    <div class="category-result">
        <img src="assets/<?php echo getImage($anxiety_score); ?>" alt="Ansiedad">
        <p>Ansiedad: <?php echo $anxiety_score; ?> puntos</p>
    </div>
    <div class="category-result">
        <img src="assets/<?php echo getImage($stress_score); ?>" alt="Estrés">
        <p>Estrés: <?php echo $stress_score; ?> puntos</p>
    </div>
</div>

<!-- El botón ahora redirige a alertas.php -->
<a href="alertas.php" class="alert-button">Ver mis alertas</a>

</body>
</html>
