<?php


class Comment
{
    private $id;
    private $time;
    private $user;
    private $star;
    private $comment;


    public function __construct($id, $user, $star, $time, $comment)
    {
        $this->id = $id;
        $this->user = $user;
        $this->star = $star;
        $this->time = $time;
        $this->comment = $comment;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getStar()
    {
        return $this->star;
    }

    public function getComment()
    {
        return $this->comment;
    }




}