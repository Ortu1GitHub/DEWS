<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
    <title>exercise 2 index</title>
</head>

<body>
<h1>exercise 2 index</h1>
    <?php
    require_once"./exercise2_person.php"; 
    require_once"./exercise2_engineer.php"; 
    require_once"./exercise2_network_technician.php"; 
        
    //Instances of person , engineer and network technician
    $person1=new Person("juan","pardo","1.91",90);
    var_dump($person1);
    echo "<br>";
    $person1->setName("Juan");
    $person1->setSurname("Pardo");
    $person1->setHeight("2.01");
    $person1->setAge(99);
    var_dump($person1);
    echo "<br>";

    $engineer1=new Engineer("java", "2 years");
    var_dump($engineer1);
    echo "<br>";
    $engineer1->setLanguage("Ruby");
    $engineer1->setExperience("1 year");
    var_dump($engineer1);
    echo "<br>";

    $networktechnician1=new NetworkTechnician("Verifyng Wifi...");
    var_dump($networktechnician1);
    echo "<br>";
    echo "Llamamos a los métodos de Person..."."<br>";
    $networktechnician1->setCheckingNetworks("Verifyng ethernet...");
    var_dump($networktechnician1);
    echo "<br>";
    echo $networktechnician1->getName(). "<br>";
    echo $networktechnician1->getSurname(). "<br>";
    echo $networktechnician1->getHeight(). "<br>";
    echo $networktechnician1->getAge(). "<br>";

    ?>
</body>
</html>
