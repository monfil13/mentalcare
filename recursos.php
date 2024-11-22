<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// Obtener la categoría seleccionada desde la URL
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

// Conectar a la base de datos (asegúrate de cambiar estos valores a los correctos)
$host = 'localhost';  // Cambia por tu host
$dbname = 'mentalcare';  // Cambia por el nombre de tu base de datos
$username = 'root';  // Cambia por tu nombre de usuario
$password = 'daniel123';  // La contraseña de tu base de datos

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Filtrar los recursos por categoría, si existe
    $query = "SELECT * FROM recursos";
    if ($categoria) {
        $query .= " WHERE categoria = :categoria";
    }
    $stmt = $pdo->prepare($query);
    
    // Si existe la categoría, la vinculamos a la consulta
    if ($categoria) {
        $stmt->bindParam(':categoria', $categoria);
    }
    
    $stmt->execute();
    $recursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Mapa de IDs a imágenes
$imagenes_por_id = [
    1 => '1.jpg', 2 => '2.jpg', 3 => '3.jpg', 4 => '4.jpg', 5 => '5.jpg',
    6 => '6.jpg', 7 => '7.jpg', 8 => '8.jpg', 9 => '9.jpg', 10 => '10.jpg',
    11 => '11.jpg', 12 => '12.jpg', 16 => '13.jpg', 17 => '14.jpg', 18 => '15.jpg',
    19 => '16.jpg', 20 => '17.jpg', 21 => '18.jpg', 22 => '19.jpg', 23 => '20.jpg',
    24 => '21.jpg', 25 => '22.jpg', 26 => '23.jpg', 27 => '24.jpg', 30 => '25.jpg',
    31 => '26.jpg', 35 => '27.jpg', 36 => '28.jpg', 37 => '29.jpg', 38 => '30.jpg',
    39 => '31.jpg', 40 => '32.jpg', 41 => '33.jpg', 42 => '34.jpg', 43 => '35.jpg'
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recursos</title>
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
        .content {
            margin-top: 80px;
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
            max-width: 1200px;
            text-align: center;
            margin-top: 50px;
        }
        .menu h2 {
            color: #FF66B2;
            margin-bottom: 20px;
        }
        .menu p {
            margin-bottom: 15px;
        }
        table, th, td {
            border: 1px solid #FF66B2;
        }
        th, td {
            padding: 15px;
            text-align: center;
        }
        th {
            background-color: #FF66B2;
            color: white;
        }
        td img {
            width: 150px;  /* Aumentando el tamaño de las imágenes */
            height: auto;
        }
        table { width: 100%; max-width: 1700px; margin-top: 20px; border-collapse: collapse; }
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

    <div class="content">
        <div class="menu">
            <h2>Recursos</h2>
            <p>Accede a recursos para mejorar tu bienestar mental.</p>
            <table>
                <tr>
                    <th>Imagen</th>
                    <th>Tipo</th>
                    <th>Categoría</th>
                    <th>Título</th>
                    <th>Formato</th>
                    <th>Enlace</th>
                    <th>Descripción</th>  <!-- Agregamos la columna de descripción -->
                </tr>
                <?php
                foreach ($recursos as $recurso): 
                    // Asignamos la imagen basada en el ID del recurso
                    $imagen = isset($imagenes_por_id[$recurso['id']]) ? $imagenes_por_id[$recurso['id']] : 'default.jpg'; // Imagen por defecto si el ID no está mapeado
                ?>
                <tr>
                    <td><img src="assets/<?php echo $imagen; ?>" alt="Imagen del recurso"></td>
                    <td><?php echo $recurso['tipo']; ?></td>
                    <td><?php echo $recurso['categoria']; ?></td>
                    <td><?php echo $recurso['titulo']; ?></td>
                    <td><?php echo $recurso['formato']; ?></td>
                    <td><a href="<?php echo $recurso['enlace']; ?>" target="_blank">Ver</a></td>
                    <td><?php echo $recurso['descripcion']; ?></td> <!-- Colocamos la descripción del recurso -->
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>
