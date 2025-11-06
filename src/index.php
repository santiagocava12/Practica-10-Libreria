<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librería - Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Bienvenido al Registro de Libros</h1>
            <p class="col-md-8 fs-4">Utiliza la barra de navegación para registrar nuevos libros o consultar la colección existente.</p>
            <a class="btn btn-primary btn-lg" href="registro.php" role="button">Registrar Libro</a>
            <a class="btn btn-secondary btn-lg" href="consulta.php" role="button">Ver Libros</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>