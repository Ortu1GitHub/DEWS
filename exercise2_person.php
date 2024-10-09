<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
    <title>exercise 2 person</title>
</head>

<body>
<br>
    <?php
    class Person {
        // Properties
        public $name = "Pepe";
        public $surname = "Gomez";
        public $heigth = "1.78";
        public $age = 47;


        public function getName(){
            return $this->name;
        }
    
        public function setName($name) {
            $this->name = $name;
        }
    
        public function getSurname() {
            return $this->surname;
        }
    
        public function setSurname($surname) {
            $this->surname = $surname;
        }
    
        public function getHeight() {
            return $this->heigth;
        }
    
        public function setHeight($heigth) {
            $this->heigth = $heigth;
        }
    
        public function getAge() {
            return $this->age;
        }
    
        public function setAge($age) {
            $this->age = $age;
        }
    
        //Functions to speak , walk
    
        public function speak() {
            return "hola";
        }
    
        public function walk() {
            return "walked 1 step...";
        }
    
    }//Person

    ?>
</body>

</html>