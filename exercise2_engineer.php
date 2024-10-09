<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
    <title>exercise 2 engineer</title>
</head>

<body>
<br>
    <?php
    class Engineer extends Person {
        // Properties
        public $language = "PHP";
        public $experience = "20 years";


        public function getLanguage(){
            return $this->language;
        }
    
        public function setLanguage($language) {
            $this->language = $language;
        }
    
        public function getExperience() {
            return $this->experience;
        }
    
        public function setExperience($experience) {
            $this->experience = $experience;
        }
    
        //Functions to coding , computer fixing and using office sw...
    
        public function coding() {
            return "Coding...";
        }
    
        public function computerFixing() {
            return "Fixing computer...";
        }

        public function usingOfficeSw() {
            return "Using office sw...";
        }
    
    }//Engineer

    ?>
</body>

</html>