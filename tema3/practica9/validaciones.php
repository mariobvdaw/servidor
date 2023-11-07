<?php
    function enviado(){
        if (isset($_REQUEST['enviar'])) {
            return true;
        }
        return false;
    }
    
    function textoVacio($name){
        if (empty($name)) {
            return true;
        }
        return false;
    }

    function recuerda($name){
        if (enviado() && !empty($_REQUEST[$name])) {
            echo $_REQUEST[$name];
        }
    }
    function mayorEdad($stringFecha){
        $arrayFecha = explode("/",$stringFecha);
        $fecha1 = new DateTime($arrayFecha[2]."-".$arrayFecha[1]."-".$arrayFecha[0]);
        $fecha2 = new DateTime();  
        $edad = ($fecha1->diff($fecha2))->y;
        return $edad>=18;
    }

    function validaFormulario(&$errores){
        $nombre = $_REQUEST['nombre'];
        $apellidos = $_REQUEST['apellidos'];
        $contrasenia = $_REQUEST['contrasenia'];
        $contrasenia2 = $_REQUEST['contrasenia2'];
        $fecha = $_REQUEST['fecha'];
        $dni = $_REQUEST['dni'];
        $correo = $_REQUEST['correo'];
        $patron_nombre = "/^[A-Za-z]{3,}$/";
        $patron_apellidos = "/^[A-Za-z]{3,}\s[A-Za-z]{3,}$/";
        $patron_fecha = "/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/";
        $patron_dni = "/^[0-9]{8}[A-Z]{1}$/";
        $patron_correo = "/^[A-Za-z0-9]{1,}@[A-Za-z0-9]{1,}[.][A-Za-z0-9]{2,}$/";

        $vacio="Campo vacio";
        $incorrecto="Formato incorrecto";
        if (textoVacio($nombre)) {
            $errores['nombre'] = $vacio;
        } elseif (!preg_match($patron_nombre, $nombre)) {
            $errores['nombre'] = $incorrecto;
        }
            
        if (textoVacio($_REQUEST['apellidos'])) {
            $errores['apellidos'] = $vacio;
        } elseif (!preg_match($patron_apellidos, $_REQUEST['apellidos'])) {
                $errores['apellidos'] = $incorrecto;
        }
            
        if (textoVacio($contrasenia)) {
            $errores['contrasenia'] = $vacio;
        } elseif(!preg_match("/[A-Z]/", $contrasenia) || !preg_match("/[a-z]/", $contrasenia) || !preg_match("/\d/", $contrasenia)){
            $errores["contrasenia"] = $incorrecto;
        }
        if (textoVacio($contrasenia2)) {
            $errores['contrasenia2'] = $vacio;
        } elseif(!textoVacio($contrasenia) && $contrasenia2 != $contrasenia){
            $errores["contrasenia2"] = "Las contraseñas no coinciden";
        }
        if (textoVacio($fecha)) {
            $errores['fecha'] = $vacio;
        } elseif(!preg_match($patron_fecha, $fecha)){
            $errores['fecha'] = $incorrecto;
        } elseif(!mayorEdad($fecha)){
            $errores['fecha'] = "Menor de edad";
        }
        if (textoVacio($dni)) {
            $errores['dni'] = $vacio;
        } elseif(!preg_match($patron_dni, $dni)){
            $errores['dni'] = $incorrecto;
        } 
        if (textoVacio($correo)) {
            $errores['correo'] = $vacio;
        } elseif(!preg_match($patron_correo, $correo)){
            $errores["correo"] = $incorrecto;
        }

        if (count($errores)==0) {
            return true;
        }
        return false;
    }
    function errores($errores, $name){
        if (isset($errores[$name])) {
            echo "<span class='error'>" . $errores[$name] . "</span>";
        }
    }



?>