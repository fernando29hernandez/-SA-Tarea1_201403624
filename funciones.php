<?php

function listar(){
    echo 'llegue aqui';
    $email = isset($_POST['email'])?$_POST['email'] : "err";
    $password = isset($_POST['password'])?$_POST['password'] : "err";
    echo "Estos son las credenciales de acceso: correo= ".$email." Contrasena= ".$password."<br>";
    //OBTENIENDO EL TOKEN DE ACCESO
    $curl = curl_init("https://api.softwareavanzado.world/index.php?option=token&api=oauth2");
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
    $errores = curl_error($curl); // obteniendo posibles errores
    $accessToken = json_decode($myAuth); //extrayendo access token
    print_r($accessToken->access_token);
    //print_r("<br>ERROR<br>".$errores."<br>");
    // TOKEN OBTENIDO Y ALMACENADO EN $ACCESS_TOKEN

    // LISTAR TODOS LOS REGISTROS DISPONIBLES CON EL METODO GET EL ACCESS TOKEN SE LO CONCATENO AL FINAL
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, 'https://api.softwareavanzado.world/index.php?webserviceClient=administrator&webserviceVersion=1.0.0&option=contact&api=hal&list[limit]=0&access_token='.$accessToken->access_token);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $data = curl_exec($ch); 
    curl_close($ch);
    // DATOS LISTADOS EXITOSAMENTE 
    echo $data;
    echo "Adios";
    return $data;
    
}


function insertar(){
    $email = isset($_POST['email'])?$_POST['email'] : "err";
    $password = isset($_POST['password'])?$_POST['password'] : "err";
    echo "Estos son las credenciales de acceso: correo= ".$email." Contrasena= ".$password."<br>";
    //OBTENIENDO EL TOKEN DE ACCESO
    $curl = curl_init("https://api.softwareavanzado.world/index.php?option=token&api=oauth2");
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
    $errores = curl_error($curl); // obteniendo posibles errores
    $accessToken = json_decode($myAuth); //extrayendo access token
    print_r($accessToken->access_token);
    //print_r("<br>ERROR<br>".$errores."<br>");
    // TOKEN OBTENIDO Y ALMACENADO EN $ACCESS_TOKEN

    
    // ALMACENADO UN REGISTRO POR MEDIO DE POST EL ACCESS TOKEN SE LO CONCATENO AL FINAL
    $ch_post = curl_init();// iniciando curl
    curl_setopt($ch_post, CURLOPT_URL, 'https://api.softwareavanzado.world/index.php?webserviceClient=administrator&webserviceVersion=1.0.0&option=contact&api=hal&access_token='.$accessToken->access_token); 
    curl_setopt($ch_post , CURLOPT_POST, true);
    curl_setopt($ch_post , CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch_post , CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch_post , CURLOPT_POSTFIELDS, array(
        'name' => 'fernando_201403624_no10',
        'catid' => 29
    ));// envio de parametros para creacion de registro
    $data = curl_exec($ch_post);
    curl_close($ch_post);// cerrando conexion
    echo $data;
    return $data; 
    // REGISTRO INSERTADO CODIGO DE RETORNO 201
}


/**
 * SELECTOR DE FUNCION
 */
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
?>

