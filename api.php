<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Parámetros de conexión a la base de datos
$servername = "localhost";      
$username = "root";             
$password = "";                  
$dbname = "contacto";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de Conexión: " . $conn->connect_error);
}

///////////////////////////////////////
// INSERTAR CONTACTO
///////////////////////////////////////
if (isset($_REQUEST['save'])) {
    $apellido_paterno = $_REQUEST['apellidop'];
    $apellido_materno = $_REQUEST['apellidom'];
    $nombre = $_REQUEST['nombre'];
    $telefono = $_REQUEST['telefono'];
    $Email = $_REQUEST['Email'];

    $sql = "INSERT INTO contactos (apellido_paterno, apellido_materno, nombre, telefono, Email)
            VALUES ('$apellido_paterno', '$apellido_materno', '$nombre', '$telefono', '$Email')";

    if ($conn->query($sql) === TRUE) {
        die("Registro Guardado Exitosamente");
    } else {
        die("Error: " . $sql . "<br>" . $conn->error);
    }
}

///////////////////////////////////////
// LISTAR CONTACTOS
///////////////////////////////////////
if (isset($_REQUEST['fetch'])) {
    $sql = "SELECT * FROM contactos ORDER BY id DESC";
    $result = $conn->query($sql);

    $contactos = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $contactos[] = $row;
        }
    }

    echo json_encode($contactos);
}

$conn->close();
?>
