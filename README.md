# Car Rent Services

Este proyecto es una aplicación web para gestionar el alquiler de coches.

## Requisitos

- PHP >= 5.6.0
- Composer
- Node.js y npm
- MariaDB/MySQL
- Apache (recomendado: XAMPP)
- Git

## Instalación

1. **Clona el repositorio**
   ```sh
   git clone https://github.com/tu-usuario.git
   cd car-rent-services
   ```

2. **Copia el archivo `.env`**
   - Coloca el archivo `.env` con tus datos privados en la raíz del proyecto.

3. **Instala las dependencias de PHP**
   ```sh
   composer install
   ```

4. **Instala las dependencias de Node.js (TailwindCSS)**
   ```sh
   npm install
   ```

5. **Configura la base de datos**
   - Crea una base de datos en MariaDB/MySQL.
   - Importa el esquema y los datos iniciales si están disponibles.

6. **Configura el servidor web**
   - Para desarrollo utilizamos el comando
      ```
      docker compose up -d
      ```
      Esto nos desplegará en el puerto del fichero `docker-compose.yml` nuestro proyecto listo para desarrollo.


7. **Accede a la aplicación**
   - Abre tu navegador y entra a `http://localhost:8080`

8. **Arranca Tailwind**
   - Abre la terminal y ejecuta:
     ```sh
     npx @tailwindcss/cli -i ./src/input.css -o ./src/output.css --watch
     ```

9. **Despliegue a producción**
   - Para desplegar en producción usar el Dockerfile. Ahora mismo lo desplegamos en render. Se despliega mediante github.
   - Pasos para despliegue:
   1. Compilar tailwind 
   ```
   npx @tailwindcss/cli -i ./src/input.css -o ./src/output.css
   ```
   2. Hacer commit en la rama configurada (main)

## Tecnologías usadas

- PHP
- HTML, CSS, JavaScript
- TailwindCSS
- Stripe (pagos)
- Composer
- Git
- MariaDB
- Apache
- Docker

## Extras

Consulta la documentación adicional en la carpeta [`views/manuals`](views/manuals/).
