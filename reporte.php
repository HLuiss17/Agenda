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

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Establecer encabezados para la descarga del archivo CSV
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=Reporte_Agenda.csv');

    // Abrir un archivo temporal en memoria para escribir los datos
    $output = fopen('php://output', 'w');

    // Escribir la fila de encabezados
    fputcsv($output, array('Id', 'Nombre', 'Apellido', 'Telefono', 'Correo'));

    // Escribir los datos de cada estudiante en el archivo CSV
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }

    // Cerrar el archivo temporal
    fclose($output);
} else {
    echo "No hay datos disponibles para exportar.";
}

// Cerrar la conexión a la base de datos
$conn->close();
exit();
?>