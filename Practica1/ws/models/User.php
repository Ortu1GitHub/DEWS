<?php

/**
 *  clase User
 */

 require_once"./interfaces/IToJson.php"; 
class User implements IToJson
{
    //Properties
    public $name;
    public $surname;
    public $phone;
    public $password;
    public $gender;

    public function getName(){
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getSurname(){
        return $this->surname;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
    }


    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getPhone(){
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    /*
    public function getGender(){
        return $this->gender;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }
        */

    public function toJson(){
        // Convertimos el objeto en un array y luego a JSON
        $userData = [
            'name' => $this->name,
            'surname' => $this->surname,
            'phone' => $this->phone,
            'password' => $this->password,
            //'gender' => $this->gender
        ];
        return json_encode($userData);

    }

 

}