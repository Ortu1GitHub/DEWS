<?php
// Iniciar sesión para asegurar acceso a la sesión en caso de que sea necesario en el futuro
session_start();

require_once "./models/User.php";
require_once "./interfaces/IToJson.php";
require_once "./conexion.php";

// Verificar que haya datos en la sesión
if (isset($_SESSION['form_data'])) {
    $formData = $_SESSION['form_data'];
    $name = $formData['name'] ?? null;
    $surname = $formData['surname'] ?? null;
    $phone = $formData['phone'] ?? null;
    $password = $formData['pass'] ?? null;
    $email = $formData['email'] ?? null;
    $gender = $formData['gender'] ?? null;

    // Verificar que name, surname y password no sean nulos ni estén vacíos
    if (empty(trim($name)) || empty(trim($surname)) || empty(trim($password))) {
        echo json_encode(['error' => 'Obligatorio informar los campos nombre, apellido y contrasenya']);
        exit();
    }

    try {
        $conexion = new Conexion();
    } catch (Exception $e) {
        echo json_encode(['error' => "Error: " . $e->getMessage()]);
        exit();
    }

    $user = new User();
    $user->setName($name);
    $user->setSurname($surname);
    $user->setPhone($phone);
    $user->setPassword($password);
    $user->setEmail($email);
    $user->setGender($gender);


    // Insertar en la base de datos
    $result = insertarAlumno($conexion, $user);
    echo json_encode($result);

    // Limpiar los datos de la sesión después de usarlos
    unset($_SESSION['form_data']);
} else {
    echo json_encode(['error' => 'No se han informados datos para dar de alta el alumno']);
    exit();
}

function insertarAlumno($conexion, $user)
{
    try {
        $sql = "INSERT INTO alumno (nombre, apellidos, telefono, password,email,sexo) VALUES (:nombre, :apellidos, :telefono, :password,:email,:gender)";
        $stmt = $conexion->prepare($sql);

        $nombre = $user->getName();
        $apellidos = $user->getSurname();
        $telefono = $user->getPhone();
        $password = $user->getPassword();
        $email = $user->getEmail();
        $gender = $user->getGender();

        // Asociar los parámetros
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);


        $stmt->execute();

        return [
            'success' => true,
            'message' => "Usuario creado con exito",
            'data' => [
                'nombre' => $nombre,
                'apellidos' => $apellidos
            ]
        ];
    } catch (Exception $e) {
        http_response_code(500);
        return ['error' => $e->getMessage()];
    }
}
?>