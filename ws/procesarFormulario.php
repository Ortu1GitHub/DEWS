<?php
//Se inicia sesion
session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;
    $name = $_POST['name'] ?? null;
    $surname = $_POST['surname'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $password = $_POST['pass'] ?? null;
    $email = $_POST['email'] ?? null;
    $gender = $_POST['gender'] ?? null;
    $id = $_POST['id'] ?? null;

    // Guarda los datos del formulario en $_SESSION
    $_SESSION['form_data'] = $_POST;

    if ($action === 'Insertar') {
        header('Location: ./crearUsuario2.php');
        exit();
    } elseif ($action === 'Consultar') {
        header('Location: ./getUsuario.php');
        exit();
    } elseif ($action === 'Modificar') {
        header('Location: ./modificarUsuario.php');
        exit();
    } elseif ($action === 'Eliminar') {
        header('Location: ./deleteUsuario.php');
        exit();
    } else {
        echo json_encode(["error" => "Acción no reconocida."]);
    }
}
?>
