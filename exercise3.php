<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
    <title>exercise 3 index</title>
</head>

<body>
<h1>exercise 3 index</h1>
<?php
class Configuration {
    private static $color;
    private static $newsletter;
    private static $env;

    //Static properties/methods are accessed using self:: instead of $this
    //It is not necessary to get an instance of Configuration to use its properties/methods cause it is static

    public static function setColor($color) {
        self::$color = $color;
    }

    public static function getColor() {
        return self::$color;
    }

    public static function setNewsletter($newsletter) {
        self::$newsletter = $newsletter;
    }

    public static function getNewsletter() {
        return self::$newsletter;
    }

    public static function setEnv($env) {
        self::$env = $env;
    }

    public static function getEnv() {
        return self::$env;
    }
}

class AnotherClass {
    public function exampleMethod() {
        //Class Configuration methods are accessed using ::
        Configuration::setColor("blue");
        $color = Configuration::getColor();
        echo "Color set is : " . $color . "<br>";
        
        Configuration::setNewsletter(false);
        $newsletter = Configuration::getNewsletter();
        echo "Newsletter activated ? : " . ($newsletter ? "Yes" : "No") . "<br>";

        Configuration::setEnv("PRE");
        $env = Configuration::getEnv();
        echo "Environment ? : " . $env . "<br>";
    }
}

$anotherClass1 = new AnotherClass();
$anotherClass1->exampleMethod();
?>
</body>
</html>
