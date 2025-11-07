# 📚 README: Sistema de Gestión de Libros con Docker y PostgreSQL

¡Bienvenido a mi proyecto de librería\! Este sistema es un registro simple de libros que utiliza **Docker** para su entorno, **PostgreSQL** como base de datos y **PHP con Bootstrap** para la interfaz web.

## Cómo Poner Esto en Marcha (El Entorno Docker)

Para correr este proyecto, solo necesitás tener **Docker** y **Docker Compose** instalados.

1.  **Colócate en la carpeta del proyecto:**
    Abre tu terminal y navega a la carpeta principal donde están `docker-compose.yml`, `Dockerfile` y la carpeta `src/`.

    ```bash
    cd /ruta/a/tu/carpeta/docker-libros
    ```

2.  **Iniciar los Contenedores:**
    Este comando construye el contenedor web (instalando el driver de PostgreSQL) e inicia todos los servicios.

    ```bash
    docker compose up -d --build
    ```

    *El primer inicio puede tardar un poco mientras Docker construye la imagen web.*

3.  **Verificar el Estado:**
    Asegúrate de que los tres servicios (`web_libros`, `postgres_libros_db`, `pgadmin_libros`) estén en estado `Up` (corriendo):

    ```bash
    docker ps
    ```

-----

## Acceso al Sistema

Una vez que los contenedores estén corriendo, puedes acceder a los siguientes servicios en tu navegador:

| Servicio | Puerto de Acceso | URL |
| :--- | :--- | :--- |
| **Página Web** | 80 | `http://localhost` |
| **Administrador DB** | 8082 | `http://localhost:8082` |

### Credenciales de Conexión

| Servicio | Usuario | Contraseña | Notas |
| :--- | :--- | :--- | :--- |
| **PostgreSQL** | `postgres` | `1234` | Host interno: `db_pg` (para conexión desde PHP) |
| **pgAdmin** | `yosoycavazos@gmail.com` | `1234` | Para acceder al panel de administración. |

-----

## Tecnologías Utilizadas

| Componente | Tecnología | Rol |
| :--- | :--- | :--- |
| **Base de Datos** | **PostgreSQL** (`postgres:latest`) | Almacena datos relacionales. |
| **Imagen** | Tipo de dato **`BYTEA`** (BLOB) | Almacena la imagen de portada directamente en la BD. |
| **Servidor Web** | **PHP 8.2 + Apache** | Ejecuta la lógica del sistema (incluye el driver `pdo_pgsql`). |
| **Estilos/Diseño** | **Bootstrap 5** | Interfaz responsive para las páginas web. |

## Notas Importantes de Desarrollo

  * **Archivos de Código:** Todo el código PHP/HTML/Bootstrap está en la carpeta **`src/`**.
  * **Imágenes (BLOB):** El archivo **`serve_image.php`** es clave. Lee el dato binario (`BYTEA`) desde la base de datos y lo sirve al navegador con la cabecera `Content-Type: image/png` para que se visualice la imagen.

-----
