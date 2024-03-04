# Prueba Técnica para Mega Red

A continuación se describen los pasos para tener el presente proyecto corriendo en tu computador.
Se tendrán dos formas de desplegar la aplicación. El método 1 es más rápido

# 1. Método con Xampp

## Requisitos Instalación

| Nombre   |
|----------|
| Xampp    |

## Pasos de instalación

## Clonar proyecto
1. Clonar el siguiente proyecto que se encuentra en github ->  __https://github.com/edinson85/ventasMvc.git__ 
2. Mover el proyecto a la carpeta htdocs de Xampp

## Base de datos
3. Crear una base de datos llamada __megared__ por medio de phpmyadmin
4. Importar la base de datos que se encuentra en __database/megared.sql__
5. El usuario y contraseña de la base de datos se debe de modificar en el fichero __app\config\config.php__. Las variables a modificar serían __DB_USER__ y __DB_PASS__
5. Con lo anterior el proyecto debería de correr sin problemas en la url __http://localhost/ventasMvc__


# 2. Método con Docker

## Requisitos Instalación

| Nombre   |
|----------|
| Docker   |

## Pasos de instalación

## Clonar proyecto
1. Clonar el siguiente proyecto que se encuentra en github ->  __https://github.com/edinson85/ventasMvc.git__ y verificar que estamos ubicados en la rama __main__
2. Mover el proyecto en una carpeta que no tenga caracteres especiales en su ruta de acceso para evitar inconvenientes al momento de levantar el proyecto con docker

## Configurar ficheros .env
3. Dentro del proyecto clonado se debe de duplicar el fichero con ruta relativa -> __docker/.env.dist__
4. Una vez clonado el fichero __.env.dist__ se debe de cambiar el nombre a __.env__
5. En el fichero __.env__ se debe colocar la ruta del proyecto clonado en la variable __PATH_PROJECT__. Tener en cuenta que en Windows se debe de colocar doble \\ como aparece en el ejemplo
6. La configuración actual del fichero __.env.dist__ permite que el proyecto corra en el __puerto local 92__ y que __phpmyadmin__ este en el puerto __8003__. Si se desea cambiar esta configuración se debe de modificar las variables __PORT_HTTP_HOST__ para que el puerto de la aplicación no sea 92 y __PORT_PHP_MY_ADMIN__ para que el puerto de phpmyadmin no sea 8003
7. Si se modifica el puerto (92) donde corra la aplicación en local se debe modificar el puerto en el fichero __.env.dist__ de la variable __URLROOT__ al puerto seleccionado
8. En la __raíz del proyecto se encuentra el fichero .env.dist__ que contiene algunas variables de configuración como credenciales de acceso a la base de datos del proyecto entre otros. Se debe de clonar este fichero y cambiarle el nombre a __.env__

## Levantar contenedores Docker
9. Desde una terminal se debe de dirigir a la carpeta docker del proyecto clonado y ejecutar el comando __docker-compose --compatibility build__ para que se descarguen las imagenes de los contenedores
10. Ejecutar el comando  __docker-compose up -d__ para levantar los contenedores. Con lo anterior se deben de levantar los contenedores  con los siguientes nombres
| Nombre                 | Descripcion
|------------------------|-------------------------------------------------------------------|
| mvc_amazon_linux       | Donde se aloja el proyecto                                        |
| phpmyadmin_project_mvc | Permite gestionar de forma gráfica la base de datos del proyecto  |
| database_mvc           | Contiene el motor de base de datos del proyecto                   |

11. Una vez levantados los contenedores anteriores se debe de ingresar al contenedor __mvc_amazon_linux__ y en la ruta __/usr/share/nginx/html__ ejecutar el comando __composer install__ para instalar dependencias

## Base de datos
12. Crear una base de datos llamada __megared__ por medio de phpmyadmin
13. Importar la base de datos que se encuentra en __database/megared.sql__

14. Con lo anterior el proyecto debería de correr sin problemas en la url __http://localhost:92/__ 
