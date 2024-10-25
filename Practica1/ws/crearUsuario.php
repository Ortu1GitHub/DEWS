<?php
    require_once"./models/User.php"; 
    require_once"./interfaces/IToJson.php"; 

    // Verificamos si se recibieron todos los datos requeridos mediante POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recogemos los datos enviados desde formulario.html
    $name = $_POST['name'] ?? null;
    $surname = $_POST['surname'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $password = $_POST['password'] ?? null;
    //$gender = $_POST['gender'] ?? null;

    // Creamos una instancia de User y asignamos los datos recibidos
    $user = new User();
    $user->setName($name);
    $user->setSurname($surname);
    $user->setPhone($phone);
    //$user->setGender($gender);
    $user->setPassword($password);



    // Convertimos el objeto User a JSON
      $userDataJson = $user->toJson();

    // Guardamos el JSON en un archivo de texto sin sobrescribir contenido existente
    $filePath = './usuarios.txt';
    file_put_contents($filePath, $userDataJson . PHP_EOL, FILE_APPEND);
    
    // Mostrar JSON en la consola del navegador
    echo "<script>console.log(" . json_encode($userDataJson) . ");</script>";
    echo "Datos del usuario guardados correctamente en usuarios.txt y mostrados en consola.";
  
} else {
    echo "No se recibieron datos del formulario.";
}

?>