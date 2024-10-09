<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
    <title>exercise 2 network technician</title>
</head>

<body>
<br>
    <?php
    class NetworkTechnician extends Engineer {
        // Properties
        public $checkingNetworks = "Verifyng networks...";


        public function getCheckingNetworks(){
            return $this->checkingNetworks;
        }
    
        public function setCheckingNetworks($checkingNetworks) {
            $this->checkingNetworks = $checkingNetworks;
        }

    
    }//NetowrkTechnician

    ?>
</body>

</html>