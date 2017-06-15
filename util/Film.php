<?php


class Film
{
    private $id;
    private $name;
    private $year;
    private $genero;
    private $sinopsis;
    private $avgStar;
    private $comments;

    public function __construct($id, $name, $year, $genero, $sinopsis, $avgStar, $comments = null )
    {
        $this->id   = $id;
        $this->name = $name;
        $this->year = $year;
        $this->genero = $genero;
        $this->sinopsis = $sinopsis;
        $this->avgStar = $avgStar;
        $this->comments = $comments;

        if( $this->comments == null )
            $this->comments = array();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function getSinopsis()
    {
        return $this->sinopsis;
    }

    public function getAvgStar()
    {
        return $this->avgStar;
    }

    public function getComments()
    {
        return $this->comments;
    }
}