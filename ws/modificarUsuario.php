<?php
session_start();
require_once "./models/User.php"; 
require_once "./interfaces/IToJson.php"; 
require_once "./conexion.php"; 

header('Content-Type: application/json');

// Iniciar sesión para asegurar acceso a la sesión en caso de que sea necesario en el futuro


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
  var_dump($formData);

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

    // Llamar a la función de borrado
    //if($id){
      $result = modificarAlumnoPorID($conexion,$user,$id);
    //}else{
      //$result = consultarAlumno($conexion, $name, $surname,$password);
    //}
   
    echo json_encode($result);

    // Limpiar los datos de la sesión después de usarlos
      unset($_SESSION['form_data']);
} else {
    echo json_encode(["error" => "Por favor, proporciona el nombre, apellidos y password para la consulta."]);
}

/**
 * Función para consultar el alumno en la base de datos usando consultas preparadas
 */

function modificarAlumnoPorID($conexion,$user,$id) {
  try {
      // Preparar la consulta
      $sql = "UPDATE alumno set nombre=:nombre, apellidos=:apellidos,password=:password,telefono=:telefono,email=:email,sexo=:gender where id=:id";
      $stmt = $conexion->prepare($sql);
      var_dump($sql);
             // Almacenar valores en variables
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
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);

      // Ejecutar la consulta
      $stmt->execute();
      
      // Obtener todos los resultados como un array asociativo
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      var_dump($result);

      // Comprobar si se afectó alguna fila
      if ($stmt->rowCount()== 1) {
        return [
            'success' => true,
            'message' => "Usuario con ID ".$id." modificado con exito",
        ];
    } else {
        return [
            'success' => false,
            'message' => "Usuario con ID ".$id." no encontrado",
        ];
    }
      
  } catch (Exception $e) {
      http_response_code(500);
      return ['error' => $e->getMessage()];
  } 
}
?>
