# Tarea 1-201403624 - Sofware Avanzado - Primer Semestre 2020 

Lenguajes Utilizados:
  - Javascript
  - php
  - Ajax

# Funciones en JS Y php

  - Listar
  - Insertar un registro 

# Obtener el Token de Acceso

Se obtiene por medio del correo registrado en el dtt y el # de carnet, un token de acceso haciendo una llamada utilizando curl del lenguaje php para utilizar un servicio/una rest api la cual nos retorna dicho token.
```sh
$curl = curl_init("https://api.softwareavanzado.world/index.php?option=token&api=oauth2");// URL DONDE SE ENCUENTRA EL SERVICIO
    curl_setopt($curl, CURLOPT_POST, true);// indico que es metodo post
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);// esta linea y la siguien apago cors
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_POSTFIELDS, array(
        'grant_type' => 'client_credentials',
        'client_id' => $email, 
        'client_secret' => $password
    ));// Envio de parametros para la autenticacion como el id y la clave
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $myAuth = curl_exec($curl);// obteniendo valores 
```
# LLAMADA DE GET Y POST A EL REST API 
### GET
```sh
  // LISTAR TODOS LOS REGISTROS DISPONIBLES CON EL METODO GET EL ACCESS TOKEN SE LO CONCATENO AL FINAL
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, 'https://api.softwareavanzado.world/index.php?webserviceClient=administrator&webserviceVersion=1.0.0&option=contact&api=hal&list[limit]=0&access_token='.$accessToken->access_token);// URL DONDE SE ENCUENTRA EL SERVICIO
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);// DESHABILITAR EL CORS

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $data = curl_exec($ch); // Ejecutar llamada y guardado de respuesta en variable 
    curl_close($ch);// Cerrar conexion
    // DATOS LISTADOS EXITOSAMENTE 
```

### POST

```sh
// ALMACENADO UN REGISTRO POR MEDIO DE POST EL ACCESS TOKEN SE LO CONCATENO AL FINAL
    $ch_post = curl_init();// iniciando curl
    curl_setopt($ch_post, CURLOPT_URL, 'https://api.softwareavanzado.world/index.php?webserviceClient=administrator&webserviceVersion=1.0.0&option=contact&api=hal&access_token='.$accessToken->access_token); // URL DONDE SE ENCUENTRA EL SERVICIO
    curl_setopt($ch_post , CURLOPT_POST, true);
    curl_setopt($ch_post , CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch_post , CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch_post , CURLOPT_POSTFIELDS, array(
        'name' => 'fernando_201403624_no10',
        'catid' => 29
    ));// envio de parametros para creacion de registro
    $data = curl_exec($ch_post); // Ejecutar llamada y guardado de respuesta en variable 
    curl_close($ch_post);// cerrando conexion
```

## SELECTOR DE FUNCION

Para simular en php lo que vendria siendo un menu se puede utilizar un parametro del formulario y almacenar que funcion es la que estamos llamando desde el navegador 
```sh
// POR MEDIO DEL PARAMETRO 'FUNC' EN EL FORMULARIO SE INDICA CUAL FUNCION EJECUTAR 
$func = $_POST['func']; //CAPTURO LA FUNCION CON A LA CUAL TENGO QUE LLAMAR
switch ($func) {
    case 'listar':
        listar();
        break;
    case 'insertar':
        insertar();
        break;    
    default:
        //function not found, ESTO ES UN ERROR
        break;
}
```
## USO DE AJAX
```sh
// CREACION DE VARIABLE OBJETO PARA ENVIAR COMO FORMULARIO
		var param = {
			func: 'insertar',
			email: document.getElementById("email").value,
			password: document.getElementById("password").value
		};

		$(document).ready(function () {
			$.ajax({
				data: param,//OBJETO A ENVIAR COMO FORMULARIO
				url: "funciones.php",//RUTA DEL ARCHIVO PHP CON FUNCIONES
				method: "post",// TIPO DE LLAMADA
				success: function (data) {
					document.write(data);// APPEND DE PRINTS EN FUNCION PHP
					/*La variable data contiene la respuesta del script PHP*/
				}
			});
		});
```

## RUN APP

Para correr la aplicacion solo es necesario descargar el repositorio y ubicarlo en la capeta /www de apache y abrir el navegador de preferencia en https://localhost:80/Tarea1/Index.html

