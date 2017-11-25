#GESTOR INCIDENCIAS

## MANUAL Desarrollador

Para trabajar en ***LOCAL***, en primer lugar hay que ejecutar los scripts de inicialización de la base de datos incidencias_FOC.

Consta de 3 tablas

>Departamentos

>Incidencias

>Users

***
CREATE TABLE departamentos ( id_departamento int(5) NOT NULL, nombre_departamento varchar(50) NOT NULL ) DEFAULT CHARSET=utf8;

INSERT INTO departamentos (id_departamento, nombre_departamento) VALUES (0, 'Administración'), (1, 'Contabilidad');

CREATE TABLE incidencias ( id int(5) NOT NULL, id_usuario int(5) NOT NULL, mensaje varchar(1000) NOT NULL, mensaje_admin varchar(1000) NOT NULL, fecha datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, estado int(1) NOT NULL, fecha_estado varchar(50) NOT NULL ) DEFAULT CHARSET=utf8;

INSERT INTO incidencias (id, id_usuario, mensaje, mensaje_admin, fecha, estado, fecha_estado) VALUES (1, 1, 'Esta es la primera incidencia de Pepe', 'Hola PEPE soy Admin,te contesto', '2017-11-09 21:22:52', 1, '12-11-2017 15:59:20'), (4, 2, 'Esta es la primera incidencia de PACO', 'Hola Paco, soy Admin, te contesto', '2017-11-09 21:22:52', 0, '12-11-2017 00:07:59'), (6, 1, 'Esta es la SEGUNDA de PEPE', 'Pepe tienes muchos problemas', '2017-11-09 21:23:30', 0, '12-11-2017 18:12:24');

CREATE TABLE users ( id_usuario int(5) NOT NULL, usuario varchar(20) NOT NULL, password varchar(20) NOT NULL, id_departamento int(5) NOT NULL, rol int(1) NOT NULL ) CHARSET=utf8;

INSERT INTO users (id_usuario, usuario, password, id_departamento, rol) VALUES (0, 'admin', '1234', 0, 0), (1, 'Pepe', '12345', 0, 1), (2, 'Paco', '123456', 0, 1);

ALTER TABLE departamentos ADD PRIMARY KEY (id_departamento);

ALTER TABLE incidencias ADD PRIMARY KEY (id), ADD KEY fk_id_usuario (id_usuario);

ALTER TABLE users ADD PRIMARY KEY (id_usuario), ADD KEY fk_id_departamentos (id_departamento);

ALTER TABLE departamentos MODIFY id_departamento int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE incidencias MODIFY id int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

ALTER TABLE users MODIFY id_usuario int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE incidencias ADD CONSTRAINT fk_id_usuario FOREIGN KEY (id_usuario) REFERENCES users (id_usuario) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE users ADD CONSTRAINT fk_id_departamentos FOREIGN KEY (id_departamento) REFERENCES departamentos (id_departamento);

***

##USO DE LA APLICACIÓN

Una vez creada la base de datos e inicializada con los scripts anteriores, tenemos que incluir nuestra carpeta raíz Incidencias-FOC en la carpeta definida para que el servidor PHP pueda interpretarla.

A tener en cuenta el archivo config.php dentro de la carpeta /lib
><?php
>
>// Librería para la conexión de base de datos
>
>  $user = 'root';
> 
>   $dbpassword = 'root';
> 
>   $db = 'incidencias_FOC';
> 
>   $host = 'localhost';
> 
>   ***$port = 8889;*** 
> 
>?>

"$port tiene por defecto el puerto 8889, se tiene que modificar en función del puerto que se haya habilitado para la base de datos"


Después de definir el puerto para la conexión ya tenemos la aplicación lista para funcionar.







#MANUAL USUARIO

Existe una versión ya desplegada de la aplicación bajo la siguiente dirección

[http://wcriado.com](http://wcriado.com)

## PERFIL ADMIN


Como administrador de la aplicación y por tanto el encargo de resolver las incidencias, hay que loguerase con los siguientes datos:

**Aplicación en local**

>Usuario : admin

>Password : 1234


**Aplicación Desplegada**

>Usuario : admin

>Password : .1234

___
 
Desde el Perfil de Admin se pueden visualizar aquellas incidencias realizadas por los usuarios.

Pulsando sobre la incidencia deseada, se puede observar el mensaje que contiene, pudiendo cambiar el estado de la misma y además dejar un comentario de retroalimentación para el usuario.

Se ha includo como mejora la posibilidad de poder Borrar la incidencia, para así tener una lista algo más limpia en caso de que se quiera disponer solo de aquellas incidencias que no han sido resueltas.

Cuando se pretende guardar el estado de una solicitud, la aplicación comprueba que se haya producido algún cambio en la misma, ya sea que se haya introducido respuesta por parte de admin o se haya cambiado el estado, de lo contrario, mostrará un aviso y no hara la conexión a la base de datos.


![alt text](https://raw.githubusercontent.com/WenceCB/Gestor_Incidencias/master/images/CapturaAdmin.png "Captura Admin")




## PERFIL USUARIO


Como usuario de la aplicación, hay que loguearse para poder acceder al perfil y crear una nueva incidencia.

Como en esta versión no he incluido un formulario para hacer solicitar el alta, en la ventana principal he incluido un link al correo y desde ahí solicitar la creación de un nuevo usuario

![alt text](https://raw.githubusercontent.com/WenceCB/Gestor_Incidencias/master/images/CapturaLogin.png "Captura Login")

____

#Datos para la conexión

**Aplicación en local**

>Usuario : Pepe

>Password : 12345

>Usuario : Paco

>Password : 123456


**Aplicación Desplegada**

>Usuario : Pepe

>Password : .12345

>Usuario : Paco

>Password : .123456

___

Desde el perfil de Usuario, se pueden crear nuevas incidencias, para ello hay que escribir dentro del textarea, de lo contrario el botón `Enviar Incidencia` no se activará.

Una vez el usuario ha creado la Incidencia, puede verla reflejada dentro del listado de "Mis Incidencias".

Al igual que en el perfil de Admin, pulsando en el botón "Ver Incidencia" tendremos acceso al historial de la misma, donde aparecerá la fecha de creación, el estado, el mensaje enviado y si el Administrador ha dejado algún comentario de retroalimentación.


![alt text](https://raw.githubusercontent.com/WenceCB/Gestor_Incidencias/master/images/CapturaIncidencia.png "Captura Incidencia")

___

Por último tanto en el perfil ADMINISTRADOR como en el perfil USUARIO en la parte superior derecha se encuentra el botón de Logout, que cierra la sesión actual y redirige a la ventana de login.


![alt text](https://raw.githubusercontent.com/WenceCB/Gestor_Incidencias/master/images/Logout.png "Captura Logout")




























