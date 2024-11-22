<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Guardar las respuestas en variables de sesión para poder acceder a ellas en resultados.php
    $_SESSION['depression'] = array_sum([
        isset($_POST['depression1']) ? $_POST['depression1'] : 0,
        isset($_POST['depression2']) ? $_POST['depression2'] : 0,
        isset($_POST['depression3']) ? $_POST['depression3'] : 0,
        isset($_POST['depression4']) ? $_POST['depression4'] : 0,
        isset($_POST['depression5']) ? $_POST['depression5'] : 0,
        isset($_POST['depression6']) ? $_POST['depression6'] : 0,
        isset($_POST['depression7']) ? $_POST['depression7'] : 0,
        isset($_POST['depression8']) ? $_POST['depression8'] : 0,
        isset($_POST['depression9']) ? $_POST['depression9'] : 0,
        isset($_POST['depression10']) ? $_POST['depression10'] : 0,
    ]);

    $_SESSION['anxiety'] = array_sum([
        isset($_POST['anxiety1']) ? $_POST['anxiety1'] : 0,
        isset($_POST['anxiety2']) ? $_POST['anxiety2'] : 0,
        isset($_POST['anxiety3']) ? $_POST['anxiety3'] : 0,
        isset($_POST['anxiety4']) ? $_POST['anxiety4'] : 0,
        isset($_POST['anxiety5']) ? $_POST['anxiety5'] : 0,
        isset($_POST['anxiety6']) ? $_POST['anxiety6'] : 0,
        isset($_POST['anxiety7']) ? $_POST['anxiety7'] : 0,
        isset($_POST['anxiety8']) ? $_POST['anxiety8'] : 0,
        isset($_POST['anxiety9']) ? $_POST['anxiety9'] : 0,
        isset($_POST['anxiety10']) ? $_POST['anxiety10'] : 0,
    ]);

    $_SESSION['stress'] = array_sum([
        isset($_POST['stress1']) ? $_POST['stress1'] : 0,
        isset($_POST['stress2']) ? $_POST['stress2'] : 0,
        isset($_POST['stress3']) ? $_POST['stress3'] : 0,
        isset($_POST['stress4']) ? $_POST['stress4'] : 0,
        isset($_POST['stress5']) ? $_POST['stress5'] : 0,
        isset($_POST['stress6']) ? $_POST['stress6'] : 0,
        isset($_POST['stress7']) ? $_POST['stress7'] : 0,
        isset($_POST['stress8']) ? $_POST['stress8'] : 0,
        isset($_POST['stress9']) ? $_POST['stress9'] : 0,
        isset($_POST['stress10']) ? $_POST['stress10'] : 0,
    ]);

    header('Location: resultados.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autoevaluación</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #FFCCE5;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            min-height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-top: 50px;
        }

        .card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 32%; /* Reduce el tamaño para que quepan tres tarjetas en una fila */
            margin-bottom: 20px;
            text-align: left;
            box-sizing: border-box;
        }

        .card h3 {
            color: #FF66B2;
            margin-bottom: 20px;
            font-size: 20px;
        }

        .card label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .card select {
            padding: 8px;
            font-size: 16px;
            width: 100%;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .submit-btn {
            background-color: #FF66B2;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 30px;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #FF3385;
        }

        h2 {
            margin-top: 30px;
            color: #FF66B2;
        }

        .subtitle {
            font-size: 18px;
            margin-bottom: 30px;
            color: #333;
        }

        @media (max-width: 768px) {
            .card {
                width: 48%; /* En pantallas más pequeñas, las tarjetas ocupan menos espacio */
            }
        }

        @media (max-width: 480px) {
            .card {
                width: 100%; /* En pantallas muy pequeñas, las tarjetas se apilan */
            }
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

    </style>
</head>
    <div class="top-menu">
        <a href="dashboard.php"><i class="fas fa-home"></i>Inicio</a>
        <a href="autoevaluacion.php"><i class="fas fa-glasses"></i>Autoevaluación</a>
        <a href="recursos.php"><i class="fas fa-book"></i>Recursos</a>
        <a href="alertas.php"><i class="fas fa-exclamation-triangle"></i>Alertas</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Cerrar sesión</a>
    </div>

<body>
<h2> </h2>
    <h2>Realiza la Autoevaluación</h2>
    <p class="subtitle">Evalúa tu estado de ansiedad, estrés y depresión contestando las siguientes preguntas:</p>

    <form method="POST" action="autoevaluacion.php">
        <div class="container">
            <div class="card">
                <h3>Depresión</h3>
                <?php
                    $depression_questions = [
                        "¿Has perdido interés en actividades que antes disfrutabas hacer?",
                        "¿Tienes dificultades para dormir o duermes demasiado?",
                        "¿Te sientes cansado o sin energía la mayoría de los días?",
                        "¿Te sientes solo o aislado de los demás?",
                        "¿Tienes dificultades para concentrarte y tomar decisiones académicamente?",
                        "¿Has experimentado cambios en tu rendimiento académico o en tu asistencia a clases?",
                        "¿Tienes problemas para concentrarte en tus estudios o en otras tareas?",
                        "¿Has notado cambios en tu apetito, como comer en exceso o no comer lo suficiente?",
                        "¿Has tenido pensamientos de hacerte daño o de suicidarte?",
                        "¿Has notado que te cuesta recordar cosas o que tu memoria se ha visto afectada?"
                    ];
                    for ($i = 1; $i <= 10; $i++) {
                        echo "<label>{$depression_questions[$i-1]}</label>";
                        echo "<select name='depression{$i}'>
                                <option value='0'>Selecciona...</option>
                                <option value='1'>1</option>
                                <option value='2'>2</option>
                                <option value='3'>3</option>
                                <option value='4'>4</option>
                                <option value='5'>5</option>
                                <option value='6'>6</option>
                                <option value='7'>7</option>
                                <option value='8'>8</option>
                                <option value='9'>9</option>
                                <option value='10'>10</option>
                              </select>";
                    }
                ?>
            </div>

            <div class="card">
                <h3>Ansiedad</h3>
                <?php
                    $anxiety_questions = [
                        "¿Dificultad para concentrarte debido a preocupaciones?",
                        "¿Te has sentido inquieto o intranquilo?",
                        "¿Problemas para relajarte?",
                        "¿Irritable debido al estrés?",
                        "¿Dificultad para controlar preocupaciones?",
                        "¿Problemas para dormir debido a la ansiedad?",
                        "¿Siente molestias (sudoración de manos, dolor de cabeza, temblores, náuseas etc.) que afectan su rendimiento?",
                        "¿Siente que le falta el aire cuando piensa en los exámenes?",
                        "¿Tiene ganas de huir de un examen?",
                        "¿Hay días que le falta energía para concentrarse?"
                    ];
                    for ($i = 1; $i <= 10; $i++) {
                        echo "<label>{$anxiety_questions[$i-1]}</label>";
                        echo "<select name='anxiety{$i}'>
                                <option value='0'>Selecciona...</option>
                                <option value='1'>1</option>
                                <option value='2'>2</option>
                                <option value='3'>3</option>
                                <option value='4'>4</option>
                                <option value='5'>5</option>
                                <option value='6'>6</option>
                                <option value='7'>7</option>
                                <option value='8'>8</option>
                                <option value='9'>9</option>
                                <option value='10'>10</option>
                              </select>";
                    }
                ?>
            </div>

            <div class="card">
                <h3>Estrés</h3>
                <?php
                    $stress_questions = [
                        "¿Cuánto estrés sientes al despertar por la mañana?",
                        "¿Cuánto estrés te causa la tecnología (teléfonos, computadoras, etc.)?",
                        "¿Cuánto estrés sientes cuando estás en un lugar público?",
                        "¿Cuánto estrés te causa la falta de privacidad?",
                        "¿Cuánto estrés sientes cuando tienes que tomar decisiones importantes?",
                        "¿Cuánto estrés te causa la presión para mantener una imagen perfecta?",
                        "¿Cuánto estrés sientes cuando estás en un entorno ruidoso?",
                        "¿Cuánto estrés te causa la falta de control sobre tus finanzas?",
                        "¿Cuánto estrés sientes cuando tienes que enfrentar un desafío nuevo?",
                        "¿Cuánto estrés te causa la sensación de no tener suficiente tiempo libre?"
                    ];
                    for ($i = 1; $i <= 10; $i++) {
                        echo "<label>{$stress_questions[$i-1]}</label>";
                        echo "<select name='stress{$i}'>
                                <option value='0'>Selecciona...</option>
                                <option value='1'>1</option>
                                <option value='2'>2</option>
                                <option value='3'>3</option>
                                <option value='4'>4</option>
                                <option value='5'>5</option>
                                <option value='6'>6</option>
                                <option value='7'>7</option>
                                <option value='8'>8</option>
                                <option value='9'>9</option>
                                <option value='10'>10</option>
                              </select>";
                    }
                ?>
            </div>
        </div>

        <button type="submit" class="submit-btn">Enviar respuestas</button>
    </form>
</body>
</html>
