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
  $id = $formData['id'] ?? null;

  try {
    $conexion = new Conexion();
  } catch (Exception $e) {
    echo json_encode(['error' => "Error: " . $e->getMessage()]);
    exit();
  }

  // Llamar a la función de borrado
  if ($id) {
    $result = eliminarAlumnoPorID($conexion, $id);
    echo json_encode($result);
  } else {
    echo json_encode(["error" => "Por favor, proporciona el ID para el borrado"]);
    // Limpiar los datos de la sesión después de usarlos
    unset($_SESSION['form_data']);
    exit();
  }
}

/**
 * Función para eliminar el alumno en la base de datos usando consultas preparadas y buscando por ID
 */

function eliminarAlumnoPorID($conexion, $id)
{
  try {
    $sql = "delete FROM alumno WHERE id = :id";
    $stmt = $conexion->prepare($sql);

    $stmt->bindParam(':id', $id, PDO::PARAM_STR);

    $stmt->execute();

    // Obtener todos los resultados como un array asociativo
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Comprobar si se afectó alguna fila
    if ($stmt->rowCount() == 1) {
      return [
        'success' => true,
        'message' => "Usuario con ID " . $id . " eliminado con exito",
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