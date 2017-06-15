<?php

class User
{
    private $id;
    private $firstname;
    private $lastname;
    private $username;
    private $email;
    private $admin;

    public function __construct($id, $firstname, $lastname, $username, $email, $admin )
    {
        $this->id           = $id;
        $this->firstname    = $firstname;
        $this->lastname     = $lastname;
        $this->username     = $username;
        $this->email        = $email;
        $this->admin        = $admin > 0 ? true : false;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->firstname;
    }

    public function getLastName()
    {
        return $this->lastname;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function isAdmin()
    {
        return $this->admin;
    }
}


?>