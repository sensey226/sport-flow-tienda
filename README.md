# Sport Flow — Tienda Online Deportiva

Proyecto de tienda virtual desarrollado con **WordPress** y **WooCommerce** en entorno local (**Laragon**), orientado a la comercialización de artículos y equipamiento deportivo.

## Contenido del repositorio

- `database/sport_flow.sql`: Respaldo de la base de datos de la tienda (tablas y registros exportados desde MySQL).
- `wp-content/themes/`: Temas instalados y configurados para el diseño de la tienda.
- `wp-content/languages/`: Archivos de traducción del sitio y complementos.
- `wp-content/uploads/`: Imágenes de productos, medios y recursos gráficos cargados en WordPress.

> Nota: Por motivos de ligereza y buenas prácticas en Git, el núcleo de WordPress y las carpetas de plugins/caché se excluyeron mediante `.gitignore`, por lo que se recomienda instalar WordPress y los plugins requeridos (como WooCommerce) antes de vincular este respaldo.

## Guía rápida de instalación local (Laragon)

1. Instala **Laragon** (Apache y MySQL activos) y descarga una copia limpia de **WordPress** dentro de `C:\laragon\www\sport-flow` (o el nombre de carpeta que prefieras).
2. Abre el gestor de base de datos de Laragon (**HeidiSQL** o **phpMyAdmin**), crea una base de datos nueva (por ejemplo, `sport_flow_db`) e importa el archivo `database/sport_flow.sql`.
3. Copia el contenido de `wp-content/` de este repositorio hacia la carpeta `wp-content/` de tu instalación de WordPress, reemplazando o fusionando según corresponda.
4. Configura `wp-config.php` con el nombre de la base de datos creada y los datos de conexión de MySQL.
5. Inicia los servicios en Laragon, accede al panel de administración de WordPress (`/wp-admin`), activa el tema y los plugins correspondientes (WooCommerce y complementos utilizados).
6. Si la URL local cambia respecto al entorno de origen, actualiza la URL del sitio en **Ajustes > Generales** o mediante una herramienta de reemplazo de URLs en la base de datos.
