<?php
class Regex {
    private $regexName = "/^[a-zA-ZÀ-ÿ\s]{1,60}$/";
    private $regexEmail = "/^[a-zA-Z0-9_.+-]{1,120}@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/";
    private $regexPhone = "/^\d{3}-\d{3}-\d{4}$/";
    private $regexId = "/^\d+$/";

    public function validateName($name) {
        return preg_match($this->regexName, $name);
    }

    public function validateEmail($email) {
        return preg_match($this->regexEmail, $email);
    }

    public function validatePhone($phone) {
        return preg_match($this->regexPhone, $phone);
    }

    public function validateId($id) {
        return preg_match($this->regexId, $id);
    }
}

?>