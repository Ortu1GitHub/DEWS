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
  $id = $formData['id'] ?? null;

    try {
        // Crear la instancia de conexión
        $conexion = new Conexion();
    } catch (Exception $e) {
        echo json_encode(['error' => "Error: " . $e->getMessage()]);
        exit();
    }

    // Llamar a la función de consulta que corresponda si ID viene informado o no
    if($id){
      $result = consultarAlumnoPorID($conexion, $id);
    }else{
      $result = consultarAlumno($conexion, $name, $surname,$password);
    }
   
    echo json_encode($result);

    // Limpiar los datos de la sesión después de usarlos
      unset($_SESSION['form_data']);
} else {
    echo json_encode(["error" => "Por favor, proporciona el nombre, apellidos y password para la consulta."]);
}

/**
 * Funciones para consultar el alumno en la base de datos usando consultas preparadas bien por ID o bien por los campos nombre, apellidos y contrasenya
 */
function consultarAlumno($conexion, $name, $surname, $pass) {
    try {
        // Preparar la consulta
        $sql = "SELECT * FROM alumno WHERE nombre = :nombre AND apellidos = :apellidos AND password = :password";
        $stmt = $conexion->prepare($sql);

        // Asociar los parámetros
        $stmt->bindParam(':nombre', $name, PDO::PARAM_STR);
        $stmt->bindParam(':apellidos', $surname, PDO::PARAM_STR);
        $stmt->bindParam(':password', $pass, PDO::PARAM_STR);

        // Ejecutar la consulta
        $stmt->execute();
        
        // Obtener todos los resultados como un array asociativo
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
          // Devolver array de resultados
         // Extraer solo los campos 'ID','nombre' y 'apellidos' de cada registro
         $filteredResult = array_map(function($row) {
          return [
              //Se muestra el id para distinguir resultados multiples
              'id' => $row['id'],
              'nombre' => $row['nombre'],
              'apellidos' => $row['apellidos']
          ];
          }, $result);

        return [
          'success' => true,
          'message' => "Usuario(s) obtenido(s) con exito",
          'data' => $filteredResult
        ];
        } else {
            return ["message" => "No se encontraron resultados"];
        }
    } catch (Exception $e) {
        http_response_code(500);
        return ['error' => $e->getMessage()];
    } 
}

function consultarAlumnoPorID($conexion, $id) {
  try {
      // Preparar la consulta
      $sql = "SELECT * FROM alumno WHERE id = :id";
      $stmt = $conexion->prepare($sql);

      // Asociar los parámetros
      $stmt->bindParam(':id', $id, PDO::PARAM_STR);

      // Ejecutar la consulta
      $stmt->execute();
      
      // Obtener todos los resultados como un array asociativo
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (count($result) > 0) {
       // Extraer solo los campos 'nombre' y 'apellidos' de cada registro
       $filteredResult = array_map(function($row) {
        return [
            //Se muestra el id para distinguir resultados multiples
            'id' => $row['id'],
            'nombre' => $row['nombre'],
            'apellidos' => $row['apellidos']
        ];
        }, $result);

      return [
        'success' => true,
        'message' => "Usuario con ID ".$id." obtenido con exito",
        'data' => $filteredResult
      ];
      } else {
          return ["message" => "No se encontraron resultados con el ID ".$id];
      }
  } catch (Exception $e) {
      http_response_code(500);
      return ['error' => $e->getMessage()];
  } 
}
?>
