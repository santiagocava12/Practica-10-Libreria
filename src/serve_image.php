<?php
include 'db_connection.php'; 

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('HTTP/1.0 400 Bad Request');
    exit;
}

$id = $_GET['id'];
$sql = "SELECT imagen_portada FROM libros WHERE id = :id";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $libro = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($libro && $libro['imagen_portada']) {
        // Establece la cabecera del tipo de contenido. 
        // ASUMIMOS que son JPG. Si necesitas PNG/GIF, puedes 
        // intentar detectar el tipo de imagen o almacenar el mime_type en la BD.
        header('Content-Type: image/jpeg'); 
        
        // La imagen se sirve directamente desde el dato binario
        echo $libro['imagen_portada']; 
    } else {
        // Si no se encuentra la imagen, envía un 404
        header('HTTP/1.0 404 Not Found');
        // O podrías servir una imagen de placeholder si lo deseas:
        // readfile('path/to/placeholder.jpg'); 
    }
} catch (PDOException $e) {
    header('HTTP/1.0 500 Internal Server Error');
    echo "Error: " . $e->getMessage();
}
?>