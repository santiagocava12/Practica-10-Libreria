<?php
// Asegúrate de que SOLO este archivo incluya la conexión.
include 'db_connection.php'; 

// Las siguientes líneas son CRUCIALES para evitar errores de cabecera:
ob_clean(); // Limpia cualquier salida de buffer anterior
header_remove(); // Elimina cualquier cabecera HTTP previa

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
        // Establecer la cabecera Content-Type
        // Usamos image/jpeg como estándar, si subiste PNG, podría fallar.
        // Si necesitas manejar ambos, guarda el tipo MIME en la BD.
        header('Content-Type: image/jpeg'); 
        
        // Establece la longitud del contenido
        header('Content-Length: ' . strlen($libro['imagen_portada']));

        // Sirve la imagen binaria (el dato BYTEA)
        echo $libro['imagen_portada']; 
        exit; // Termina la ejecución para que no se envíe código HTML residual
    } else {
        header('HTTP/1.0 404 Not Found');
        // Opcional: Podrías redirigir a una imagen de placeholder
    }
} catch (PDOException $e) {
    header('HTTP/1.0 500 Internal Server Error');
    // NO DEBERÍAS mostrar el mensaje de error aquí, podría corromper la imagen
    // echo "Error: " . $e->getMessage(); 
}
?>