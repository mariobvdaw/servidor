<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    $_SESSION['error'] = "Inicie sesión para acceder al almacen";
    header('Location: ./login.php');
    exit;
} elseif ($_SESSION['usuario']["perfil"] == "cliente") {
    $_SESSION['error'] = "Los clientes no pueden acceder al almacen";
    header('Location: ./home.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/header.css">
    <title>Almacen</title>
</head>

<body>
    <?php
    include("./fragmentos/header.php");
    ?>
    <h1>Almacen</h1>
    
</body>

</html>