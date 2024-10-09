<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
    <title>exercise 1</title>
</head>

<body>
<h1>exercise 1</h1>
<br>
    <?php
    class Car {
        // Properties
        public $color = "rose";
        public $brand = "Ferrari";
        public $model = "Aventador";
        public $speed = 300;
        public $hp = 500;
        public $seats = 2;

        public function getColor(){
            return $this->color;
        }
    
        public function setColor($color) {
            $this->color = $color;
        }
    
        public function getBrand() {
            return $this->brand;
        }
    
        public function setBrand($brand) {
            $this->brand = $brand;
        }
    
        public function getModel() {
            return $this->model;
        }
    
        public function setModel($model) {
            $this->model = $model;
        }
    
        public function getSpeed() {
            return $this->speed;
        }
    
        public function setSpeed($speed) {
            $this->speed = $speed;
        }
    
        public function getHP() {
            return $this->hp;
        }
    
        public function setHP($hp) {
            $this->hp = $hp;
        }
    
        public function getSeats() {
            return $this->seats;
        }
    
        public function setSeats($seats) {
            $this->seats = $seats;
        }
    
        public function accelerate() {
            $this->speed++;
        }
    
        public function brake() {
            $this->speed--;
        }
    
        //Functions to accelerate , brake and display car data
        public function displaySpeed() {
            return "Current speed is : " . $this->speed . " km/h";
        }
 
        public function displayCarInfo($car1) {
            if (is_object($car1) && !empty((array)$car1)) {
                echo "CAR DATA <br>";
                echo "Color: " . $car1->getColor() . "<br>";
                echo "Brand: " . $car1->getBrand() . "<br>";
                echo "Model: " . $car1->getModel() . "<br>";
                echo "Speed: " . $car1->getSpeed() . " km/h<br>";
                echo "HP : " . $car1->getHP() . "<br>";
                echo "Seats: " . $car1->getSeats() . "<br>";
            }
        }
    }//Car

 $car1 = new Car("yellow", "Renault", "Clio", 150, 200, 5);
 $car2 = new Car("green", "Seat", "Panda", 250, 200, 5);
 $car3 = new Car("blue", "Citroen", "Xara", 100, 220, 4);
 $car4 = new Car("red", "Mercedes", "Clase A", 350, 100, 3);
 $car1->color = "grey";
 $car1->setBrand("Audi");
 echo $car1->displayCarInfo($car1);
 echo $car1->displaySpeed(); 
 echo "<br>";
 $car1->accelerate();
 echo "Accelerate function is executed...";
 echo "<br>";
 echo $car1->displaySpeed(); 

    ?>
</body>

</html>