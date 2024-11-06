<?php
// Iniciar sesión para asegurar acceso a la sesión en caso de que sea necesario en el futuro
session_start();
require_once "./models/User.php";
require_once "./interfaces/IToJson.php";
require_once "./conexion.php";

header('Content-Type: application/json');

// Verificar que los parámetros POST están definidos
if (isset($_SESSION['form_data'])) {
  $formData = $_SESSION['form_data'];
  $name = $formData['name'] ?? null;
  $surname = $formData['surname'] ?? null;
  $password = $formData['pass'] ?? null;
  $phone = $formData['phone'] ?? null;
  $email = $formData['email'] ?? null;
  $gender = $formData['gender'] ?? null;
  $id = $formData['id'] ?? null;

  try {
    // Crear la instancia de conexión
    $conexion = new Conexion();
  } catch (Exception $e) {
    echo json_encode(['error' => "Error: " . $e->getMessage()]);
    exit();
  }

  // Crear objeto User con los datos
  $user = new User();
  $user->setName($name);
  $user->setSurname($surname);
  $user->setPhone($phone);
  $user->setPassword($password);
  $user->setEmail($email);
  $user->setGender($gender);

  // Llamar a la función de modificacion
  if ($id) {
    //Se comprueba que se haya informado algun campo 
    // Verificar que name, surname y password no sean nulos ni estén vacíos
    if (
      empty(trim($name)) && empty(trim($surname)) && empty(trim($password)) && empty(trim($email))
      && empty(trim($phone)) && empty(trim($gender))
    ) {
      echo json_encode(['error' => 'Obligatorio informar algun(os) campo(s) a editar']);
      exit();
    }
    $result = modificarAlumnoPorID($conexion, $user, $id);
    echo json_encode($result);
  } else {
    echo json_encode(["error" => "Por favor, proporciona el ID para la modiificacion"]);
    // Limpiar los datos de la sesión después de usarlos
    unset($_SESSION['form_data']);
    exit();
  }
}

/**
 * Función para modificar el alumno en la base de datos usando consultas preparadas y buscando por ID
 */

function modificarAlumnoPorID($conexion, $user, $id)
{
  try {

    // Almacenar valores en variables
    $nombre = $user->getName();
    $apellidos = $user->getSurname();
    $telefono = $user->getPhone();
    $password = $user->getPassword();
    $email = $user->getEmail();
    $gender = $user->getGender();

    //Comienzo del comando SQL
    $sql = "UPDATE alumno SET ";
    $updates = [];
    $params = [];

    // Construir la consulta solo con los campos que tienen valores
    if ($nombre) {
      $updates[] = "nombre = :nombre";
      $params[':nombre'] = $nombre;
    }
    if ($apellidos) {
      $updates[] = "apellidos = :apellidos";
      $params[':apellidos'] = $apellidos;
    }
    if ($telefono) {
      $updates[] = "telefono = :telefono";
      $params[':telefono'] = $telefono;
    }
    if ($password) {
      $updates[] = "password = :password";
      $params[':password'] = $password;
    }
    if ($email) {
      $updates[] = "email = :email";
      $params[':email'] = $email;
    }
    if ($gender) {
      $updates[] = "sexo = :gender";
      $params[':gender'] = $gender;
    }

    //Concatenar las actualizaciones con , y el WHERE con el id
    $sql .= implode(", ", $updates) . " WHERE id = :id";
    $params[':id'] = $id;

    //Preparar la consulta
    $stmt = $conexion->prepare($sql);

    //Asociar los parámetros dinámicamente
    foreach ($params as $param => $value) {
      $stmt->bindValue($param, $value);
    }

    $stmt->execute();

    // Comprobar si se afectó alguna fila
    if ($stmt->rowCount() == 1) {
      return [
        'success' => true,
        'message' => "Usuario con ID " . $id . " modificado con exito",
      ];
    } else {
      return [
        'success' => false,
        'message' => "Usuario con ID " . $id . " no encontrado",
      ];
    }

  } catch (Exception $e) {
    http_response_code(500);
    return ['error' => $e->getMessage()];
  }
}
?>