<?php

include 'db_connection.php'; 

$message = ''; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $autor = $_POST['autor'];
    $titulo = $_POST['titulo'];
    $fecha = $_POST['fecha'];

    $imagen_data = null;
    if (!empty($_FILES['portada']['tmp_name'])) {
        $imagen_data = file_get_contents($_FILES['portada']['tmp_name']);
    }

    $sql = "INSERT INTO libros (autor, titulo, fecha_publicacion, imagen_portada)
            VALUES (:autor, :titulo, :fecha, :portada)";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':portada', $imagen_data, PDO::PARAM_LOB);

        $stmt->execute();

        $message = '<div class="alert alert-success mt-3">Libro registrado exitosamente.</div>';
    } catch (PDOException $e) {
        $message = '<div class="alert alert-danger mt-3">Error al registrar: ' . $e->getMessage() . '</div>';
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librería - Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php 
include 'navbar.php'; 
?>

<div class="container mt-5">
    <h2>Registro de Nuevo Libro</h2>
    <?= $message ?> <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        <div class="mb-3">
            <label for="autor" class="form-label">Autor</label>
            <input type="text" class="form-control" id="autor" name="autor" required>
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha de Publicación</label>
            <input type="date" class="form-control" id="fecha" name="fecha">
        </div>
        <div class="mb-3">
            <label for="portada" class="form-label">Imagen de Portada (BLOB/BYTEA)</label>
            <input class="form-control" type="file" id="portada" name="portada" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Libro</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>