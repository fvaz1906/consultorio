<?php

namespace App\Models;

class Auth
{

    private $data = [];
    private $password;
    private $token;
    private $isValid;

    public function __construct($data, $password)
    {
        $this->setData($data);
        $this->setPassword($password);
        $this->setToken(md5(uniqid(rand(), true)));
    }

    public function scrollData()
    {
        foreach ($this->getData() as $data) $this->checkPassword($data);
    }

    public function checkPassword($data)
    {
        if (password_verify($this->getPassword(), $data->password)):
            $this->authentication($data);
            $this->setIsValid(true);
        else:
            $this->setIsValid(false);
        endif;
    }

    public function authentication($data)
    {
        $data->token = $this->getToken();
        $data->save();
        $_SESSION['TOKEN'] = $this->getToken();
        $_SESSION['USER'] = $data->email;
    }

    public function returnAuthentication()
    {
        return $this->getIsValid();
    }
 
    public function getData() { return $this->data; }

    public function setData($data) { $this->data = $data; return $this; }

    public function getPassword() { return $this->password; }

    public function setPassword($password) { $this->password = $password; return $this; }

    public function getToken() { return $this->token; }

    public function setToken($token) { $this->token = $token; return $this; }

    public function getIsValid() { return $this->isValid; }

    public function setIsValid($isValid) { $this->isValid = $isValid; return $this; }

}