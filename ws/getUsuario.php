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

  //Al consultar o bien nos pasan el ID o listamos todos los alumnos
  if ($id) {
    $result = consultarAlumnoPorID($conexion, $id);
  } else {
    $result = consultarAlumno($conexion);
  }

  echo json_encode($result);

  // Limpiar los datos de la sesión después de usarlos
  unset($_SESSION['form_data']);
}

/**
 * Funciones para consultar el alumno en la base de datos usando consultas preparadas bien por ID o listar todos los alumnos
 */
function consultarAlumno($conexion)
{
  try {
    // Preparar la consulta
    $sql = "SELECT * FROM alumno";
    $stmt = $conexion->prepare($sql);

    $stmt->execute();

    // Obtener todos los resultados como un array asociativo
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
      // Extraer solo los campos 'ID','nombre' y 'apellidos' de cada registro
      $filteredResult = array_map(function ($row) {
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

function consultarAlumnoPorID($conexion, $id)
{
  try {

    $sql = "SELECT * FROM alumno WHERE id = :id";
    $stmt = $conexion->prepare($sql);

    // Asociar los parámetros
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
      $filteredResult = array_map(function ($row) {
        return [
          //Se muestra el id para distinguir resultados multiples
          'id' => $row['id'],
          'nombre' => $row['nombre'],
          'apellidos' => $row['apellidos']
        ];
      }, $result);

      return [
        'success' => true,
        'message' => "Usuario con ID " . $id . " obtenido con exito",
        'data' => $filteredResult
      ];
    } else {
      return ["message" => "No se encontraron resultados con el ID " . $id];
    }
  } catch (Exception $e) {
    http_response_code(500);
    return ['error' => $e->getMessage()];
  }
}
?>