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
  $id = $formData['id'] ?? null;
  var_dump($formData);

    try {
        // Crear la instancia de conexión
        $conexion = new Conexion();
    } catch (Exception $e) {
        echo json_encode(['error' => "Error: " . $e->getMessage()]);
        exit();
    }

    // Llamar a la función de borrado
    //if($id){
      $result = eliminarAlumnoPorID($conexion, $id);
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

function eliminarAlumnoPorID($conexion, $id) {
  try {
      // Preparar la consulta
      $sql = "delete FROM alumno WHERE id = :id";
      $stmt = $conexion->prepare($sql);

      // Asociar los parámetros
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
            'message' => "Usuario con ID ".$id." eliminado con exito",
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
