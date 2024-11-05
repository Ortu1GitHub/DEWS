<?php
    require_once"./models/User.php"; 
    require_once"./interfaces/IToJson.php"; 

    //Data recieved from form
    $name = $_POST['name'] ?? null;
    $surname = $_POST['surname'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $password = $_POST['pass'] ?? null;
    $gender = $_POST['gender'] ?? null;


    // User object is created with its data
    $user = new User();
    $user->setName($name);
    $user->setSurname($surname);
    $user->setPhone($phone);
    $user->setPassword($password);
    $user->setGender($gender);
    
    // User is converted to JSON
      $userDataJson = $user->toJson();

    // JSON saved is appended to file (not overwrite) and displayed in console
    $filePath = './usuarios.txt';
    file_put_contents($filePath, $userDataJson . PHP_EOL, FILE_APPEND);
    
    //JSOn values displayed in console
    echo "<script>console.log('Datos del usuario: " .json_encode($userDataJson) . "');</script>";
    echo "Datos del usuario guardados correctamente en usuarios.txt";
?>