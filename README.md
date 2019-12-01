

![Image logo](https://github.com/mmercedesperea/php-app-comicheroes/blob/master/capturas_proyecto/logo_comic.png)

# APP PHP MERCEDES PEREA ROPERO

## TÍTULO: COMICS HEROES.

## DESCRIPCIÓN

Se trata de una aplicación que nos permite, en primer lugar, buscar cómics/novelas gráficas,
ver información de ellas (como su descripción, número de páginas, editorial, fecha de
lanzamiento, etc.), hacer seguimientos de estos, y realizar diferentes acciones (como votar,
comentar o añadir a seguimiento).
En ella nos encontramos tres tipos de roles: Usuarios no registrados, Usuarios registrados y
Administradores. Estos tendrán una serie de permisos diferentes que les permitirán acceder
a diferentes servicios:

- Usuarios NO registrados: Podrán ver el índice principal de la página, donde podrá
ver los cómics con mejor nota dada por los usuarios, las últimas novedades y los
próximos lanzamientos. También podrán realizar búsquedas de cómics y ver
información sobre ellos.

- Usuarios registrados: Estos podrán ver todo lo que los usuarios NO registrados, y
además podrán realizar votaciones, comentar, añadir a favoritos y hacer diferentes
tipos de seguimiento a los cómics. También tendrá un área privada para ver los
cómics que están siguiendo, los que se ha leído, los añadidos a favoritos y los
cómics que sigue que se publicarán en los próximos días. También podrá ver su
página de perfil y realizar cambios sobre ella, como modificar datos del registro o
añadir una imagen de perfil.

- Administrador: El administrador podrá realizar todo lo que los otros usuarios, y será
el único que pueda acceder al área privada de administración de la página, donde podrá 
hacer seguimiento de los usuarios, los cómics y los seguimientos que se
realizan en la página.

## MANUAL

Al entrar en la aplicación sin estar registrado se vería el index con una serie
de datos sobre los cómics que en ella se almacenan. El usuario podrá ver los
cómics con mejor nota, los últimos lanzamientos y los futuros lanzamientos;
también verá el cómic más nuevo, el más seguido por los usuarios y el cómic
mejor puntuado.

![Image index](https://github.com/mmercedesperea/php-app-comicheroes/blob/master/capturas_proyecto/index.jpg)

Todos los usuarios podrán realizar búsquedas de los cómics que se encuentran en nuestra
BD mediante la siguiente interfaz:

![Image search](https://github.com/mmercedesperea/php-app-comicheroes/blob/master/capturas_proyecto/search.jpg)

Al acceder a información del cómic el usuario NO registrado podrá ver solo la información
relacionada con ese cómic, entre la que se encuentra un link de compra, la descripción,
nombre, etc.

![Image info_no](https://github.com/mmercedesperea/php-app-comicheroes/blob/master/capturas_proyecto/info_no_loguin.jpg)

Si un usuario no logueado intenta entrar en los apartados de LIBRARY o PROFILE se le
informará de que no puede acceder a ese contenido a no ser que se registre o loguee en la
aplicación.

![Image no_loguin](https://github.com/mmercedesperea/php-app-comicheroes/blob/master/capturas_proyecto/no-loguin.jpg)

Todo usuario, registrado o no, también podrá entrar a ver el ABOUT de la página, donde se
encuentra información sobre su creadora; en CONTACT podrá mandar un mail a mi
dirección; y en el apartado de FAQ, que se encuentra en desarrollo.

**ABOUT**

![Image about](https://github.com/mmercedesperea/php-app-comicheroes/blob/master/capturas_proyecto/about.jpg)

**CONTACT**

![Image about](https://github.com/mmercedesperea/php-app-comicheroes/blob/master/capturas_proyecto/contact.jpg)


**FAQ**

![Image faq](https://github.com/mmercedesperea/php-app-comicheroes/blob/master/capturas_proyecto/faq.jpg)

El usuario anónimo podrá registrarse o loguearse si ya se encuentra registrado.

![Image register](https://github.com/mmercedesperea/php-app-comicheroes/blob/master/capturas_proyecto/register.jpg)

![Image login](https://github.com/mmercedesperea/php-app-comicheroes/blob/master/capturas_proyecto/login.jpg)

Una vez logueado podrá acceder a su área personal, donde podrá actualizar sus datos,
añadir una imagen de perfil o eliminar su cuenta. En la barra de navegación podrá ver su
nombre, y el botón de login cambiará a logout.

**PROFILE**

![Image perfil](https://github.com/mmercedesperea/php-app-comicheroes/blob/master/capturas_proyecto/perfil.jpg)

Ahora, al acceder a la información de un cómic, podrá realizar varias acciones que
desbloquearán el poder votar, comentar y añadir a favorito. Si el usuario actualiza su
información sobre el cómic con FOLLOW o READ , podrá realizar las acciones comentadas.

![Image opcion_log_info](https://github.com/mmercedesperea/php-app-comicheroes/blob/master/capturas_proyecto/opciones_log_info.jpg)

Una vez el usuario registrado sigue o añade como leído un cómic, desbloqueará el poder
votar, comentar y añadir a favoritos. Si en algún momento actualiza el estado de cómic a
NOT FOLLOW , se eliminará toda información que haya almacenado sobre él.

![Image opcion_log_info_follow](https://github.com/mmercedesperea/php-app-comicheroes/blob/master/capturas_proyecto/info_log_follow.jpg)

El usuario logueado tendrá desbloqueada la sección LIBRARY : en ella podrá ver un
calendario con las futuras publicaciones, y también podrá tener un control de los cómics que
sigue, que ha añadido a favoritos, que ha leído o los que siguie que aún no han salido.

![Image perfil](https://github.com/mmercedesperea/php-app-comicheroes/blob/master/capturas_proyecto/library.jpg)

Finalmente, si accedemos a la web como un ADMINISTRADOR , se tendrá acceso a todo lo
anterior y a un apartado de administrador, donde podrá ver información relevante sobre la
aplicación.

![Image panel_admin](https://github.com/mmercedesperea/php-app-comicheroes/blob/master/capturas_proyecto/panel_admin.jpg)
