<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
    <title>Exercise 4</title>
</head>

<body>
    <h1>Exercise 4</h1>
    <br>

    <?php
    interface IMacInterface {
        //Both methods are implemented in IMac class
        public function setBrand2($brand);
        public function setVersion2($version);
    }

    class IMac implements IMacInterface {
        // Properties
        public $brand;
        public $version;

        public function getBrand() {
            return $this->brand;
        }

        public function setBrand2($brand) {
            $this->brand = $brand;
        }

        public function getVersion() {
            return $this->version;
        }

        public function setVersion2($version) {
            $this->version = $version;
        }
    }//IMac

    $iMac1=new IMac("MacOs 10",2);
    echo $iMac1->setBrand2("Mac Air");
    echo $iMac1->setVersion2(101);
    var_dump($iMac1);

    ?> 
</body>

</html>
