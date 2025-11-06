<?php
include 'db_connection.php'; // Incluye la conexión a la base de datos

// Lógica PHP para consultar y obtener los libros
$sql = "SELECT id, autor, titulo, fecha_publicacion, imagen_portada FROM libros ORDER BY titulo ASC";
$stmt = $pdo->query($sql);
$libros = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Función auxiliar para generar la URL de la imagen (PHP)
function get_image_url($id) {
    // Apunta a nuestro script que sirve la imagen binaria desde la BD
    return "serve_image.php?id=" . $id;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librería - Consulta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include 'navbar.php'; // Incluye la barra de navegación con HTML/Bootstrap ?>

<div class="container mt-5">
    <h2>Libros Registrados</h2>

    <!-- Contenedor para mostrar los libros con Bootstrap Cards --><div class="row row-cols-1 row-cols-md-3 g-4">
        <?php if (count($libros) > 0): ?>
            <?php foreach ($libros as $libro): ?>
                <div class="col">
                    <div class="card h-100">
                        <!-- La imagen se carga a través del script PHP --><img src="<?= get_image_url($libro['id']) ?>" class="card-img-top" alt="Portada de <?= htmlspecialchars($libro['titulo']) ?>" style="height: 300px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($libro['titulo']) ?></h5>
                            <p class="card-text">
                                <strong>Autor:</strong> <?= htmlspecialchars($libro['autor']) ?><br>
                                <strong>Fecha:</strong> <?= htmlspecialchars($libro['fecha_publicacion']) ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-info">No hay libros registrados aún.</div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>