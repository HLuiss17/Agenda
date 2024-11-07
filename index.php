

<?php
// Datos de conexión a la base de datos MySQL
$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "agenda_telefonica";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Realizar la consulta SQL para obtener los datos de los estudiantes
$sql = "SELECT * FROM agenda";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contactos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f0f0f0;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn-download {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #4CAF50;
            border: none;
            cursor: pointer;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-download:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Lista de Contactos</h1>

    <!-- Tabla de estudiantes -->
    <table>
        <tr>
            
            <th>Id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Telefono</th>
            <th>Correo</th>
        </tr>

        <?php
        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            // Mostrar cada fila de resultados
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["nombre"] . "</td>
                        <td>" . $row["apellido"] . "</td>
                        <td>" . $row["telefono"] . "</td>
                        <td>" . $row["email"] . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='11'>No se encontraron registros</td></tr>";
        }
        ?>
    </table>

    <!-- Botón para descargar el reporte -->
    <a href="reporte.php" class="btn-download">Descargar Reporte CSV</a>

</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>