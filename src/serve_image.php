<?php
if (ob_get_level()) {
    ob_end_clean();
}

include 'db_connection.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('HTTP/1.0 400 Bad Request');
    exit;
}

$id = (int) $_GET['id'];

$sql = "SELECT imagen_portada FROM libros WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$libro = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$libro || !$libro['imagen_portada']) {
    header('HTTP/1.0 404 Not Found');
    exit;
}

$imagen = $libro['imagen_portada'];


if (is_resource($imagen)) {
    $imagen = stream_get_contents($imagen);
}


if (is_string($imagen) && str_starts_with($imagen, "\\x")) {
    $imagen = hex2bin(substr($imagen, 2));
}

header("Content-Type: image/png");
header("Content-Length: " . strlen($imagen));

echo $imagen;
exit;
