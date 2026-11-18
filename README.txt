CASO DE ESTUDIO #1 - AMBIENTE WEB CLIENTE SERVIDOR

REQUISITOS
- XAMPP con Apache y MariaDB activos.
- PHP con PDO MySQL habilitado.
- Base de datos casoestudio creada con el script entregado por el profesor.

INSTALACION
1. Copie la carpeta CasoEstudio1 dentro de C:\xampp\htdocs\
2. Abra phpMyAdmin: http://localhost/phpmyadmin
3. Seleccione/importa el script de base de datos proporcionado por el curso.
   Deben existir las tablas ejercicios y tiposejercicio.
4. Abra la pestaña SQL e importe/ejecute:
   CasoEstudio1/sql/procedimientos_almacenados.sql
5. Revise config/database.php. Por defecto usa host localhost, usuario root
   y contraseña vacía, que es la configuración habitual de XAMPP.
6. Inicie Apache y MySQL/MariaDB desde el panel de XAMPP.
7. Abra:
   http://localhost/CasoEstudio1/public/

FUNCIONAMIENTO
- Inicio: muestra bienvenida y menú.
- Registrar solicitud: identificación, monto y tipo de ejercicio.
- La fecha se genera con NOW() en el procedimiento almacenado; no se pide
  al usuario ni se muestra en el formulario.
- El procedimiento valida que el tipo exista y que la identificación no
  tenga ya dos solicitudes.
- Consulta: muestra identificación, fecha, monto y descripción del tipo.

ARQUITECTURA MVC
- app/models: acceso a datos y llamadas a procedimientos almacenados.
- app/views: pantallas HTML.
- app/controllers: validaciones y flujo de la aplicación.
- config: conexión PDO.
- public: punto de entrada y recursos CSS/JavaScript.
- sql: procedimientos almacenados.

NOTAS
- No se cambia la estructura de las tablas originales.
- Bootstrap se carga desde CDN, por lo que se requiere conexión a Internet
  para obtener sus estilos y componentes.
- Si el usuario de MariaDB tiene contraseña, actualice config/database.php.
- Antes de entregar, pruebe el registro válido, los campos vacíos, el monto
  inválido, un tipo válido y el límite de dos solicitudes por identificación.
